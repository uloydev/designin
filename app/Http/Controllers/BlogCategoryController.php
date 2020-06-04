<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function show($id, Request $request)
    {
        if ($request->has('search_blog')) {
            $articles = Blog::where('category_id', $id)->where('title', 'like', '%'.$request->search_blog.'%')
            ->orWhere('contents', 'like', '%'.$request->search_blog.'%')->paginate(9);
            $pagination = $articles->appends ( array (
                'search_blog' => $request->search_blog 
            ) );
        } 
        else if ($request->has('filter')){
            $articles = Blog::where('category_id', $id);
            if ($request->filter == 'latest'){
                $articles = $articles->latest();
            }elseif ($request->filter == 'oldest') {
                $articles = $articles->oldest();
            }elseif ($request->filter == 'popular') {
                $articles = $articles->orderBy('hits', 'DESC');
            }else{
                return abort(404);
            }
            $articles = $articles->paginate(9);
            $pagination = $articles->appends ( array (
                'filter' => $request->filter 
            ) );
        }
        else {
            $articles = Blog::where('category_id', $id)->paginate(9);
        }
        $articleCategory = BlogCategory::findOrFail($id);
        return view('blog.category', ['articles' => $articles, 'articleCategory' => $articleCategory]);
    }
}
