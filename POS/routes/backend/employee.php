<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employee', 'index')->name('employees.index');
    Route::get('/employee/create', 'create')->name('employees.create');
});
