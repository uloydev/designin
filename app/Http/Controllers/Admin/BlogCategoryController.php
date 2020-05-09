<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{

    public function index()
    {
        $blogCategories = BlogCategory::paginate(10);
        return view('admin.blog-category.index', ['categories' => $blogCategories]);
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
        return redirect()->route('manage.blog-category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        return view('admin.blog-category.edit')->with('category', $blog_category);
    }

    public function update(Request $request, $id)
    {
        $blogCategory = BlogCatgory::findOrFail($id);
        $request->validate([
            'category'=>'required'
        ]);
        $blogCategory->name = $request->category;
        $blogCategory->save();
        return redirect()->route('manage.blog-category.index');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        $blogs = $category->blogs();
        foreach ($blogs as $blog) {
            Storage::delete($blog->header_image);
            $blog->delete();
        }
        $category->delete();
        return redirect()->route('manage.blog-category.index');
    }
}
