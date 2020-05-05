<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{

    public function index()
    {
        return view('blog.');
    }

    public function create()
    {
        return view('admin.blog-category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);
        BlogCategory::create($request->all());
        return redirect()->back()->with('success', 'Blog Category Successfuly Created');
    }

    public function show(BlogCategory $blogCategory)
    {
        return view('blog.category', ['blogCategory', $blogCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $blog_category = BlogCategory::where('id', $id)->get();
        return view('admin.blog-category.edit')->with('category', $blog_category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category'=>'required'
        ]);
        BlogCategory::update($request->all())->where('id', $id);
        return redirect()->route('manage.blog-category.edit')->with('success', 'Blog Category Successfuly Updated');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->blogs()->delete();
        $category->delete();
        return redirect()->back()->with('success', 'Blog Category Successfuly Deleted');
    }
}
