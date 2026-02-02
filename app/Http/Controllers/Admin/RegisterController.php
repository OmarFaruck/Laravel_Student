<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    //Registerr Controller Code Here
    public function registerPage(Request $request)
    {
        
        return Inertia::render('Admin/Register');

    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user (you can adjust this according to your User model)
        $user =User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

       
        // You might want to log the user in immediately after registration
        // Auth::login($user);

        // Redirect to a desired location, e.g., login page or dashboard
        return redirect()->route('login.index');
    }

    public function loginPage(Request $request)
    {
        return Inertia::render('Admin/Login');

    }

    public function logoutPage(Request $request)
    {
        // Log out the user
        auth()->logout();

        // Redirect to the login page or any other desired location
        return redirect()->route('login.index');
    }
    
}
