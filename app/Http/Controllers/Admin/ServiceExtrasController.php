<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceExtras;
use App\Service;
use App\Order;

class ServiceExtrasController extends Controller
{

    public function index($id)
    {
        $service = Service::findOrFail($id);
        $allExtra = ServiceExtras::where('service_id', $id)->paginate(10);
        return view('service.extras', ['allExtra' => $allExtra, 'service' => $service]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $service = Service::findOrfail($request->service_id);
        $extras = new ServiceExtras;
        $extras->name = $request->name;
        $extras->service_id = $request->service_id;
        $extras->price = $request->price;
        $extras->token_price = $request->token_price;
        $extras->description = $request->description;
        $extras->benefit = $request->benefit;
        $extras->save();
        return redirect()->back()->with('success', 'extras for service "'+ $service->title +'" created successfully');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $extras = ServiceExtras::findOrFail($id);
        return view('service.extras.manage', [
            'extras' => $extras
        ]);
    }

    public function update(Request $request, $id)
    {
        $extras = ServiceExtras::findOrfail($id);
        $extras->name = $request->name;
        $extras->price = $request->price;
        $extras->token_price = $request->token_price;
        $extras->description = $request->description;
        $extras->benefit = $request->benefit;
        $extras->save();
        return redirect()->back()->with('success', 'extras for service "' . $extras->service->title . '" updated successfully');
    }

    public function destroy($id)
    {
        $extras = ServiceExtras::findOrFail($id);
        foreach(Order::pluck('extras')->all() as $orderExtras){
            if (in_array($id, json_decode($orderExtras))) {
                return redirect()->back()->with('error', "Failed to delete extras, because it's still used in unfinished orders");
            }
        }
        $extras->delete();
        return redirect()->back()->with('success', 'extras for service "' . $extras->service->title .'" updated successfully');
    }
}
