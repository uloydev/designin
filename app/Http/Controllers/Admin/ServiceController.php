<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $services = Service::all();
        $serviceCategories = ServiceCategory::all();
        return view('service.index', ['services' => $services, 'serviceCategories' => $serviceCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Application|Factory|View
     */
    public function edit(Service $service)
    {
        $serviceCategories = ServiceCategory::all();
        return view('service.edit', ['service' => $service, 'serviceCategories' => $serviceCategories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Service $service
     * @return RedirectResponse
     */
    public function update(Request $request, Service $service)
    {
        $service->title = $request->service_title;
        $service->description = $request->service_description;
        $service->service_category_id = $request->category;
        if ($request->hasFile('service_img')) {
            Storage::delete($service->image);
            $path = $request->file('service_img')->store('public/files');
            $service->image = $path;
        }
        $service->save();
        return redirect()->route('manage.service.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        Storage::delete($service->image);
        $service->delete();
        return redirect()->back()->with('delete', 'Succefully deleted service');
    }
}
