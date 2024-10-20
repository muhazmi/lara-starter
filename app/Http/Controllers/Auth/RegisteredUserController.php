<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $data = [
            'page_title' => __('Register'),
        ];

        return view('auth.register', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile_phone' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'          => $request->name,
            'mobile_phone'  => $request->mobile_phone,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        // Menambahkan role 'customer' ke user yang baru dibuat
        $user->assignRole('customer');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('backend.dashboard', absolute: false));
    }
}
