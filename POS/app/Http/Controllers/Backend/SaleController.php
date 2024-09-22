<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Sale;
use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Models\Backend\Product;
use App\Models\Backend\SalesDetail;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = $request->validated();
        $sale['customer_id'] = $validated['customer_id'];
        $sale['date'] = date('Y-m-d');
        $sale['status'] = 1;
        $sale['total_products'] = str_replace(',', '', Cart::subtotal());
        $sale['vat'] = str_replace(',', '', Cart::tax());
        $sale['total'] = str_replace(',', '', Cart::total());

        if ($validated['paid'] < $sale['total']) {
            $sale['paid'] = $validated['paid'];
            $sale['recieveables'] = bcsub($sale['total'], $sale['paid']);
        } else {
            $sale['change'] = $sale['paid'] - $sale['total'];
            $sale['paid'] = $sale['total'];
        }

        switch ($request->validated()['payment']) {
            case 'Cheque':
                $sale['payment_status'] = 2;
                break;
            case 'Due':
                $sale['payment_status'] = 3;
                break;

            default:
                $sale['payment_status'] = 1;
                break;
        }

        $sale = Sale::create($sale);
        $carts = Cart::content();
        $data = [];

        foreach ($carts as $value) {
            $data['sale_id'] = $sale->id;
            $data['product_id'] = $value->id;
            $data['cogs'] = number_format(Product::find($value->id)->buying_price, 2, '.', '');
            $data['qty'] = $value->qty;
            $data['price'] = $value->price;
            $data['total_price'] = bcmul($value->qty, $value->price, 2);
            SalesDetail::create($data);
        }

        Cart::destroy();

        $notification = [
            'message' => 'Sale created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('pos.index')->with($notification);
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
}
