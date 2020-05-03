<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{

    public function index()
    {
        return view('blog.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);
        dd(BlogCategory::create($request->all()));
        return redirect()->back()->with('success', 'Blog Category Successfuly Created');
    }

    /**
     * Display the specified resource.
     *
     * @param BlogCategory $blogCategory
     * @return Application|Factory|View
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category'=>'required'
        ]);
        BlogCategory::update($request->all())->where('id', $id);
        return redirect()->route('manage.blog-category.edit')->with('success', 'Blog Category Successfuly Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        BlogCategory::where('id', $id)->delete();
        return redirect()->route('manage.blog-category.index')->with('success', 'Blog Category Successfuly Deleted');
    }
}
