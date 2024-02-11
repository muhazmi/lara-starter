<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = 'Role';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page_title' => $this->module,
            'roles' => Role::all(),
        ];

        return view('backend.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => 'Add ' . $this->module,
            'permissions' => Permission::get(),
        ];

        return view('backend.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        Alert::success('Success', $this->module . ' added successfully.');
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $data = [
            'page_title'        => 'Edit ' . $this->module,
            'role'              => $role,
            'role_permissions'  => $role->permissions->pluck('name')->toArray(),
            'permissions'       => Permission::get(),
        ];

        return view('backend.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if (!$role) {
            return back()->with('error', $this->module . ' not found.');
        }

        $role->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        $data = [
            'page_title' => $this->module,
            'roles' => $role,
            'role_permissions' => $role->permissions,
        ];

        return view('backend.role.index', $data);
    }
}
