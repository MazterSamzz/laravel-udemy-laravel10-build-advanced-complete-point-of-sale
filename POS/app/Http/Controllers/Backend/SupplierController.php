<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Supplier;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('backend.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = $request->validated();

        if (isset($supplier['photo'])) {
            $supplier['photo'] = ImageHelper::saveImage($supplier['photo'], 'images/suppliers-photos');
        }

        Supplier::create($supplier);

        $notification = array(
            'message' => 'Supplier created successfully.',
            'alert-type' => 'success'
        );

        return to_route('suppliers.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}