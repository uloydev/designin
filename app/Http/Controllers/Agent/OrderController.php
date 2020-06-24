<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Order;
use App\ProjectResult;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $totalOrderNotDone = Order::where('status', 'process')
            ->orWhere('status', 'complaint')
            ->orWhere('status', 'check_result')
            ->orWhere('status', 'check_revision')
            ->count();
        $orders = Order::where('agent_id', Auth::id())->where(function ($query) {
            $query->where('status', 'process')
            ->orWhere('status', 'complaint');
        });
        if($request->has('sort') and !empty($request->sort)){
            if ($request->sort == 'budget-desc') {
                $orders = $orders->orderBy('budget', 'desc');
            }elseif ($request->sort == 'budget-asc'){
                $orders = $orders->orderBy('budget', 'asc');
            }elseif ($request->sort == 'duration-desc') {
                $orders = $orders->orderBy('duration', 'desc');
            }elseif ($request->sort == 'duration-asc'){
                $orders = $orders->orderBy('duration', 'asc');
            }elseif ($request->sort == 'time-desc') {
                $orders = $orders->latest();
            }elseif ($request->sort == 'time-asc'){
                $orders = $orders->oldest();
            }else{
                return abort(404);
            }
            $orders = $orders->paginate(10);
            $pagination = $orders->appends([
                'sort' => $request->sort
            ]);
            $request->session()->flash('sort', $request->sort);
        }else{
            $orders = $orders->latest()->paginate(10);
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
        $totalOrderNotDone = Order::where('status', 'process')
        ->orWhere('status', 'complaint')
        ->orWhere('status', 'check_result')
        ->orWhere('status', 'check_revision')
        ->count();
        $orders = Order::where([
            ['agent_id', Auth::id()],
            ['status', 'finished']
        ]);
        if($request->has('sort') and !empty($request->sort)){
            if ($request->sort == 'budget-desc') {
                $orders = $orders->orderBy('budget', 'desc');
            }elseif ($request->sort == 'budget-asc'){
                $orders = $orders->orderBy('budget', 'asc');
            }elseif ($request->sort == 'duration-desc') {
                $orders = $orders->orderBy('duration', 'desc');
            }elseif ($request->sort == 'duration-asc'){
                $orders = $orders->orderBy('duration', 'asc');
            }elseif ($request->sort == 'time-desc') {
                $orders = $orders->latest();
            }elseif ($request->sort == 'time-asc'){
                $orders = $orders->oldest();
            }else{
                return abort(404);
            }
            $orders = $orders->paginate(10);
            $pagination = $orders->appends([
                'sort' => $request->sort
            ]);
            $request->session()->flash('sort', $request->sort);
        }else{
            $orders = $orders->latest()->paginate(10);
        }
        return view('agent.request-history', ['orders'=>$orders, 'totalOrderNotDone' => $totalOrderNotDone]);
    }

    public function bidHistory(Request $request)
    {
        $orders = Order::where('agent_id', Auth::id());
        if($request->has('sort') and !empty($request->sort)){
            if ($request->sort == 'budget-desc') {
                $orders = $orders->orderBy('budget', 'desc');
            }elseif ($request->sort == 'budget-asc'){
                $orders = $orders->orderBy('budget', 'asc');
            }elseif ($request->sort == 'duration-desc') {
                $orders = $orders->orderBy('duration', 'desc');
            }elseif ($request->sort == 'duration-asc'){
                $orders = $orders->orderBy('duration', 'asc');
            }elseif ($request->sort == 'time-desc') {
                $orders = $orders->latest();
            }elseif ($request->sort == 'time-asc'){
                $orders = $orders->oldest();
            }else{
                return abort(404);
            }
            $orders = $orders->paginate(10);
            $orders->appends([
                'sort' => $request->sort
            ]);
            $request->session()->flash('sort', $request->sort);
        }else{
            $orders = $orders->latest()->paginate(10);
        }
        return view('agent.bid-history', [
            'orders'=>$orders
        ]);
    }

    // not used
    public function incoming(Request $request)
    {
        $orders = Order::leftJoin('package', 'package.id', '=', 'orders.package_id')
        ->where('agent_id', Auth::id())
        ->where('status', 'unpaid')
        ->select(
            'orders.id', 'agent_id', 'user_id', 'package_id', 'orders.created_at', 'deadline', 'started_at', 'status',
            'progress', 'request', 'orders.updated_at', 'package.duration', 'is_reviewed', 'package.price'
        );
        return view('service.incoming', ['orders' => $orders]);
    }

    public function complaint(Request $request)
    {
        $totalComplaint = Order::where('agent_id', Auth::id())->where('status', 'complaint')->count();
        $orders = Order::where('agent_id', Auth::id())->where('status', 'complaint');
        if($request->has('sort') and !empty($request->sort)){
            if ($request->sort == 'budget-desc') {
                $orders = $orders->orderBy('budget', 'desc');
            }elseif ($request->sort == 'budget-asc'){
                $orders = $orders->orderBy('budget', 'asc');
            }elseif ($request->sort == 'duration-desc') {
                $orders = $orders->orderBy('duration', 'desc');
            }elseif ($request->sort == 'duration-asc'){
                $orders = $orders->orderBy('duration', 'asc');
            }elseif ($request->sort == 'time-desc') {
                $orders = $orders->latest();
            }elseif ($request->sort == 'time-asc'){
                $orders = $orders->oldest();
            }else{
                return abort(404);
            }
            $orders = $orders->paginate(10);
            $pagination = $orders->appends([
                'sort' => $request->sort
            ]);
            $request->session()->flash('sort', $request->sort);
        }else{
            $orders = $orders->latest()->paginate(10);
        }
        return view('service.complaint', ['complaints' => $orders, 'totalComplaint' => $totalComplaint]);
    }

    public function approval(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($request->approval == 'accept') {
            $order->status = 'process';
            $order->started_at = Carbon::now();
            $order->save();
            Mail::to($order->user->email)->send(new OrderAcceptedNotification($order));
            return response()->json(['success'=>'Successfully' . $request->approval . ' Job']);
        }
        else if($request->approval == 'reject') {
            $order->status = 'canceled';
            $order->save();
            Mail::to($order->user->email)->send(new OrderRejectedNotification($order));
            return redirect()->back()->with('reject', 'Successfully reject job');
        }
        else {
            return abort('404');
        }
    }

    public function progressUpdate(Request $request, $id)
    {
        $order = Order::where('status', 'process')->findOrFail($id);
        $order->progress = $request->progress;
        $order->save();
        return redirect()->back()->with('success', 'Successfully update progress');
    }

    public function sendReview(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->is_reviewed = true;
        $order->save();
        Mail::to($order->user->email)->send(new OrderReviewedNotification($order, $request));
        return redirect()->back()->with('success', 'Successfully send review to customer email');
    }

    public function sendResult(Request $request, $id)
    {
        $validator = $request->validate([
            'result_file'=> 'nullable|max:10000|mimes:jpeg,png,psd,xd,sketch,mp4,zip,rar,7z,pdf',
            'message'=> 'required',
        ]);
        $result = new ProjectResult;
        $result->order_id = $id;
        if ($request->hasFile('result_file')) {
            $result->file = $request->file('result_file')->store('public/files');
        }
        $result->message = $request->message;
        $result->type = 'result';
        $result->agent_id = Auth::id();
        try {
            $result->save();
            $order = Order::findOrFail($id);
            $order->status = 'check_result';
            $order->save();
            Mail::to($order->user->email)->send(new OrderFinishedNotification($order, $result));
            return response()->json(['success' => 'Successfully Upload Result. Please wait until customer accept this']);
        } catch (\Throwable $throwable) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function sendRevision(Request $request, $id)
    {
        $request->validate([
            'file'=> 'required|mimes:jpeg,png,pdf,zip,rar',
            'message'=>'required',
        ]);
        $revision = new ProjectResult();
        $revision->order_id = $id;
        $revision->file = $request->file('file')->store('public/files');
        $revision->message = $request->message;
        $revision->type = 'revision';
        $revision->agent_id = Auth::id();
        $revision->save();
        $order = Order::findOrFail($id);
        $order->status = 'check_revision';
        $order->save();
        Mail::to($order->user->email)->send(new OrderRevisionFinishedNotification($order, $revision));
        return redirect()->back()->with('success', 'Project Revision Has Sent Successfully');
    }

    public function search(Request $request)
    {
        $searching = $request->search_order;
        $orders = Order::where('agent_id', Auth::id())->whereHas('package.service', function (Builder $query) use ($request) {
            $query->where('title', 'LIKE', '%' . $request->search_order . '%');
        })->orWhereHas('user', function (Builder $query) use ($request) {
            $query->where('email', 'LIKE', '%' . $request->search_order . '%')
                  ->orWhere('name', $request->search_order);
        });
        if($request->has('sort') and !empty($request->sort)){
            if ($request->sort == 'budget-desc') {
                $orders = $orders->orderBy('budget', 'desc');
            }elseif ($request->sort == 'budget-asc'){
                $orders = $orders->orderBy('budget', 'asc');
            }elseif ($request->sort == 'duration-desc') {
                $orders = $orders->orderBy('duration', 'desc');
            }elseif ($request->sort == 'duration-asc'){
                $orders = $orders->orderBy('duration', 'asc');
            }elseif ($request->sort == 'time-desc') {
                $orders = $orders->latest();
            }elseif ($request->sort == 'time-asc'){
                $orders = $orders->oldest();
            }else{
                return abort(404);
            }
            $orders = $orders->paginate(10);
            $pagination = $orders->appends([
                'sort' => $request->sort
            ]);
            $request->session()->flash('sort', $request->sort);
        }else{
            $orders = $orders->latest()->paginate(10);
        }
        $orders->appends(['search_order' => $request->search_order]);
        return view('job.search', ['searching' => $searching, 'orders' => $orders]);
    }
}
