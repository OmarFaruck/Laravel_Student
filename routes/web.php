<?php
 
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Contacts/Index');
});

// Route::get('/', function () {
//     return dd('hellow world');
// });
