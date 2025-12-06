<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer=Customer::all();
        return Inertia::render('Customer/Customer',[
            'customers'=>$customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customer/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
         $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:customers,email',
        'address' => 'required',
        'image' => 'nullable|image',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('customers', 'public');
    }

    // Customer::create($data);
    Customer::create([
        'name'=>$data['name'],
        'email'=>$data['email'],
        'address'=>$data['address'],
        'image'=>$data['image'] ?? null,

    ]);

    return redirect()->route('Customer.index')
        ->with('success', 'Customer added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
