<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CustomersController;
use App\Http\Controllers\User\MyCustomerController;

Route::get('/', function () {
    return Inertia::render('Contacts/Dashboard');
});
Route::get('/student', function () {
    return Inertia::render('Contacts/Index');
});
// Route::get('/customer', function () {
//     return Inertia::render('Contacts/Customer');
// });

// Route::resource('/customer', CustomerController::class);

// Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
// Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
// Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
// Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
// Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');
// Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.delete');


Route::get('/customers', [MyCustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [MyCustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [MyCustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{id}/edit', [MyCustomerController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{id}', [MyCustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{id}', [MyCustomerController::class, 'destroy'])->name('customers.destroy');
// Route::get('/', function () {
//     return dd('hellow world');
// });
