<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function index()
    {
        $serviceCategories = ServiceCategory::orderBy('name', 'asc')->get();
        $services = Service::where('agent_id', Auth::id())->get();
        return view('service.index', ['serviceCategories' => $serviceCategories, 'services' => $services]);
    }

    public function store(Request $request)
    {
        $service = new Service;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->image = $request->file('image')->store('public/files');
        $service->agent_id = $request->agent_id;
        $service->service_category_id = $request->service_category_id;

        $service->save();
        return redirect()->back()->with('create', 'Succesfully create new service');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $serviceCategories = ServiceCategory::all();
        return view('service.edit', ['service' => $service, 'serviceCategories' => $serviceCategories]);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->title = $request->service_title;
        $service->description = $request->service_description;
        $service->service_category_id = $request->category;
        if ($request->hasFile('service_img')) {
            Storage::delete($service->image);
            $path = $request->file('service_img')->store('public/files');
            $service->image = $path;
        }
        $service->save();
        return redirect()->route('agent.service.index')->with('success_update', 'Succesfully edit service');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        Storage::delete($service->image);
        $service->delete();
        return redirect()->back()->with('delete', 'Succefully delete service');
    }

    public function progress($id)
    {
        //
    }
}
