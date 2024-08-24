<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\AdvanceSalary;
use App\Http\Requests\AdvanceSalary\StoreAdvanceSalaryRequest;
use App\Http\Requests\AdvanceSalary\UpdateAdvanceSalaryRequest;
use App\Models\Backend\Employee;

class AdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advanceSalaries = AdvanceSalary::latest()->get();
        return view('backend.advance-salaries.index', compact('advanceSalaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('backend.advance-salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvanceSalaryRequest $request)
    {
        $advanceSalary = $request->validated();

        // Check if advance salary already exists
        $duplicate = AdvanceSalary::where("employee_id", $request->input('employee_id'))
            ->where("month", $request->input('month'))
            ->where("year", $request->input('year'))->first();

        if ($duplicate) {
            return redirect()->back()->withInput()->with([
                'message' => 'Salary record already exists for this employee, month, and year.',
                'alert-type' => 'warning'
            ]);
        }
        // End of Check if salary already exists

        AdvanceSalary::create($advanceSalary);

        $notification = array(
            'message' => 'Advance salary created successfully.',
            'alert-type' => 'success'
        );

        return to_route('advance-salaries.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvanceSalary $advanceSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdvanceSalary $advanceSalary)
    {
        $employees = Employee::all();
        return view('backend.advance-salaries.edit', compact(['advanceSalary', 'employees']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvanceSalaryRequest $request, AdvanceSalary $advanceSalary)
    {
        $data = $request->validated();

        // Check if salary already exists
        $duplicate = AdvanceSalary::where("employee_id", $request->input('employee_id'))
            ->where("month", $request->input('month'))
            ->where("year", $request->input('year'))
            ->where("id", "!=", $advanceSalary->id)->first();

        if ($duplicate) {
            return redirect()->back()->withInput()->with([
                'message' => 'Salary record already exists for this employee, month, and year.',
                'alert-type' => 'warning'
            ]);
        }
        // End Check if salary already exists

        $advanceSalary->update($data);

        $notification = array(
            'message' => 'Salary Updated successfully.',
            'alert-type' => 'success'
        );

        return to_route('advance-salaries.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdvanceSalary $advanceSalary)
    {
        $advanceSalary->delete();

        $notification = array(
            'message' => 'Salary deleted successfully.',
            'alert-type' => 'success'
        );

        return to_route('advance-salaries.index')->with($notification);
    }
}
