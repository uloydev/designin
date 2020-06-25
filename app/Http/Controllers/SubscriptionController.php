<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use App\Subscription;
use App\UserProfile;
use App\SubscriptionOrder;
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
        $mySubscription = Auth::user()->subscription;
        $subscriptionHistory = SubscriptionOrder::where('user_id', Auth::id());
        if ($request->has('filter')) {
            if ($request->filter == 'latest') {
                $subscriptionHistory = $subscriptionHistory->latest()->paginate(5);
            }
            elseif ($request->filter =='oldest') {
                $subscriptionHistory = $subscriptionHistory->oldest()->paginate(5);
            }
            $request->session()->flash('filter', $request->filter);
            $subscriptionHistory->appends($request->only('keyword', 'limit'));
        }
        else {
            $subscriptionHistory = $subscriptionHistory->latest()->paginate(5);
        }
        return view('subscription.index', [
            'mySubscription' => $mySubscription,
            'listBank' => $listBank,
            'orders' => $orders,
            'profile' => $profile,
            'subscriptionHistory' => $subscriptionHistory,
        ]);
    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscription.show', ['subscription' => $subscription]);
    }

}
