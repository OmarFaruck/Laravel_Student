<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CustomerController;

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

Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');

// Route::get('/', function () {
//     return dd('hellow world');
// });
