<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceExtras;
use App\Service;
use App\Order;

class ServiceExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $extras = ServiceExtras::findOrFail($id);
        return view('service.extras.manage', [
            'extras' => $extras
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $extras = ServiceExtras::findOrfail($id);
        $extras->name = $request->name;
        $extras->price = $request->price;
        $extras->token_price = $request->token_price;
        $extras->description = $request->description;
        $extras->benefit = $request->benefit;
        $extras->save();
        return redirect()->back()->with('success', 'extras for service "'+ $extras->service->title +'" updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $extras = ServiceExtras::findOrFail($id);
        foreach(Order::pluck('extras')->all() as $orderExtras){
            if (in_array($id, json_decode($orderExtras))) {
                return redirect()->back()->with('error', 'Failed to delete extras, because it\'s still used in unfinished orders');
            }
        }
        $extras->delete();
        return redirect()->back()->with('success', 'extras for service "'+ $extras->service->title +'" updated successfully');
    }
}
