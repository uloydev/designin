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
        $request->validate([
            'title'=> 'required',
            'service_category_id'=> 'required',
            'description'=> 'required',
            'image'=> 'mimes:jpeg,png,gif|max:2000'
        ]);
        Service::create($request->all());
        return redirect()->back()->with('success_create', 'Service Created Successfully');
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
        return redirect()->route('agent.service.index')->with('success_update', 'Succesfully edit service detail');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        Storage::delete($service->image);
        $service->delete();
        return redirect()->back()->with('success_delete', 'Succefully delete service');
    }
}
