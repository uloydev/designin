<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class SubscriptionController extends Controller
{

    public function index()
    {
        $totalSubcription = Subscription::count();
        $subscriptions = Subscription::paginate(5);
        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        return view('subscription.index', [
            'subscriptions' => $subscriptions,
            'totalSubcription' => $totalSubcription,
            'listBank' => $listBank
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
