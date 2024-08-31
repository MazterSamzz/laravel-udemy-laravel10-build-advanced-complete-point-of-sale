<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Backend\Category;
use App\Models\Backend\Supplier;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('backend.products.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $request->validated();

        if (isset($product['image']))
            $product['image'] = ImageHelper::saveImage($product['image'], 'images/product-images');

        Product::create($product);

        $notification = array(
            'message' => 'Product created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
