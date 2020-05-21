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
}
