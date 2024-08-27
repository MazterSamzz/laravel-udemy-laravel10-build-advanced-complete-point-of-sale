<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attendance;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;
use App\Models\Backend\Employee;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::select('date')->groupBy('date')->orderBy('date', 'DESC')->get();
        return view('backend.attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('backend.attendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        $countEmployees = count($request->employee_id);

        for ($i = 0; $i < $countEmployees; $i++) {
            $attendance = new Attendance();
            $attendance->employee_id = $request->employee_id[$i];
            $attendance->date = date('Y-m-d', strtotime($request->date));
            $attendance->status = $request->status[$i];
            $attendance->save();
        }

        $notification = array(
            'message' => 'Attendance created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('attendances.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
