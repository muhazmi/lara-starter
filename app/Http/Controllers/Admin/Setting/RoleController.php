<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
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

        return view('backend.setting.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            $uriSegments = explode('/', $permission->name);
            return $uriSegments[2] ?? 'other'; // Mengelompokkan berdasarkan segment ke-3
        });

        $data = [
            'page_title' => 'Add ' . $this->module,
            'permissions' => $permissions,
        ];

        return view('backend.setting.role.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        toast($this->module . ' berhasil ditambah.', 'success');
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            $uriSegments = explode('/', $permission->name);
            return $uriSegments[2] ?? 'other'; // Mengelompokkan berdasarkan segment ke-3
        });

        $data = [
            'page_title'        => 'Edit ' . $this->module,
            'role'              => $role,
            'role_permissions'  => $role->permissions->pluck('name')->toArray(),
            'permissions'       => $permissions,
        ];

        return view('backend.setting.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update($request->validated());

        $role->syncPermissions($request->get('permission'));

        toast($this->module . ' berhasil diperbarui.', 'success');
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

        alert()->success('Success', $this->module . ' berhasil dihapus.');
        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        $data = [
            'page_title' => $this->module,
            'roles' => $role,
            'role_permissions' => $role->permissions,
        ];

        return view('backend.setting.role.index', $data);
    }
}
