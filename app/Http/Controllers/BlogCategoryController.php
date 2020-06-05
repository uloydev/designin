<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function show($id, Request $request)
    {
        $query = '';
        if ($request->has('search_blog')) {
            $query = $request->search_blog;
            $articles = Blog::where('category_id', $id)
                        ->where('title', 'LIKE', '%'.$request->search_blog.'%')
                        ->orWhere('contents', 'LIKE', '%'.$request->search_blog.'%')->paginate(9);
            $articles->appends($request->only('search_blog'));
        }
        else if ($request->has('filter')){
            $query = $request->filter;
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
            $articles->appends($request->only('search_blog'));
        }
        else {
            $articles = Blog::where('category_id', $id)->paginate(9);
        }
        $articleCategory = BlogCategory::findOrFail($id);
        return view('blog.category', [
            'articles' => $articles,
            'articleCategory' => $articleCategory,
            'query' => $query
        ]);
    }
}
