<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use App\UserProfile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\ProjectResult;
use App\Testimony;
use App\Service;
use App\Package;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        $profile = UserProfile::where('user_id', Auth::id())->first();
        $orders = Order::where('user_id', Auth::id());
        if($request->has('filter')){
            if ($request->filter == 'all'){
                $orders = $orders->latest();
            }elseif ($request->filter == 'completed') {
                $orders = $orders->where(function ($query){
                    $query->where('status', 'finished')
                    ->orWhere('status', 'check_result')
                    ->orWhere('status', 'check_revision');
                })->latest();
            }elseif ($request->filter == 'process') {
                $orders = $orders->where(function ($query) {
                    $query->where('status', 'process')
                    ->orWhere('status', 'complaint');
                })->latest();
            }elseif ($request->filter == 'canceled') {
                $orders = $orders->where('status', 'canceled')->latest();
            }else{
                return abort(404);
            }
            $request->session()->flash('filter', $request->filter);
            $orders = $orders->paginate(10);
            $pagination = $orders->appends ( array (
                'filter' => $request->filter
            ) );
        }else{
            $orders = $orders->latest()->paginate(10);
        }
        $data = ['profile' => $profile, 'listBank' => $listBank, 'orders' => $orders];
        if ($request->has('filter')) {
            $data['filter'] = $request->filter;
        }
        return  view('user.order', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('job.chat', ['order' => $order]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function acceptResult($id, $result_id)
    {
        $order = Order::findOrFail($id);
        $result = ProjectResult::findOrFail($result_id);
        if ($order->id !== $result->order_id or $order->user_id !== Auth::id()) {
            return abort(401);
        }
        $order->status = 'finished';
        $order->save();
        return redirect()->back()->with('success', 'order result accepted successfully. order finished.');
    }

    public function rejectResult($id, $result_id)
    {
        $order = Order::findOrFail($id);
        $result = ProjectResult::findOrFail($result_id);
        if ($order->id !== $result->order_id or $order->user_id !== Auth::id()) {
            return abort(401);
        }
        if ($order->max_revision - $order->revision->count() == 0) {
            return redirect()->back()->with(
                'error', 'order already reach revision limit ('. $order->max_revision .' revision)'
            );
        }
        $order->status = 'complaint';
        $order->save();
        return redirect()->back()->with(
            'success', 'order result rejected successfully. please wait agent to send a new one.'
        );
    }

    public function sendReview($id, Request $request)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->findOrFail($id);
        $package = Package::findOrFail($order->package_id);
        $service = Service::findOrFail($package->service_id);
        $testimony = new Testimony;
        $testimony->content = $request->content;
        $testimony->rating = $request->rating;
        $testimony->user_id = $user->id;
        $testimony->service_id = $service->id;
        $testimony->save();
        $order->is_reviewed = true;
        $order->save();
        return redirect()->back()->with('success', 'your review has been sent');
    }
}
