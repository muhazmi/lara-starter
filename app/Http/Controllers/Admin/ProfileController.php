<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    protected $module;

    public function __construct()
    {
        $this->module = 'Profile';
    }

    /**
     * Display the user's profile form.
     */
    public function show(): View
    {
        $data = [
            'page_title' => 'Profil',
        ];

        return view('profile.show', $data);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(User $user)
    {
        $user = auth()->user();

        $data = [
            'page_title'=> 'Profile Saya',
            'users'     => $user,
            'provinces' => Province::orderBy('name')->get(),
            'cities'    => City::where('province_code', $user->province_id)->orderBy('name')->get(),
            'districts' => District::where('city_code', $user->city_id)->orderBy('name')->get(),
            'villages'  => Village::where('district_code', $user->district_id)->orderBy('name')->get(),
        ];

        return view('backend.profile.edit', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user)
    {
        $user   = auth()->user();
        $data   = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            // Menghapus file lama jika ada
            if ($user->profile_image) {
                Storage::disk('public')->delete('images/users/' . $user->profile_image);
            }

            $profile_image = $request->file('profile_image');
            $profile_imageName = now()->format('YmdHis') . '_' . $profile_image->extension();
            Storage::disk('public')->put('images/users/' . $profile_imageName, file_get_contents($profile_image));
            $data['profile_image'] = $profile_imageName;
        }

        $user->update($data);

        Alert::success('Success', $this->module . ' updated successfully.');
        return redirect()->route('profile.edit', ['profile' => $user]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
