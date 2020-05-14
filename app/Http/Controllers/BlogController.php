<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(5);
        $populars = Blog::orderBy('hits', 'DESC')->take(3)->get();
        $mainArticle = Blog::where('is_main', true)->orderBy('updated_at', 'DESC')->take(6)->get();
        $categories = BlogCategory::all();
        return view('blog.index', ['blogs'=> $blogs, 'populars' => $populars, 'categories' => $categories, 'mainArticle' => $mainArticle]);
    }

    public function show($id)
    {
        $blog = Blog::with(['category', 'author'])->findOrFail($id);
        $blog->hits = (!$blog->hits) ? 1 : $blog->hits++;
        $blog->update();
        $popular = Blog::orderBy('hits', 'desc')->take(3)->get();
        $blog_categories = BlogCategory::all();
        $related_blogs = Blog::with(['category', 'author'])->inRandomOrder()->take(3)->get()->except($id);
        return view('blog.single', [
            'blog' => $blog,
            'relates' => $related_blogs,
            'popular' => $popular,
            'categories' => $blog_categories
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return Blog [json]
     */
    public function search(Request $request)
    {
        $blogs = Blog::with(['category', 'author'])->where('title', 'LIKE', '%'.$request->get('query').'%')->get();
        return ['blogs' => $blogs];
    }
}
