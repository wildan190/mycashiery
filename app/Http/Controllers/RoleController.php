<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'details' => 'Created role: '.$role->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'details' => 'Created role: '.$role->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        // Logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'details' => 'Deleted role: '.$role->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
