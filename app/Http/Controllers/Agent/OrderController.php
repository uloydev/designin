<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Order;
use App\ProjectResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderAcceptedNotification;
use App\Mail\OrderRejectedNotification;
use App\Mail\OrderReviewedNotification;
use App\Mail\OrderFinishedNotification;
use App\Mail\OrderRevisionFinishedNotification;


class OrderController extends Controller
{

    public function index(Request $request)
    {
        $totalOrderNotDone = Order::where('status', '<>', 'finished')->count();
        $orders = Order::join('package', 'package.id', '=', 'orders.package_id')
        ->where('agent_id', Auth::id())
        ->where('status', 'process')
        ->orWhere('status', 'complaint');
        if ($request->has('search')) {
            $orders = $orders->where('duration', 'like', '%'.$request->search.'%')
            ->orWhere('price', 'like', '%'.$request->search.'%');
        }
        if ($request->has('sort', 'sort_type')) {
            try {
                if($request->sort == 'created_at'){
                    $orders = $orders->orderBy('orders.'.$request->sort, $request->sort_type);
                }else{
                    $orders = $orders->orderBy($request->sort, $request->sort_type)->paginate(10);
                }
            } catch (\Throwable $th) {
                return abort('404');
            }
        }
        else {
            $orders = $orders->orderBy('orders.created_at', 'desc')->paginate(10);
        }
        return view('agent.list-request', ['orders' => $orders, 'totalOrderNotDone' => $totalOrderNotDone]);
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Order History Deleted Successfully');
    }

    public function history(Request $request)
    {
        $totalOrderNotDone = Order::where('status', '<>', 'finished')->count();
        $orders = Order::join('package', 'package.id', '=', 'orders.package_id')->where([
           ['agent_id', Auth::id()],
           ['status', 'finished']
        ]);
        if ($request->has('search')) {
            $orders = $orders->where('duration', 'like', '%'.$request->search.'%')
            ->orWhere('price', 'like', '%'.$request->search.'%');
        }
        if ($request->has('sort', 'sort_type')) {
            try {
                if($request->sort == 'created_at'){
                    $orders = $orders->orderBy('orders.'.$request->sort, $request->sort_type);
                }else{
                    $orders = $orders->orderBy($request->sort, $request->sort_type)->paginate(10);
                }
            } catch (\Throwable $th) {
                return abort('404');
            }
        }else{
            $orders = $orders->orderBy('orders.created_at', 'desc')->paginate(10);
        }
        return view('agent.request-history', ['orders'=>$orders, 'totalOrderNotDone' => $totalOrderNotDone]);
    }

    public function bidHistory(Request $request)
    {
        $orders = Order::join('package', 'package.id', '=', 'orders.package_id')
        ->where('agent_id', Auth::id());
        if ($request->has('search')) {
            $orders = $orders->where('duration', 'like', '%'.$request->search.'%')
            ->orWhere('price', 'like', '%'.$request->search.'%');
        }
        if ($request->has('sort', 'sort_type')) {
            try {
                if($request->sort == 'created_at'){
                    $orders = $orders->orderBy('orders.'.$request->sort, $request->sort_type);
                }else{
                    $orders = $orders->orderBy($request->sort, $request->sort_type)->paginate(10);
                }
            } catch (\Throwable $th) {
                return abort('404');
            }
        }else{
            $orders = $orders->orderBy('orders.created_at', 'desc')->paginate(10);
        }
        return view('agent.bid-history', [
            'orders'=>$orders
        ]);
    }

    public function incoming(Request $request)
    {
        $orders = Order::join('package', 'package.id', '=', 'orders.package_id')
        ->where('agent_id', Auth::id())
        ->where('status', 'waiting');
        if ($request->has('search')) {
            $orders = $orders->where('duration', 'like', '%'.$request->search.'%')
            ->orWhere('price', 'like', '%'.$request->search.'%');
        }
        if ($request->has('sort', 'sort_type')) {
            try {
                if($request->sort == 'created_at'){
                    $orders = $orders->orderBy('orders.'.$request->sort, $request->sort_type);
                }else{
                    $orders = $orders->orderBy($request->sort, $request->sort_type)->paginate(10);
                }
            } catch (\Throwable $th) {
                return abort('404');
            }
        }else{
            $orders = $orders->orderBy('orders.created_at', 'desc')->paginate(10);
        }
        return view('service.incoming', ['orders' => $orders]);
    }

    public function complaint()
    {
        $totalComplaint = Order::where('status', 'complaint')->count();
        $complaints = Order::where('status', 'complaint')->paginate(10);
        return view('service.complaint', ['complaints' => $complaints, 'totalComplaint' => $totalComplaint]);
    }

    public function approval(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($request->approval == 'accept') {
            $order->status = 'process';
            $order->started_at = Carbon::now();
            $order->save();
            Mail::to($order->user->email)->send(new OrderAcceptedNotification($order));
        }else if($request->approval == 'reject'){
            $order->status = 'canceled';
            $order->save();
            Mail::to($order->user->email)->send(new OrderRejectedNotification($order));
        }else{
            return abort('404');
        }
        return redirect()->back('approval', 'Succesfully ' . $request->approval . ' Incoming Job');
    }

    public function progressUpdate($id)
    {
        $order = Order::where('status', 'process')->findOrFail($id);
        $order->progress = $request->progress;
        $order->save();
    }

    public function sendReview(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->is_reviewed = true;
        $order->save();
        Mail::to($order->user->email)->send(new OrderReviewedNotification($order));
        return [
            'status' => 'ok',
            'sent_to' => $order->user->email
        ];
    }

    public function sendResult(Request $request, $id)
    {
        $request->validate([
            'file'=> 'required|mimes:jpeg,png,pdf,zip,rar',
            'message'=> 'required',
        ]);
        $result = new ProjectResult();
        $result->order_id = $id;
        $result->file = $request->file('file')->store('public/files');
        $result->message = $request->message;
        $result->type = 'result';
        $result->agent_id = Auth::id();
        $result->save();
        $order = Order::findOrFail($id);
        Mail::to($order->user->email)->send(new OrderFinishedNotification($order));
        return redirect()->back()->with('success', 'Project Result Has Sent Successfully');
    }

    public function sendRevision(Request $request, $id)
    {
        $request->validate([
            'file'=> 'required|mimes:jpeg,png,pdf,zip,rar',
            'message'=>'required',
        ]);
        $result = new ProjectResult();
        $result->order_id = $id;
        $result->file = $request->file('file')->store('public/files');
        $result->message = $request->message;
        $result->type = 'revision';
        $result->agent_id = Auth::id();
        $result->save();
        $order = Order::findOrFail($id);
        Mail::to($order->user->email)->send(new OrderRevisionFinishedNotification($order));
        return redirect()->back()->with('success', 'Project Revision Has Sent Successfully');
    }
}
