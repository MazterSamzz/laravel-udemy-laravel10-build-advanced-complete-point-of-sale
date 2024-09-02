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
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('backend.products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            $data['image'] = ImageHelper::saveImage($data['image'], 'images/product-images');
            if ($product->image)
                ImageHelper::softDelete($product->image, $product->name);
        }

        $product->update($data);

        $notification = array(
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        );

        return to_route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->photo)
            ImageHelper::softDelete($product->photo, $product->name);

        $product->delete();

        $notification = array(
            'message' => 'Product deleted successfully.',
            'alert-type' => 'success'
        );

        return to_route('products.index')->with($notification);
    }
}
