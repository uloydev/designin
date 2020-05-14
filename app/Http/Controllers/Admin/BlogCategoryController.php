<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);
        BlogCategory::create($request->all());
        return redirect()->back()->with('success', 'Blog Category Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $blogCategory = BlogCatgory::findOrFail($id);
        $request->validate([
            'category'=>'required'
        ]);
        $blogCategory->name = $request->category;
        $blogCategory->save();
        return redirect()->back()->with('success', 'Blog Category Updated Successfully');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        $blogs = $category->blogs();
        foreach ($blogs as $blog) {
            Storage::delete($blog->header_image);
            $blog->delete();
        }
        $category->delete();
        return redirect()->back()->with('success', 'Blog Category Deleted Successfully');
    }
}
