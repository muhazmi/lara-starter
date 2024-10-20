<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\Village;
use App\Http\Requests\Master\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use App\Http\Requests\Master\UserUpdateRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    protected $module;

    public function __construct()
    {
        $this->module = __('User');
    }

    public static function middleware(): array
    {
        return [
            'role:superadmin|admin',
            'permission:index admin/master/users|create admin/master/users/create|store admin/master/users/store|edit admin/master/users/edit|update admin/master/users/update|delete admin/master/users/delete'
        ];
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
                                <i class="fa fa-trash-can"></i>
                            </button>
                        </div>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'page_title'    => $this->module,
        ];

        return view('backend.master.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page_title'    => __('Add') . ' ' . $this->module,
            'roles'         => Role::orderBy('name')->get(),
            'provinces'     => Province::orderBy('name')->get(),
        ];

        return view('backend.master.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $data                       = $request->validated();
        $data['created_by']         = auth()->id();
        $data['email_verified_at']  = date('Y-m-d H:i:s');

        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            // Menyimpan file baru
            $photo = $request->file('photo');
            $photoName = now()->format('YmdHis') . '_.' . $photo->hashName();
            Storage::disk('images')->put('users/' . $photoName, file_get_contents($photo));
            $data['photo'] = $photoName;
        }

        $user = User::create($data);
        // Assign roles based on the input role_id
        if ($request->filled('role_id')) {
            $roles = Role::whereIn('id', $request->role_id)->get();
            $user->syncRoles($roles);
        }

        toast($this->module . ' berhasil ditambah.', 'success');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'page_title'    => 'Edit ' . $this->module,
            'users'         => $user,
            'userRole'      => $user->roles->pluck('name')->toArray(),
            'roles'         => Role::orderBy('name')->get(),
            'provinces'     => Province::orderBy('name')->get(),
            'cities'        => City::where('province_code', $user->province_id)->orderBy('name')->get(),
            'districts'     => District::where('city_code', $user->city_id)->orderBy('name')->get(),
            'villages'      => Village::where('district_code', $user->district_id)->orderBy('name')->get(),
        ];

        return view('backend.master.user.edit', $data);
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

        if ($request->hasFile('photo')) {
            // Menghapus file lama jika ada
            if ($user->photo) {
                Storage::disk('images')->delete('users/' . $user->photo);
            }

            // Menyimpan file baru
            $photo = $request->file('photo');
            $photoName = now()->format('YmdHis') . '_.' . $photo->extension();
            Storage::disk('images')->put('users/' . $photoName, file_get_contents($photo));
            $data['photo'] = $photoName;
        }

        $user->update($data);

        if ($request->filled('role_id')) {
            $roles = Role::whereIn('id', $request->role_id)->get();
            $user->syncRoles($roles);
        }

        toast($this->module . ' berhasil diperbarui.', 'success');
        return redirect()->route('users.index');
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
        $profileImage = $user->photo;

        // Menghapus foto profil yang ada sebelumnya
        if ($profileImage) {
            Storage::disk('images')->delete('users/' . $profileImage);
        }

        $user->delete();

        return response()->json([
            'success' => __('Data Deleted Successfully'),
        ], 200);
    }
}
