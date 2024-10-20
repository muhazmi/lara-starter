<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\View\View;
use Laravolt\Indonesia\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    private $module, $product_categories, $tags_navbar;

    public function __construct()
    {
        $this->module = __('User');
    }

    private function getCommonData()
    {
        return [
            'module'                    => $this->module,
            'product_categories'        => $this->product_categories,
            'tags_navbar'               => $this->tags_navbar,
        ];
    }

    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = User::where('id', auth()->user()->id)->firstOrFail();
        $data = [
            'page_title'    => __('My Profile'),
            'user'          => $user,
            'provinces'     => Province::orderBy('name')->get(),
            'cities'        => City::where('province_code', $user->province_id)->orderBy('name')->get(),
            'districts'     => District::where('city_code', $user->city_id)->orderBy('name')->get(),
            'villages'      => Village::where('district_code', $user->district_id)->orderBy('name')->get(),
        ] + $this->getCommonData();

        return view('backend.profile.edit', $data);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        try {
            $emailChanged = false;
            if ($request->filled('email') && $user->email !== $request->email) {
                $data['email_verified_at'] = null;
                $emailChanged = true;
            }

            if ($request->filled('new_password')) {
                $data['password'] = Hash::make($request->new_password);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            $message = __('Profile updated successfully.');
            if ($emailChanged) {
                $message = __('Profile updated successfully. Please check your new email for verification.');
                $request->user()->sendEmailVerificationNotification();
                Auth::logout();
                return response()->json(['success' => true, 'message' => $message, 'logout' => true]);
            }

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update profile: ' . $e->getMessage()]);
        }
    }
}
