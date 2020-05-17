<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Subscription;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{

    public function index()
    {

        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        $subscriptions = Subscription::paginate(12);
        $totalSubcription = Subscription::count();
        return view('user.manage-transaction', [
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
        $request->validate([
            'title'=> 'required',
            'desc'=>'required',
            'img'=>'mimes:jpeg,png,gif|max:2000',
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
        $request->validate([
            'title'=> 'required',
            'desc'=>'required',
            'img'=>'mimes:jpeg,png,gif|max:2000',
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
            $sub->image = $request->file('img')->store('public/files');
        }
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
