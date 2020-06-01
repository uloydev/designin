<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use App\BlogCategory;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        $number = $blogs->firstItem();
        $blogCategories = BlogCategory::all();
        return view('blog.manage-article', [
            'blogs' => $blogs,
            'number' => $number,
            'blogCategories' => $blogCategories
        ]);
    }

    public function create()
    {
        $mainArticles = Blog::where('is_main', true)->count();
        $categories = BlogCategory::all();
        return view('blog.create-article', ['categories' => $categories, 'mainArticles' => $mainArticles]);
    }

    public function store(Request $request)
    {
        $img_path = $request->file('header_image')->store('public/files');
        $createBlog = new Blog;
        $createBlog->header_image = $img_path;
        $createBlog->title = $request->title;
        $createBlog->category_id = $request->category_id;
        $createBlog->contents = $request->contents;
        if (Blog::all()->count() <= 6) {
            $createBlog->is_main = $request->is_main;
        }else {
            $createBlog->is_main = false;
        }
        $createBlog->save();
        return redirect()->route('manage.blog.index')->with('success', 'Blog Created Successfully');
    }

    public function show($id)
    {
        $blog = Blog::with('category')->findOrFail($id);
        $popular = Blog::orderBy('hits', 'desc')->take(3)->get();
        $related_blogs = Blog::with('category')->inRandomOrder()->take(3)->get()->except($id);
        return view('blog.single', [
            'blog' => $blog,
            'relates' => $related_blogs,
            'popular' => $popular
        ]);
    }

    public function edit($id)
    {
        $article = Blog::findOrFail($id);
        $mainArticles = Blog::where('is_main', true)->count();
        $categories = BlogCategory::all();
        return view('blog.edit', ['article'=> $article, 'categories' => $categories, 'mainArticles' => $mainArticles]);
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
        $blog = Blog::findOrFail($id);
        $request->validate([
            'title'=>'required',
            'header_image'=>'file|mimes:jpg,jpeg,png,gif,svg',
            'category_id'=>'required',
            'contents'=>'required',
        ]);
        $blog->title = $request->title;
        $blog->contents = $request->contents;
        $blog->category_id = $request->category_id;
        if ($request->hasFile('header_image')) {
            Storage::delete($blog->header_image);
            $blog->header_image = $request->file('header_image')->store('public/files');
        }
        $blog->save();
        return redirect()->route('manage.blog.index')->with('success', 'Blog update succefully');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        Storage::delete($blog->header_image);
        $blog->delete();
        return redirect()->route('manage.blog.index')->with('success', 'Blog delete succefully');
    }
}
