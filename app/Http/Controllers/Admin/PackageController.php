<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Service;
use App\Order;

class PackageController extends Controller
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
        $service = Service::findOrFail($request->service_id);
        $package = new Package;
        $package->title = $request->title;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->duration = $request->duration;
        $package->service_id = $request->service_id;
        $package->token_price = $request->token_price;
        $package->save();
        return redirect()->back()->with('success', 'package for "'+ $service->title +'" created successfully');
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
        $package = package::findOrFail($id);
        return view('package.manage', [
            'package' => $package
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
        $package = Package::findOrFail($id);
        $package->title = $request->title;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->duration = $request->duration;
        $package->token_price = $request->token_price;
        $package->save();
        return redirect()->back()->with('success', 'package for "'+ $package->service->title +'" updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        if (Order::where('package_id', $id)->where('status', '!=', 'finished')->count() > 0) {
            return redirect()->back()->with('error', 'Failed to delete package, because it\'s still have unfinished orders');
        }
        $package->delete();
        return redirect()->back()->with('success', 'package for "'+ $package->service->title +'" deleted successfully');
    }
}
