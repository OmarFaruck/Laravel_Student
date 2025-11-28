<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Contacts/Dashboard');
});
Route::get('/student', function () {
    return Inertia::render('Contacts/Index');
});
Route::get('/customer', function () {
    return Inertia::render('Contacts/Customer');
});

// Route::get('/', function () {
//     return dd('hellow world');
// });
