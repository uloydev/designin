<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use App\Subscription;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function index(Request $request)
    {
        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        $profile = UserProfile::where('user_id', Auth::id())->first();
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        $mySubscription = Auth::user()->subscription();
        if ($request->has('filter')) {
            if ($request->filter == 'latest') {
                $mySubscription = $mySubscription->latest()->paginate(5);
            }
            elseif ($request->filter =='oldest') {
                $mySubscription = $mySubscription->oldest()->paginate(5);
            }
            $request->session()->flash('filter', $request->filter);
            $mySubscription->appends($request->only('keyword', 'limit'));
        }
        else {
            $mySubscription->latest()->paginate(5);
        }
        return view('subscription.index', [
            'mySubscription' => $mySubscription,
            'listBank' => $listBank,
            'orders' => $orders,
            'profile' => $profile
        ]);
    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscription.show', ['subscription' => $subscription]);
    }

}
