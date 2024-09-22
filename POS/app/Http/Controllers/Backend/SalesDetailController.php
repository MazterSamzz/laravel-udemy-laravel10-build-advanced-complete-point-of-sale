<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\SalesDetail;
use App\Http\Requests\SalesDetail\StoreSalesDetailRequest;
use App\Http\Requests\SalesDetail\UpdateSalesDetailRequest;

class SalesDetailController extends Controller
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
    public function store(StoreSalesDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesDetailRequest $request, SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesDetail $salesDetail)
    {
        //
    }
}
