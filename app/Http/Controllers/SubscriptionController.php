<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use App\Subscription;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function index(Request $request)
    {
        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        $profile = UserProfile::where('user_id', Auth::id())->first();
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        $subscriptionHistory = Order::where('user_id', Auth::id())->whereNotNull('subscription_id');
        $subscriptions = Subscription::get();
        if ($request->has('filter')) {
            if ($request->filter == 'latest') {
                $subscriptionHistory = $subscriptionHistory->latest();
            }elseif ($request->filter =='oldest') {
                $subscriptionHistory = $subscriptionHistory->oldest();
            }else{
                return abort(404);
            }
            $subscriptionHistory = $subscriptionHistory->paginate(5);
            $request->session()->flash('filter', $request->filter);
            $pagination = $subscriptionHistory->appends ( array (
                'filter' => $request->filter
            ) );
        }else{
                $subscriptionHistory = $subscriptionHistory->latest()->paginate(5);
        }
        return view('subscription.index', [
            'subscriptions' => $subscriptions,
            'subscriptionHistory' => $subscriptionHistory,
            'listBank' => $listBank,
            'orders' => $orders,
            'profile' => $profile
        ]);
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
        $subscription = Subscription::findOrFail($id);
        return view('subscription.show', ['subscription' => $subscription]);
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
}
