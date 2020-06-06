<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Subscription;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index(Request $request)
    {

        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        $orders = Order::where('user_id', Auth::id());
        if($request->has('filter')) {
            if ($request->filter == 'latest') {
                $orders = $orders->latest();
            }elseif ($request->filter =='oldest') {
                $orders = $orders->oldest();
            }elseif ($request->filter =='finish') {
                $orders = $orders->where('status', 'finished');
            }elseif ($request->filter =='process') {
                $orders = $orders->where(function ($query){
                    $query->where('status', 'process')
                    ->orWhere('status', 'complaint');
                });
            }else{
                return abort(404);
            }
            $orders = $orders->paginate(10);
            $request->session()->flash('filter', $request->filter);
            $orders->appends(['filter']);
        }else{
            $orders = $orders->paginate(10);
        }
        $subscriptions = Subscription::paginate(12);
        $totalSubcription = Subscription::count();
        return view('user.manage-transaction', [
            'subscriptions' => $subscriptions,
            'totalSubcription' => $totalSubcription,
            'listBank' => $listBank,
            'orders' => $orders
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
