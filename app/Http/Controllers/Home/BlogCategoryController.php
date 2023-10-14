<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogCategoryController extends Controller
{
    public function allBlogCategory()
    {
        $blog_category = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all', compact('blog_category'));
    }

    public function addBlogCategory()
    {
        return view('admin.blog_category.blog_category_add');
    }

    public function storeBlogCategory(Request $request)
    {
        $request->validate([
            'blog_category' => 'required',
        ], [
            'blog_category.required' => 'Blog Category Name is Required',
        ]);

        BlogCategory::insert([
            'blog_category' => $request->blog_category,
        ]);

        $notification = [
            'message' => 'Blog Category name Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.blog.category')->with($notification);
    }
}
