<?php

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\AdvanceSalaryController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'logUserActivity'])->name('dashboard');

Route::middleware(['auth', 'logUserActivity'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    require __DIR__ . '/backend/employee.php';
    Route::resource('customers', CustomerController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('advance-salaries', AdvanceSalaryController::class);
    Route::resource('salaries', SalaryController::class);
    Route::get('salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::resource('attendances', AttendanceController::class);
});

require __DIR__ . '/auth.php';
