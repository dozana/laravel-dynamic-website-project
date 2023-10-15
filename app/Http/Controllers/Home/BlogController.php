<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function allBlog()
    {
        $blog = Blog::latest()->get();
        return view('admin.blog.blog_all', compact('blog'));
    }

    public function addBlog()
    {
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('admin.blog.blog_add', compact('categories'));
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'blog_title' => 'required',
            'blog_image' => 'required',
        ], [
            'blog_category_id.required' => 'Blog Category Name is Required',
            'blog_title.required' => 'Blog Title is Required',
        ]);

        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_image' => $save_url,
            'blog_description' => $request->blog_description,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.blog')->with($notification);
    }
}
