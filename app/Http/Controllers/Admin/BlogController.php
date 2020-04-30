<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use App\BlogCategory;
use Auth;

class BlogController extends Controller
{
    private $upload_path = "uploads/images";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with(['blogCategory', 'author'])->latest()->paginate(10);
        $number = $blogs->firstItem();
        return view('blog.manage', ['blogs' => $blogs, 'number' => $number]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('blog.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'header_image'=>'file|mimes:jpg,jpeg,png,gif,svg',
            'category_id'=>'required',
            'content'=>'required',
        ]);
        $data = [
            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'content'=>$request->content,
            'author_id'=>Auth::user()->id,
        ];
        if (!empty($request->header_image)) {
            $img_path = Storage::putFile($this->upload_path, $request->file('header_image'));
            $data['header_image'] = $img_path;
        }
        Blog::create($data);
        return redirect()->back()->with(['success'=>'Blog Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::with(['blogCategory', 'author'])->findOrFail($id);
        $popular = Blog::orderBy('hits', 'desc')->take(3)->get();
        $blog_categories = BlogCategory::all();
        $related_blogs = Blog::with(['blogCategory', 'author'])->orderByRaw('RAND()')->where('id', '!=', $id)->take(3)->get();
        return view('blog.single', [
            'blog' => $blog,
            'related' => $related_blogs,
            'popular' => $popular,
            'categories' => $blog_categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        return view('blog.edit', ['article'=> $article, 'categories' => $categories]);
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
        $request->validate([
            'title'=>'required',
            'header_image'=>'file|mimes:jpg,jpeg,png,gif,svg',
            'category_id'=>'required',
            'content'=>'required',
        ]);
        $data = [
            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'content'=>$request->content,
            'author_id'=>Auth::user()->id,
        ];
        if (!empty($request->header_image)) {
            $img_path = Storage::putFile($this->upload_path, $request->file('header_image'));
            $data['header_image'] = $img_path;
        }
        Blog::where('id', $id)->update($data);
        return redirect()->back()->with(['success'=>'Blog Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->route('manage.blog.index')->with(['success'=>'Blog Deleted Successfully']);
    }
}
