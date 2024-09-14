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

        return to_route('expenses.create')->with($notification);
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
        $filter = strtolower(request()->query('filter'));
        $filter = $filter == 'Today' ? 'date' : $filter;

        return view('backend.expenses.edit', compact(['expense', 'filter']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        $filter = request()->query('filter') ?? 'date';

        $notification = array(
            'message' => 'Expense updated successfully!',
            'alert-type' => 'success',
        );

        return to_route('expenses.filter', ['filter' => $filter])->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        $filter = strtolower(request()->query('filter'));
        $filter = $filter == 'Today' ? 'date' : $filter;

        $notification = array(
            'message' => 'Expense deleted successfully!',
            'alert-type' => 'success',
        );

        return to_route('expenses.filter', ['filter' => $filter])->with($notification);
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
