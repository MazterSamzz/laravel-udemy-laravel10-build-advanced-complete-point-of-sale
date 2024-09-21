<?php

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\AdvanceSalaryController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Backend\SaleController;
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
    Route::resource('categories', CategoryController::class);

    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('export', 'export')->name('products.export');
        Route::get('import-page', 'importPage')->name('products.import.page');
        Route::get('import-sample', 'importSample')->name('products.import.sample');
        Route::post('import', 'import')->name('products.import');
    });
    Route::resource('products', ProductController::class);
});

Route::resource('expenses', ExpenseController::class);
Route::get('/expenses/filter/{filter}', [ExpenseController::class, 'filter'])->name('expenses.filter');

Route::prefix('sales')->name('sales.')
    ->controller(SaleController::class)->group(function () {
        Route::get('/pos', 'pos')->name('pos');
        Route::post('/pos/{product}', 'addCart')->name('add-cart');
        Route::patch('/pos/{rowId}', 'updateCart')->name('update-cart');
        Route::delete('/pos/{rowId}', 'deleteCart')->name('delete-cart');
        Route::post('/create-invoice', 'createInvoice')->name('create-invoice');
    });

require __DIR__ . '/auth.php';
