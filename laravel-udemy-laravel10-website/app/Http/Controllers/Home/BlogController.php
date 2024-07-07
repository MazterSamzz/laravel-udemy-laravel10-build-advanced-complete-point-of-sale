<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Helpers\ImageIntervention;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::orderBy('name', 'asc')->get();
        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ],[
            'blog_category_id.required' => 'Blog category is required',
            'title.required' => 'BLog title is required',
            'image.image' => 'Image must be image',
            'image.mimes' => 'Image must be a files of type: jpeg, png, jpg, gif',
            'image.max' => 'Image must not exceed 1MB',
        ]);

        $blog = new Blog;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->title = $request->title;
        $blog->tags = $request->tags;
        $blog->description = $request->description;

        if($request->file('image')){
            $blog->image = ImageIntervention::saveRezisedImage(
                $request->file('image'),
                'upload/blog/',
                430, 327
            );
        }

        if($blog->save()) {
            $notification = array(
                'message' => 'Blog Inserted successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Failed to insert blog',
                'alert-type' => 'error'
            );
        }

        return to_route('blogs.index')->with($notification);

    } // end of Store

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::all();

        $breadcrumb['title'] = $blog->title;
        $breadcrumb['item'] = 'BLOG DETAILS';

        return view('frontend.blog_details', compact('blog', 'blogs', 'categories', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::orderBy('name', 'asc')->get();
        return view('admin.blogs.edit', compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ],[
            'blog_category_id.required' => 'Blog category is required',
            'title.required' => 'BLog title is required',
            'image.image' => 'Image must be image',
            'image.mimes' => 'Image must be a files of type: jpeg, png, jpg, gif',
            'image.max' => 'Image must not exceed 1MB',
        ]);

        $blog->blog_category_id = $request->blog_category_id;
        $blog->title = $request->title;
        $blog->tags = $request->tags;
        $blog->description = $request->description;

        if($request->file('image')){
            $blog->image = ImageIntervention::saveRezisedImage(
                $request->file('image'),
                'upload/blog/',
                430, 327
            );
        }

        if($blog->save()) {
            $notification = array(
                'message' => 'Blog updated successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Failed to update blog',
                'alert-type' => 'error'
            );
        }

        return to_route('blogs.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        unlink($blog->image);
        $blog->delete();
        
        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return to_route('blogs.index')->with($notification);
    }

    public function all()
    {
        $blogs = Blog::latest()->paginate(3);
        $breadcrumb['title'] = 'All Blogs';
        $breadcrumb['item'] = '';
        $categories = BlogCategory::orderBy('name', 'asc')->get();

        return view('frontend.blog.index', compact('blogs', 'breadcrumb', 'categories'));
    }

}
