<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
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

Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::get('/shops/create', [ShopController::class, 'create'])->name('shops.create');
Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
Route::get('/shops/{id}/edit', [ShopController::class, 'edit'])->name('shops.edit');
Route::put('/shops/{id}', [ShopController::class, 'update'])->name('shops.update');
Route::delete('/shops/{id}', [ShopController::class, 'destroy'])->name('shops.destroy');


Route::get('/customers', [MyCustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [MyCustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [MyCustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{id}/edit', [MyCustomerController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{id}', [MyCustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{id}', [MyCustomerController::class, 'destroy'])->name('customers.destroy');
// Route::get('/', function () {
//     return dd('hellow world');
// });
