<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SubscriptionController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('sort')){
            if ($request->sort == 'latest') {
                $subscriptions = Subscription::latest()->paginate(12);
            }else if($request->sort == 'oldest'){
                $subscriptions = Subscription::oldest()->paginate(12);
            }else {
                return abort('404');
            }
        }else{
            $subscriptions = Subscription::latest()->paginate(12);
        }
        $totalSubscription = Subscription::count();
        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        return view('subscription.manage', [
            'subscriptions' => $subscriptions,
            'totalSubscription' => $totalSubscription,
            'listBank' => $listBank
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'desc'=>'required',
            'img'=>'mimes:jpeg,png,gif|max:4000',
            'price'=>'required',
            'duration'=>'required',
            'token'=>'required'
        ]);
        $sub = new Subscription;
        $sub->title = $request->title;
        $sub->desc = $request->desc;
        $sub->token = $request->token;
        $sub->price = $request->price;
        $sub->duration = $request->duration;
        $sub->img = $request->file('img')->store('public/files');
        $sub->save();
        return redirect()->back()->with('success_subscription','Subscription Created Successfully');
    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscription.single', [
            'subscription'=> $subscription
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required',
            'desc'=>'required',
            'img'=>'nullable|mimes:jpeg,png,gif|max:2000',
            'price'=>'required',
            'duration'=>'required',
            'token'=>'required'
        ]);
        $sub = Subscription::findOrFail($id);
        $sub->title = $request->title;
        $sub->desc = $request->desc;
        $sub->token = $request->token;
        $sub->price = $request->price;
        $sub->duration = $request->duration;
        if ($request->hasFile('img')) {
            $sub->img = $request->file('img')->store('public/files');
        }
        $sub->save();
        return redirect()->back()->with('success_subscription','Subscription Created Successfully');
    }

    public function destroy($id)
    {
        $sub = Subscription::findOrFail($id);
        Storage::delete($sub->img);
        if($sub->subscribers->count()>0){
            foreach ($sub->subscribers as $subscriber) {
                $subscriber->is_subscribe = false;
                $subscriber->save();
            }
        }
        $sub->delete();
        return redirect()->route('manage.subscription.index')->with(
            'success_subscription', 'Subscription Deleted Successfully'
        );
    }
}
