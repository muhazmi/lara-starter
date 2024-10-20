<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = __('Permission');
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

        return view('backend.setting.permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title' => __('Add') . ' ' . $this->module,
        ];

        return view('backend.setting.permission.create', $data);
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

        toast($this->module . ' berhasil ditambah.', 'success');
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

        return view('backend.setting.permission.edit', $data);
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

        toast($this->module . ' berhasil diperbarui.', 'success');
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

        alert()->success('Success', $this->module . ' berhasil dihapus.');
        return redirect()->route('permissions.index');
    }
}
