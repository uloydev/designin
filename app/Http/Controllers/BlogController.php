<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\BlogCategory;

class BlogController extends Controller
{
    private $popular;
    private $categories;

    public function __construct()
    {
        $this->popular = Blog::orderBy('hits', 'desc')->take(3)->get();
        $this->categories = BlogCategory::all();
    }

    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blog.index')->with(['blogs'=> $blogs, 'popular'=>$this->popular, 'categories' => $this->categories]);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if($blog){
            if (!$blog->hits) {
                $blog->hits = 1;
            }else{
                $blog->hits += 1;
            }
            $blog->update();
            $related_blogs = Blog::orderByRaw('RAND()')->where('id', '!=', $id)->take(3)->get();
            return view('blog.single')->with(['blog'=>$blog, 'related'=>$related_blogs, 'popular'=>$this->popular, 'categories' => $this->categories]);
        }else{
            return abort('404');
        }
    }
}
