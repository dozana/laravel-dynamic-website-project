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
        $blogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all', compact('blogs'));
    }

    public function addBlog()
    {
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('admin.blogs.blogs_add', compact('categories'));
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

    public function editBlog($id)
    {
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('admin.blogs.blogs_edit', compact('blogs','categories'));
    }

    public function updateBlog(Request $request, $id)
    {
        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;

            Blog::findOrFail($id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
            ]);

            $notification = [
                'message' => 'Blog Updated with Image Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.blog')->with($notification);
        } else {
            Blog::findOrFail($id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
            ]);

            $notification = [
                'message' => 'Blog Updated without Image Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function deleteBlog($id)
    {
        $blogs = Blog::findOrFail($id);
        $img = $blogs->blog_image;

        unlink($img);

        Blog::findOrFail($id)->delete();

        $notification = [
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function blogDetails($id)
    {
        $all_blogs = Blog::latest()->limit(5)->get();
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('site.blog_details', compact('blogs', 'all_blogs', 'categories'));
    }

    public function categoryBlog($id)
    {
        $blog_post = Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->get();
        $all_blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $category_name = BlogCategory::findOrFail($id);
        return view('site.category_blog_details', compact('blog_post', 'all_blogs','categories','category_name'));
    }

    public function homeBlog()
    {
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $all_blogs = Blog::latest()->paginate(3);

        return view('site.blog', compact('all_blogs', 'categories'));
    }
}
