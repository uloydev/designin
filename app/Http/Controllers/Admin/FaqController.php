<?php

namespace App\Http\Controllers\Admin;

use App\FaqCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::paginate(10);
        $faqCategory = FaqCategory::all();
        return view('faq.manage', ['faqs' => $faqs, 'faqCategory' => $faqCategory]);
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        Faq::create($request->all());
        return redirect()->route('manage.faq.index')->with('success', 'Faq Created Successfully');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:faq_category'
        ]);
        FaqCategory::create(["category" => $request->category]);
        return redirect()->back()->with('success', 'Successfully Created category');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit')->with('faq', $faq);
    }

    public function update(FaqRequest $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->back()->with('success','Faq Updated Successfully');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Faq Deleted Successfully');
    }

    public function destroyCategory($id)
    {
        $faqCategory = FaqCategory::findOrFail($id);
        $faqCategory->faqs()->delete();
        $faqCategory->delete();
        return redirect()->back()->with('success', 'Succesfully delete ' . $faqCategory->category . ' category');
    }

    public function search(Request $request)
    {
        $query = $request->search_faq;
        $faqs = Faq::where('question', 'LIKE', '%' . $query . '%')
            ->orWhere('answer', 'LIKE', '%' . $query . '%')->get();
        $faqCategories = FaqCategory::all();
        return view('faq.index', ['faqs' => $faqs, 'faqCategories' => $faqCategories, 'query' => $query]);
    }
}
