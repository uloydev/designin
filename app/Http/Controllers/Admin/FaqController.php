<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::paginate(10);
        return view('admin.faq.index', ['faqs' => $faqs]);
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->vlaidate([
            'question'=>'required',
            'answer'=>'required'
        ]);
        Faq::create($request->all());
        return redirect()->route('manage.faq.create')->with('success', 'Faq Created Successfully');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit')->with('faq', $faq);
    }

    public function update(Request $request, $id)
    {
        $request->vlaidate([
            'question'=>'required',
            'answer'=>'required'
        ]);
        Faq::create($request->all());
        $faq = Faq::findOrFail($id);
        return redirect()->back()->with(['success'=> 'Faq Updated Successfully', 'faq'=>$faq]);
    }

    public function destroy($id)
    {
        Faq::where('id', $id)->delete();
        return redirect()->route('manage.faq.index')->with('success', 'Faq Deleted Successfully');
    }
}
