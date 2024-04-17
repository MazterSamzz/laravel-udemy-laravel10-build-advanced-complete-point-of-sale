<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_categories = BlogCategory::all();
        return view('admin.blog_categories.index', compact('blog_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'Blog Category Name is Required'
        ]);

        $blog_categories = new BlogCategory;

        $blog_categories->name = $request->name;
        $blog_categories->save();

        $notification = array(
            'message' => 'Blog Category created Successfully',
            'alert-type' => 'success',
        );

        return to_route('blog-categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blog_category)
    {
        $blogs = Blog::where('blog_category_id', $blog_category->id)->orderBy('id', 'desc')->get();
        $categories = BlogCategory::orderBy('name', 'asc')->get();

        $breadcrumb['title'] = $blog_category->name;
        $breadcrumb['item'] = strtoupper($blog_category->name) . ' BLOGS';

        return view('frontend.blog_category_details', compact('blog_category', 'blogs', 'categories', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blog_category)
    {
        return view('admin.blog_categories.edit', compact('blog_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blog_category)
    {
        $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'Blog Category Name is Required'
        ]);

        $blog_category->name = $request->name;
        $blog_category->save();

        $notification = array(
            'message' => 'Blog category name updated Successfully',
            'alert-type' => 'success'
        );

        return to_route('blog-categories.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();
        
        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return to_route('blog-categories.index')->with($notification);
    }
}
