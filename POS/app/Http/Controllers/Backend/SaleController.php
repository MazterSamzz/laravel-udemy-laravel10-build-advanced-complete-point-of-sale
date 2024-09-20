<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Sale;
use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Models\Backend\Customer;
use App\Models\Backend\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Cart::content();
        dd($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function pos()
    {
        $products = Product::all();
        $customers = Customer::all();
        $carts = Cart::content();

        $display = [
            'qty' => Cart::count(),
            'subtotal' => Cart::count(),
            'tax' => Cart::tax(),
            'total' => Cart::total()
        ];
        return view('backend.sales.pos', compact('products', 'customers', 'carts', 'display'));
    }

    public function addCart(Product $product)
    {
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->selling_price,
            'weight' => 0,
        ]);

        $notification = [
            'message' => 'Product added to cart successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function updateCart($rowId)
    {
        $qty = request()->qty;

        Cart::update($rowId, $qty);

        $notification = [
            'message' => 'Qty updated successfully',
            'alert-type' => 'success'
        ];

        return to_route('sales.pos')->with($notification);
    }
}
