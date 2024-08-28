<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employees', 'index')->name('employees.index');
    Route::get('/employees/create', 'create')->name('employees.create');
    Route::post('/employees', 'store')->name('employees.store');
    Route::get('/employees/{employee}/edit', 'edit')->name('employees.edit');
    Route::put('/employees/{employee}', 'update')->name('employees.update');
    Route::delete('/employees/{employee}', 'destroy')->name('employees.destroy');
});
Route::controller(AttendanceController::class)->group(function () {
    Route::get('/attendances', 'index')->name('attendances.index');
    Route::post('/attendances', 'store')->name('attendances.store');
    Route::get('/attendances/create', 'create')->name('attendances.create');
    Route::get('/attendances/{date}', 'show')->name('attendances.show');
    Route::patch('/attendances/{date}', 'update')->name('attendances.update');
    Route::delete('/attendances/{date}', 'destroy')->name('attendances.destroy');
    Route::get('/attendances/{date}/edit', 'edit')->name('attendances.edit');
});
