<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          return Inertia::render('Admin/Admin', [
            'admins' => Admin::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'address' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('admins', 'public');
        }

        Admin::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'address'=>$data['address'],
            'image'=>$data['image'] ?? null,
    
        ]);

        return redirect()->route('admins.index') 
            ->with('success', 'Admin added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::findOrFail($id);
        return Inertia::render('Admins/Show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        return Inertia::render('Admin/Admin', [
            'admins' => $admin
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'address' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('admins', 'public');
        }

        $admin->update($data);

        
        return redirect()->route('admins.index') 
            ->with('success', 'Admin updated successfully!');
    }
     
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admins.index') 
            ->with('success', 'Admin deleted successfully!');
    }
}
