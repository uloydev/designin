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
        if ($request->has('filter')) {
            if ($request->filter == 'latest') {
                $subscriptions = Subscription::latest();
            }elseif ($request->filter =='oldest') {
                $subscriptions = Subscription::oldest();
            }else{
                return abort(404);
            }
            $subscriptions = $subscriptions->paginate(5);
            $request->session()->flash('filter', $request->filter);
            $pagination = $subscriptions->appends ( array (
                'filter' => $request->filter
            ) );
        }else{
            $subscriptions = Subscription::latest()->paginate(5);
        }
        return view('subscription.index', [
            'subscriptions' => $subscriptions,
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
