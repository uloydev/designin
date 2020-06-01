<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceCategory;
use Illuminate\Http\Request;
use App\Service;
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
        $request->validate([
            'name' => 'required|min:3',
            'image_url' => 'required|image|max:2000'
        ]);
        $serviceCategory = new ServiceCategory;
        $serviceCategory->name = $request->name;
        if ($request->hasFile('image_url')) {
            $serviceCategory->image_url = $request->file('image_url')->store('public/files');
        }
        $serviceCategory->save();
        return redirect()->back()->with('success', 'Successfully create new service category');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'image_url' => 'bail|nullable|max:2000|image'
        ]);
        $serviceCategory = ServiceCategory::findOrFail($id);
        $serviceCategory->name = $request->name;
        if ($request->hasFile('image_url')) {
            Storage::delete($serviceCategory->image_url);
            $serviceCategory->image_url = $request->file('image_url')->store('public/files');
        }
        $serviceCategory->save();
        return redirect()->back()->with('success', 'Successfully update category');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        Storage::delete($serviceCategory->image_url);
        foreach ($serviceCategory->services() as $service) {
            Storage::delete($service->image_url);
        }
        $serviceCategory->services()->delete();
        $serviceCategory->delete();
        return redirect()->back()->with('success', 'Successfully delete category ' . $serviceCategory->name);
    }
}
