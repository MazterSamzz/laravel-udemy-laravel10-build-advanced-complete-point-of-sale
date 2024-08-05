<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
