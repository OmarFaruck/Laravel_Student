<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RollManagementController extends Controller
{
    public function rollmanagement(Request $request)
    { 
        return Inertia::render('RollManagement/index');
    }

    // public function registerPage()
    // {
    //     return Inertia::render('RollManagement/Register');
    // }
}
