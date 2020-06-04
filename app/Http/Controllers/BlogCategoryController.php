<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function show($id)
    {
        $articles = Blog::where('category_id', $id)->paginate(10);
        $articleCategory = BlogCategory::findOrFail($id);
        return view('blog.category', ['articles' => $articles, 'articleCategory' => $articleCategory]);
    }
    public function filtering($id, Request $request)
    {
        $articleCategory = BlogCategory::findOrFail($id);
        if ($request->filter == 'hits') {
            $articles = Blog::where('category_id', $id)->orderBy('hits', 'DESC')->paginate(10);
            $articles->appends($request->only('filter'));
            return view('blog.category', ['articles' => $articles, 'articleCategory' => $articleCategory]);
        }
        else if ($request->filter == 'DESC' or $request->filter == 'ASC') {
            $articles = Blog::where('category_id', $id)->orderBy('created_at', $request->filter)->paginate(10);
            $articles->appends($request->only('filter'));
            return view('blog.category', ['articles' => $articles, 'articleCategory' => $articleCategory]);
        }
    }
}
