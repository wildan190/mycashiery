<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        Permission::create(['name' => $request->name]);
        
        return redirect()->route('permissions.index');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->update(['name' => $request->name]);
        
        return redirect()->route('permissions.index');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        
        return redirect()->route('permissions.index');
    }
}
