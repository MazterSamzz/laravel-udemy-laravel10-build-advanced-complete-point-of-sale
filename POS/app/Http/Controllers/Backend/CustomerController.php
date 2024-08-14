<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Customer;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('backend.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $request->validated();

        if (isset($customer['photo'])) {
            $customer['photo'] = ImageHelper::saveImage($customer['photo'], 'images/customer-photos');
        }

        Customer::create($customer);

        $notification = array(
            'message' => 'Customer created successfully.',
            'alert-type' => 'success'
        );

        return to_route('customers.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('backend.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();

        // Save the image and Delete the previous image
        if (isset($data['photo'])) {
            $data['photo'] = ImageHelper::saveImage($data['photo'], 'images/customer-photos');
            if ($customer->photo)
                ImageHelper::softDelete($customer->photo, $customer->name);
        }

        $customer->update($data);

        $notification = array(
            'message' => 'Customer updated successfully.',
            'alert-type' => 'success'
        );

        return to_route('customers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if (isset($customer->photo))
            ImageHelper::softDelete($customer->photo, $customer->name);

        $customer->delete();

        $notification = array(
            'message' => 'Employee deleted successfully.',
            'alert-type' => 'success'
        );

        return to_route('customers.index')->with($notification);
    }
}
