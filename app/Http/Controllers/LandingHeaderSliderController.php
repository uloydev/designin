<?php

namespace App\Http\Controllers;

use App\LandingHeaderSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingHeaderSliderController extends Controller
{

    public function index()
    {
        $sliders = LandingHeaderSlider::all();
        return view('admin.main-slider', ['sliders' => $sliders]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'slider' => 'required|file|mimes:jpg,jpeg,png,gif,svg,webp'
        ]);
        $slider = new LandingHeaderSlider;
        $slider->img = $request->file('slider')->store('public/files');
        $slider->save();

        return redirect()->back()->with('success', 'Succefully add new slider');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'slider' => 'required|file|mimes:jpg,jpeg,png,gif,svg,webp'
        ]);
        $slider = LandingHeaderSlider::findOrFail($id);
        Storage::delete($slider->img);
        $slider->img = $request->file('slider')->store('public/files');
        $slider->save();

        return redirect()->back()->with('success', 'Succefully update slider');
    }

    public function destroy($id)
    {
        $slider = LandingHeaderSlider::findOrFail($id);
        Storage::delete($slider->img);
        $slider->delete();

        return redirect()->back()->with('success', 'Succefully delete slider');
    }
}
