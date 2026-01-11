<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CustomersController;

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

Route::get('/customers', [CustomersController::class, 'index'])->name('customer.index');
Route::get('/customers/create', [CustomersController::class, 'create'])->name('customer.create');
Route::post('/customers', [CustomersController::class, 'store'])->name('customer.store');
Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customer.edit');
Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customer.update');
Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customer.delete');
// Route::get('/', function () {
//     return dd('hellow world');
// });
