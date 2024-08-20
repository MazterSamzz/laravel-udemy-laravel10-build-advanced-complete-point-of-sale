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
        $employees = Employee::all();
        return view('backend.salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalaryRequest $request)
    {
        $salary = $request->validated();

        // Check if salary already exists
        $duplicate = Salary::where("employee_id", $request->input('employee_id'))
            ->where("month", $request->input('month'))
            ->where("year", $request->input('year'))->first();

        if ($duplicate) {
            return redirect()->back()->withInput()->with([
                'message' => 'Salary record already exists for this employee, month, and year.',
                'alert-type' => 'warning'
            ]);
        }
        // End of Check if salary already exists

        Salary::create($salary);

        $notification = array(
            'message' => 'Salary created successfully.',
            'alert-type' => 'success'
        );

        return to_route('salaries.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('backend.salaries.edit', compact(['salary', 'employees']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        $data = $request->validated();

        // Check if salary already exists
        $duplicate = Salary::where("employee_id", $request->input('employee_id'))
            ->where("month", $request->input('month'))
            ->where("year", $request->input('year'))
            ->where("id", "!=", $salary->id)->first();

        if ($duplicate) {
            return redirect()->back()->withInput()->with([
                'message' => 'Salary record already exists for this employee, month, and year.',
                'alert-type' => 'warning'
            ]);
        }
        // End Check if salary already exists

        $salary->update($data);

        $notification = array(
            'message' => 'Salary Updated successfully.',
            'alert-type' => 'success'
        );

        return to_route('salaries.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();

        $notification = array(
            'message' => 'Salary deleted successfully.',
            'alert-type' => 'success'
        );

        return to_route('salaries.index')->with($notification);
    }
}
