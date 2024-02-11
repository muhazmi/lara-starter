<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = 'Permission';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page_title' => $this->module,
            'permissions' => Permission::all(),
        ];

        return view('backend.permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => 'Add ' . $this->module,
        ];

        return view('backend.permission.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name'
        ]);

        Permission::create($request->only('name'));

        Alert::success('Success', $this->module . ' added successfully.');
        return redirect()->route('permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $data = [
            'page_title' => 'Edit ' . $this->module,
            'permissions' => $permission,
        ];

        return view('backend.permission.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);

        $permission->update($request->only('name'));

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if (!$permission) {
            return back()->with('error', $this->module . ' not found.');
        }

        $permission->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('permissions.index');
    }
}
