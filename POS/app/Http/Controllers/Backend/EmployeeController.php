<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Backend\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    /**
     * Index function to retrieve the latest employees and display them in the employee index view.
     *
     * @return Illuminate\Contracts\View\View;
     */
    public function index(): View
    {
        $employees = Employee::latest()->get();
        return view('backend.employee.index', compact('employees'));
    }

    /**
     * Create function to display the employee create view.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('backend.employee.create');
    }

    /**
     * Store function to create a new employee and save the data to the database.
     *
     * @param EmployeeRequest $request The request object containing the employee data to be created.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmployeeRequest $request): RedirectResponse
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

    /**
     * Edit function to retrieve an employee by ID and display them in the employee edit view.
     *
     * @param string $id The ID of the employee to be edited.
     * @return Illuminate\Contracts\View\View;
     */
    public function edit(string $id): View
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit', compact('employee'));
    }

    /**
     * Update function to update an employee by ID and save the changes to the database.
     *
     * @param EmployeeRequest $request The request object containing the employee data to be updated.
     * @param string $id The ID of the employee to be updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeRequest $request, string $id): RedirectResponse
    {
        $employee = Employee::findOrFail($id);
        $data = $request->validated();

        // Save the image and Delete the previous image
        if ($request->file('photo')) {
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

    /**
     * Delete an employee by ID and remove their associated photo.
     *
     * @param string $id The ID of the employee to be deleted.
     * @return void
     */
    public function destroy(string $id): RedirectResponse
    {
        $employee = Employee::findOrFail($id);

        if ($employee->photo)
            ImageHelper::softDelete($employee->photo, $employee->name);

        $employee->delete();

        $notification = array(
            'message' => 'Employee deleted successfully.',
            'alert-type' => 'success'
        );

        return to_route('employees.index')->with($notification);
    }
}
