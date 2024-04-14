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
        $blogs = BLog::latest()->get();
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
            'multi_image.image' => 'All Images must be images',
            'multi_image.mimes' => 'All Images must be a files of type: jpeg, png, jpg, gif',
            'multi_image.max' => 'All images must not exceed 1MB',
        ]);

        $blog = new Blog;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->title = $request->title;
        $blog->tags = $request->tags;
        $blog->description = $request->description;
        $blog->image = ImageIntervention::saveRezisedImage(
            $request->file('image'),
            'upload/blog/',
            430, 327
        );

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
