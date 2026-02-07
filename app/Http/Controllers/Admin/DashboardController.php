<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Shop;


class DashboardController extends Controller
{
      public function dashboard()
    {
        return Inertia::render('Dashboard_pages');
    }
      public function index()
    {
        return Inertia::render('Dashboard', [
            'shops' => Shop::latest()->get()
        ]);
    }
}
