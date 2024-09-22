<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Customer;
use App\Models\Backend\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Crypt;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $customers = Customer::all();
        $carts = Cart::content();

        // Enkripsi ID setiap customer
        $customers->transform(function ($customer) {
            $customer->encrypted_id = Crypt::encryptString($customer->id);
            return $customer;
        });

        $display = [
            'qty' => Cart::count(),
            'subtotal' => Cart::subtotal(),
            'tax' => Cart::tax(),
            'total' => Cart::total()
        ];
        return view('backend.pos.index', compact('products', 'customers', 'carts', 'display'));
    }

    public function store(Product $product)
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

    public function update($rowId)
    {
        $qty = request()->qty;
        Cart::update($rowId, $qty);

        $notification = [
            'message' => 'Qty updated successfully',
            'alert-type' => 'success'
        ];

        return to_route('pos.index')->with($notification);
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);

        $notification = [
            'message' => 'Product removed from cart successfully',
            'alert-type' => 'success'
        ];

        return to_route('pos.index')->with($notification);
    }

    public function createInvoice(Request $request)
    {
        $carts = Cart::content();

        $customer_id = Crypt::decryptString($request->customer_id);
        $customer = Customer::find($customer_id);


        $invoice = [
            'subtotal' => Cart::subtotal(),
            'tax-rate' => 11,
            'tax' => Cart::tax(),
            'total' => Cart::total()
        ];

        return view('backend.pos.create-invoice', compact('carts', 'customer', 'invoice'));
    }
}
