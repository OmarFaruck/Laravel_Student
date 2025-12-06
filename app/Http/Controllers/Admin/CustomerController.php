<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $customer=Customer::latest()->paginate(10);
         return response()->json($customer, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
            $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email', // FIXED
        'address' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);
    if ($validator->fails) {
        return response()->json(['errors'=>$validator->errors()], 422);
    }

    $customer=Customer::create($data);
    return response()->json($customer,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer=Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);

        }
        return response()->json($customer, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
