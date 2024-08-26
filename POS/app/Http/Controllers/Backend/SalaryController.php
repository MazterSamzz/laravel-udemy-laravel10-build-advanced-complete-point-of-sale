<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Salary;
use App\Http\Requests\Salary\StoreSalaryRequest;
use App\Http\Requests\Salary\UpdateSalaryRequest;
use App\Models\Backend\Employee;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::latest()->get();
        return view('backend.salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::latest()->get();
        return view('backend.salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalaryRequest $request)
    {
        $salary = $request->validated();

        // Check if advance salary already exists
        $duplicate = Salary::where("employee_id", $request->input('employee_id'))
            ->where("month", $request->input('month'))
            ->where("year", $request->input('year'))->first();

        if ($duplicate) {
            return redirect()->back()->withInput()->with([
                'message' => "Salary already paid for this employee in {$salary['month']}/{$salary['year']}.",
                'alert-type' => 'warning'
            ]);
        }

        // End of Check if salary already exists
        Salary::create($salary);
        return to_route('salaries.index')->with([
            'message' => 'Salary paid successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $salary)
    {
        $employee = $salary;
        return view('backend.salaries.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
