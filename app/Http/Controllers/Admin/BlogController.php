<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\BlogCategory;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
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
            'category_id'=>'required',
            'content'=>'required',
        ]);
        $request->request->add([
            'author_id'=>'1'
        ]);
        Blog::create($request->all());
        return redirect()->back()->with(['success'=>'Blog Created Successfully', 'categories'=>BlogCategory::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $related_blogs = Blog::inRandomOrder()->where('id', $id)->take(3)->get();
        return view('blog.single', ['blog' => $blog, 'related '=> $related_blogs, 'popular'=>$this->popular, 'categories' => $this->categories]);
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
            'category_id'=>'required',
            'content'=>'required',
        ]);
        Blog::update($request->all())->where('id', $id);
        return redirect()->back()->with(['success'=>'Blog Updated Successfully', 'blog'=>Blog::find($id), 'categories'=>BlogCategory::all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::delete()->where('id', $id);
        return redirect()->route('manage.blog.index')->with(['success'=>'Blog Deleted Successfully']);
    }
}
