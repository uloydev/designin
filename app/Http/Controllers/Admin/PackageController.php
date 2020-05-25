<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Service;
use App\Order;

class PackageController extends Controller
{

    public function index()
    {
        $service = Service::findOrFail($id);
        $allPackage = Package::where('service_id', $id)->paginate(10);
        return view('service.package', ['allPackage' => $allPackage, 'service' => $service]);
    }

    public function create()
    {
        //
    }

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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $package = package::findOrFail($id);
        return view('package.manage', ['package' => $package]);
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->title = $request->title;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->duration = $request->duration;
        $package->token_price = $request->token_price;
        $package->save();
        return redirect()->back()->with('success', 'package for "' . $package->service->title . '" updated successfully');
    }

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
