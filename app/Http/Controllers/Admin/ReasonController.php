<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reason;

class ReasonController extends Controller
{
    public function index()
    {
        $reasons = Reason::paginate(10);
        return view('admin.reason.index', ['reasons' => $reasons]);
    }

    public function create()
    {
        return view('admin.reason.create');
    }

    public function store(Request $request)
    {
        $request->vlaidate([
            'title'=>'required',
            'description'=>'required'
        ]);
        Reason::create($request->all());
        return redirect()->route('manage.reason.create')->with('success', 'Reason Created Successfully');
    }

    public function edit($id)
    {
        $reason = Reason::findOrFail($id);
        return view('admin.reason.edit')->with('reason', $reason);
    }

    public function update(Request $request, $id)
    {
        $request->vlaidate([
            'title'=>'required',
            'description'=>'required'
        ]);
        $reason = Reason::findOrFail($id);
        $reason->title = $request->title;
        $reason->description = $request->description;
        $reason->save();
        return redirect()->back()->with(['success'=> 'Reason Updated Successfully']);
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->back()->with(['success'=> 'Reason Deleted Successfully']);
    }
}
