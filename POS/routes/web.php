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

Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/sales/pos', [SaleController::class, 'pos'])->name('sales.pos');
Route::post('/sales/pos/{product}', [SaleController::class, 'addCart'])->name('sales.add-cart');
Route::patch('/sales/pos/{rowId}', [SaleController::class, 'updateCart'])->name('sales.update-cart');

require __DIR__ . '/auth.php';
