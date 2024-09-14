<?php

namespace App\Http\Controllers;

use App\Models\Backend\Expense;
use App\Http\Requests\Expense\ExpenseRequest;

class ExpenseController extends Controller
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
        return view('backend.expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        Expense::create($request->validated());

        $notification = array(
            'message' => 'Expense created successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('expenses.create')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }

    /**
     * Filter expenses by date, month, or year.
     *
     * @param string $filter
     * @return \Illuminate\Http\Response
     */
    public function filter($filter)
    {
        switch ($filter) {
            case 'month':
                $date = date('m');
                break;

            case 'year':
                $date = date('Y');
                break;

            default:
                $date = date('Y-m-d');
                break;
        }

        $expenses = Expense::where($filter, $date)->latest()->get();

        $amount = $expenses->sum('amount');
        $amount = 'Rp. ' . number_format($amount, 2);

        if ($filter == 'date')
            $filter = 'Today';
        else
            $filter = ucfirst($filter);

        return view('backend.expenses.filter', compact(['expenses', 'amount', 'filter']));
    }
}
