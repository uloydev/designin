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
        $blogs = Blog::with(['category', 'author'])->orderBy('created_at', 'DESC')->paginate(10);
        $number = $blogs->firstItem();
        $blogCategories = BlogCategory::all();
        return view('blog.manage-article', ['blogs' => $blogs, 'number' => $number, 'blogCategories' => $blogCategories]);
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
        $createBlog->title = $request->title;
        $createBlog->header_image = $request->header_image;
        $createBlog->category_id = $request->category_id;
        $createBlog->contents = $request->contents;
        $createBlog->header_image = $img_path;
        $createBlog->author_id = Auth::id();
        if (count(Blog::all()) <= 6) {
            $createBlog->is_main = $request->is_main;
        }
        else {
            $createBlog->is_main = false;
        }
        $createBlog->save();
        return redirect()->route('manage.blog.index')->with('success', 'Blog Created Successfully');
    }

    public function show($id)
    {
        $blog = Blog::with(['category', 'author'])->findOrFail($id);
        $popular = Blog::orderBy('hits', 'desc')->take(3)->get();
        $related_blogs = Blog::with(['category', 'author'])->inRandomOrder()->take(3)->get()->except($id);
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
        $request->validate([
            'title'=>'required',
            'header_image'=>'file|mimes:jpg,jpeg,png,gif,svg',
            'category_id'=>'required',
            'content'=>'required',
        ]);
        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'author_id' => Auth::id(),
        ];
        if (!empty($request->header_image)) {
            $img_path = Storage::putFile($this->upload_path, $request->file('header_image'));
            $data['header_image'] = $img_path;
        }
        Blog::where('id', $id)->update($data);
        return redirect()->route('manage.blog.index')->with('success', 'Blog update succefully');
    }

    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->route('manage.blog.index')->with('success', 'Blog delete succefully');
    }
}
