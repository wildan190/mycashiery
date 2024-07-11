<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;
use Illuminate\Support\Facades\Auth;
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

        //logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'details' => 'Created permission: ' . $request->name,
        ]);
        
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

        //logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'details' => 'Updated permission: ' . $request->name,
        ]);
        
        return redirect()->route('permissions.index');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        //logging
        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'details' => 'Deleted permission: ' . $permission->name,
        ]);
        
        return redirect()->route('permissions.index');
    }
}
