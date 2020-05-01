<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use App\BlogCategory;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    private $upload_path = "uploads/images";

    public function index()
    {
        $blogs = Blog::with(['category', 'author'])->orderBy('created_at', 'DESC')->paginate(10);
        $number = $blogs->firstItem();
        return view('blog.manage', ['blogs' => $blogs, 'number' => $number]);
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('blog.create')->with('categories', $categories);
    }

    public function store(BlogRequest $request)
    {
        // $request->validate([
        //     'title'=>'required',
        //     'header_image'=>'file|mimes:jpg,jpeg,png,gif,svg',
        //     'category_id'=>'required',
        //     'content'=>'required',
        // ]);
        $data = [
            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'contents'=>$request->contents,
            'author_id'=>Auth::user()->id,
        ];
        if ($request->hasFile('header_image')) {
            $img_path = $request->file('header_image')->store('public/img');
            $data['header_image'] = $img_path;
        }
        dd($data);
        Blog::create($data);
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
        $categories = BlogCategory::all();
        return view('blog.edit', ['article'=> $article, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(BlogRequest $request, $id)
    {
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
