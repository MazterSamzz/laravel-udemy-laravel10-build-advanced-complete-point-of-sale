<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Backend\Employee;
use Illuminate\Contracts\View\View;

class EmployeeController extends Controller
{
    /**
     * Index function to retrieve the latest employees and display them in the employee index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $employees = Employee::latest()->get();
        return view('backend.employee.index', compact('employees'));
    }

    public function create(): View
    {
        return view('backend.employee.create');
    }

    public function store(EmployeeRequest $request)
    {
        $employee = $request->validated();

        if ($request->file('photo')) {
            $employee['photo'] = ImageHelper::saveImage($request->file('photo'), 'images/employee-photos');
        }

        Employee::create($employee);

        $notification = array(
            'message' => 'Employee created successfully.',
            'alert-type' => 'success'
        );

        return to_route('employees.index')->with($notification);
    }

    public function edit(string $id): View
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $data = $request->validated();

        // Save the image and Delete the previous image
        if ($request->hasFile('photo')) {
            $data['photo'] = ImageHelper::saveImage($request->file('photo'), 'images/employee-photos');
            if ($employee->photo)
                ImageHelper::softDelete($employee->photo, $employee->name);
        }

        $employee->update($data);

        $notification = array(
            'message' => 'Employee updated successfully.',
            'alert-type' => 'success'
        );

        return to_route('employees.index')->with($notification);
    }
}
