<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{

    public function index()
    {
        $blogCategories = BlogCategory::paginate(10);
        return view('admin.blog-category.index', ['categories' => $blogCategories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|alpha_dash'
        ]);
        BlogCategory::create($request->all());
        return redirect()->back()->with('create_category', 'Category Created Succefully');
    }

    public function update(Request $request, $id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        $request->validate([
            'edit_category' => 'required|alpha_dash'
        ]);
        $blogCategory->name = $request->edit_category;
        $blogCategory->save();
        return redirect()->back()->with('edit_category', 'Category Updated Succefully');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        $blogs = $category->blogs();
        $blogs->delete();
        foreach ($blogs as $blog) {
            Storage::delete($blog->header_image);
        }
        $category->delete();
        return redirect()->back()->with('delete_category', 'Category Deleted Succefully');
    }
}
