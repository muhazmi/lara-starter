<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\Village;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = 'Users';
        $this->middleware([
            'role:admin',
            'permission:index admin/users|create admin/users/create|store admin/users/store|edit admin/users/edit|update admin/users/update|delete admin/users/delete|show admin/users/show'
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($row) {
                    return $row->id;
                })
                ->addColumn('roles', function ($row) {
                    return $row->roles->pluck('name')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <form action="' . route('users.destroy', $row->id) . '" method="POST" class="d-inline delete-data">
                        ' . method_field('DELETE') . csrf_field() . '
                        <div class="btn-group">
                            <a href="' . route('users.edit', $row->id) . '" class="btn btn-warning">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="submit" class="btn btn-danger" title="Delete">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'page_title'    => 'User',
        ];

        return view('backend.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title'    => 'Tambah ' . $this->module,
            'roles'         => Role::orderBy('name')->get(),
            'provinces'     => Province::orderBy('name')->get(),
        ];

        return view('backend.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $data                = $request->validated();
        $data['created_by']  = auth()->id();

        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            // Menyimpan file baru
            $profile_image = $request->file('profile_image');
            $profile_imageName = now()->format('YmdHis') . '_.' . $profile_image->hashName();
            Storage::disk('public')->put('images/users/' . $profile_imageName, file_get_contents($profile_image));
            $data['profile_image'] = $profile_imageName;
        }

        $user = User::create($data);
        // Assign roles based on the input role_id
        if ($request->filled('role_id')) {
            $roles = Role::whereIn('id', $request->role_id)->get();
            $user->syncRoles($roles);
        }

        Alert::success('Success', $this->module . ' added successfully.');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'page_title'    => 'Edit Data ' . $this->module,
            'users'         => $user,
            'userRole'      => $user->roles->pluck('name')->toArray(),
            'roles'         => Role::orderBy('name')->get(),
            'provinces'     => Province::orderBy('name')->get(),
            'cities'        => City::where('province_code', $user->province_id)->orderBy('name')->get(),
            'districts'     => District::where('city_code', $user->city_id)->orderBy('name')->get(),
            'villages'      => Village::where('district_code', $user->district_id)->orderBy('name')->get(),
        ];

        return view('backend.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data                = $request->validated();
        $data['updated_by']  = auth()->id();

        // check password field is filled/not
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_image')) {
            // Menghapus file lama jika ada
            if ($user->profile_image) {
                Storage::disk('public')->delete('images/users/' . $user->profile_image);
            }

            // Menyimpan file baru
            $profile_image = $request->file('profile_image');
            $profile_imageName = now()->format('YmdHis') . '_.' . $profile_image->extension();
            Storage::disk('public')->put('images/users/' . $profile_imageName, file_get_contents($profile_image));
            $data['profile_image'] = $profile_imageName;
        }

        $user->update($data);

        if ($request->filled('role_id')) {
            $roles = Role::whereIn('id', $request->role_id)->get();
            $user->syncRoles($roles);
        }

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('users.index');
    }

    public function show()
    {
        $data = [
            'page_title'    => 'Daftar ' . $this->module,
            'users'  => User::getUserList(),
        ];

        if (session('message')) {
            Alert::success('Success', session('message'));
        }

        return view('user.index', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user) {
            return back()->with('error', $this->module . ' not found.');
        }

        // Mengambil foto profil yang ada sebelumnya
        $profileImage = $user->profile_image;

        // Menghapus foto profil yang ada sebelumnya
        if ($profileImage) {
            Storage::disk('public')->delete('images/users/' . $profileImage);
        }

        $user->delete();

        Alert::success('Success', $this->module . ' deleted successfully.');
        return redirect()->route('users.index');
    }
}
