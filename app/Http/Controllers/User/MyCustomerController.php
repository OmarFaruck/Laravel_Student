<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Customer/Customer', [
          'customers' => Customer::all()
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

    return redirect()->route('customers.index') 
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
        $customer = Customer::findorFail($id);
        return Inertia::render('Customer/edit', [
            'customer' => $customer
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $customer = Customer::findOrFail($id);

    $data = $request->validate([
        'name' => 'required',
        'email' => "required|email|unique:customers,email,$id",
        'address' => 'required',
        'image' => 'nullable|image',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('customers','public');
    }

    $customer->update($data);

    return redirect()->route('customers.index')
    ->with('success','Customer Updated Successfully');
}
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $customer = Customer::findOrFail($id);
    $customer->delete();

    return redirect()->route('customers.index')
        ->with('success', 'Customer deleted successfully');
    }
}