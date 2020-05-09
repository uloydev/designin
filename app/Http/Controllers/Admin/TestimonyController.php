<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Testimony;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonies = Testimony::orderBy('is_main', 'DESC')->paginate(10);
        return view('admin.testimony.index', ['testimonies' => $testimonies]);
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
        $testimony = Testimony::findOrFail($id);
        $request->validate(['is_main' => 'required']);
        if ($testimony->is_main == $request->is_main) {
            if (count(Testimony::where('is_main', 1) < 6)) {
                $testimony->is_main = $request->is_main;
                $testimony->save();
                return redirect()->back()->with('success', 'Testimony Updated Successfully');
            }
        }
        return redirect()->back()->with('error', 'Testimony Slot Is Full');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimony = Testimony::findOrFail($id);
        $testimony->delete();
        return redirect()->back()->with('success', 'Testimony Deleted Successfully');        
    }
}
