<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\User\AdminController;  
use App\Http\Controllers\Admin\RegisterController;
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


Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');


Route::get('/register_page', [RegisterController::class, 'registerPage'])->name('register.index');
Route::post('/register_page', [RegisterController::class, 'register'])->name('register.index');

Route::get('/login_page', [RegisterController::class, 'loginPage'])->name('login.index');
Route::post('/login_page', [RegisterController::class, 'loginPage'])->name('login.index');

//logout route
Route::get('/logout_page', [RegisterController::class, 'logoutPage'])->name('logout.index'); 


Route::get('auth/{provider}', [SocialController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])->name('socialite.callback');


// Route::get('/', function () {
//     return dd('hellow world');
// });
