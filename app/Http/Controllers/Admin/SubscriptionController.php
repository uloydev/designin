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
        $totalSubcription = Subscription::count();
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
        $request->vlaidate([
            'title'=> 'required',
            'desc'=>'required',
            'img'=>'mimes:jpeg,png,gif|max:2000',
            'price'=>'required',
            'duration'=>'required',
            'token'=>'required'
        ]);
        $sub = new Subscription();
        $sub->title = $request->title;
        $sub->desc = $request->desc;
        $sub->token = $request->token;
        $sub->price = $request->price;
        $sub->duration = $request->duration;
        $sub->image = $request->file('img')->store('public/files');
        $sub->save();
        return redirect()->back()->with('success','Subscription Created Successfully');
    }

    public function show($id)
    {
        $sub = Subscription::findOrFail($id);
        return view('subscription.single', [
            'subscription'=> $sub
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $sub = Subscription::findOrFail($id);
        $request->vlaidate([
            'title'=> 'required',
            'desc'=>'required',
            'img'=>'mimes:jpeg,png,gif|max:2000',
            'price'=>'required',
            'duration'=>'required',
            'token'=>'required'
        ]);
        $sub = new Subscription();
        $sub->title = $request->title;
        $sub->desc = $request->desc;
        $sub->token = $request->token;
        $sub->price = $request->price;
        $sub->duration = $request->duration;
        $sub->image = $request->file('img')->store('public/files');
        $sub->save();
        return redirect()->back()->with('success','Subscription Created Successfully');
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
    }
}
