<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function index()
    {
        $subscriptions = Subscription::paginate(12);
        $totalSubcription = Subscription::count();
        return view('subscription.index', ['subscriptions' => $subscriptions, 'totalSubcription' => $totalSubcription]);
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
        //
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
