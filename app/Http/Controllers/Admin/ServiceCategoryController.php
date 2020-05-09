<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryController extends Controller
{

    public function index()
    {
        $serviceCategory = ServiceCategory::all();
        return view('service.category', ['serviceCategory' => $serviceCategory]);
    }

    public function store(Request $request)
    {
        $serviceCategory = new ServiceCategory;
        $serviceCategory->name = $request->service_category;
        $serviceCategory->image_url = $request->file('image_url')->store('public/files');
        $serviceCategory->save();
        return redirect()->back()->with('create', 'Succesfully create new service category');
    }

    public function update(Request $request, Service $serviceCategory)
    {
        $serviceCategory->name = $request->service_category;
        if ($request->hasFile('image_url')) {
            Storage::delete($serviceCategory->image_url);
            $serviceCategory->image_url = $request->file('image_url')->store('public/files');
        }
        $serviceCategory->save();
        return redirect()->route('manage.service.category');
    }

    function destroy(Service $serviceCategory)
    {
        Storage::delete($serviceCategory->image_url);
        $serviceCategory->delete();
        return redirect()->route('manage.service.category');
    }
}
