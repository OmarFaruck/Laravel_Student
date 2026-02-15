<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RollManagementController extends Controller
{
    // public function rollmanagement(Request $request)
    // {
    //     return Inertia::render('RollManagement/index',[
    //         'roles' => Role::all()
    //     ]);


    // }

    // public function create()
    // {
    //     return Inertia::render('RollManagement/Create');
    // }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|unique:roles,name',
    //     ]);

    //     Role::create([
    //         'name' => $data['name'],
    //     ]);

    //     return redirect()->route('roll_management.index');
    // }

    // public function registerPage()
    // {
    //     return Inertia::render('RollManagement/Register');
    // }


     public function rollmanagement()
    {
        return Inertia::render('RollManagement/Index', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create([
            'name' => $data['name'],
        ]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }
        // Add a success notification
        // flash()->success('Role created successfully!');

        return redirect()->route('roll_management.index')->with('success', 'Role created successfully!');
    }

    public function edit($role){
           $roll = Role::findOrFail($role);
        return Inertia::render('RollManagement/edit', [
            'roll' => $roll
        ]);
    }


    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update([
            'name' => $data['name'],
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roll_management.index')->with('primary', 'Role updated successfully!');
        // return redirect()->back();
    }

    public function destroy($id)
    {
        $role=Role::findorFail($id);
        $role->delete();
        return redirect()->route('roll_management.index')->with('success', 'Role deleted successfully!');
        // return redirect()->back();
  

    }
}
