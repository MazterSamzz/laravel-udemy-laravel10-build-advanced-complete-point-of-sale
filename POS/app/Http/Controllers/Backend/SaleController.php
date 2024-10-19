<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Backend\Sale;
use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Models\Backend\Product;
use App\Models\Backend\SalesDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data sales dengan relasi customer
        $all = Sale::with('customer')->get();

        // Filter dan bagi berdasarkan payment_status
        $sales = [
            'awaiting' => $all->filter(fn($sale) => in_array($sale->payment_status, [
                PaymentStatus::Unpaid,
                PaymentStatus::NotYet,
                PaymentStatus::Overdue
            ])),
            'cancel'   => $all->filter(fn($sale) => in_array($sale->payment_status, [
                PaymentStatus::Canceling,
                PaymentStatus::Canceled
            ])),
            'paid'     => $all->filter(fn($sale) => in_array($sale->payment_status, [
                PaymentStatus::Authorized,
                PaymentStatus::Paid
            ])),
            'refund'   => $all->filter(fn($sale) => in_array($sale->payment_status, [
                PaymentStatus::Refunding,
                PaymentStatus::Refunded
            ])),
        ];

        return view('backend.sales.index', compact('sales'));
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

        if ($validated['paid'] <= $sale['total']) {
            $sale['paid'] = $validated['paid'];
            $sale['recieveables'] = bcsub($sale['total'], $sale['paid']);
        } else {
            $sale['change'] = $validated['paid'] - $sale['total'];
            $sale['paid'] = $sale['total'];
        }

        switch ($request->validated()['payment']) {
            case 'Cheque':
                $sale['payment_status'] = 2;
                break;
            case 'Due':
                $sale['payment_status'] = 2;
                break;

            default:
                $sale['payment_status'] = 1;
                break;
        }

        $sale = Sale::create($sale);
        $carts = Cart::content();

        try {
            DB::transaction(function () use ($sale, $carts) {
                $data = [];

                foreach ($carts as $value) {
                    $product = Product::where('id', $value->id)->lockForUpdate()->first();

                    $data['sale_id'] = Crypt::decryptString($sale->id);
                    $data['product_id'] = $value->id;
                    $data['cogs'] = number_format($product->buying_price, 2, '.', '');
                    $data['qty'] = $value->qty;
                    $data['price'] = $value->price;
                    $data['total_price'] = bcmul($value->qty, $value->price, 2);

                    SalesDetail::create($data);

                    $product->update([
                        'store' => bcsub($product->store, $value->qty, 2)
                    ]);
                }

                Cart::destroy();
            });

            $notification = [
                'message' => 'Sale created successfully',
                'alert-type' => 'success'
            ];
            return to_route('pos.index')->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            return to_route('pos.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $salesDetails = SalesDetail::with('product')->where('sale_id', Crypt::decryptString($sale->id))->latest()->get();

        return view('backend.sales.show', compact('sale', 'salesDetails'));
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

    public function importPage()
    {
        //
    }

    public function complete(Sale $sale)
    {
        if ($sale->payment_status->value == 6 || $sale->payment_status->value == 7) {
            $sale->update([
                'status' => 7,
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Please make payment first', 'alert-type' => 'error']);
        }

        return redirect()->back()->with(['message' => 'Order Received', 'alert-type' => 'success']);
    }

    public function pdf(Sale $sale)
    {
        $salesDetails = SalesDetail::with('product')->where('sale_id', Crypt::decryptString($sale->id))->latest()->get();

        $pdf = Pdf::loadView('backend.sales.pdf', compact('sale', 'salesDetails'))
            ->setPaper([0, 0, $this->cmToPx(21), $this->cmToPx(29.7)], 'portrait')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);

        return $pdf->stream('invoice.pdf');
    }

    function cmToPx($cm)
    {
        return $cm * 37.7952755906;
    }
}
