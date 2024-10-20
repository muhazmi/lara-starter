<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $data = [
            'page_title' => __('Login'),
        ];

        return view('auth.login', $data);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Cek role pengguna dan redirect ke halaman yang sesuai
        if ($user->hasRole('customer')) {
            return redirect()->intended('/');
        } elseif ($user->hasAnyRole(['masteradmin','superadmin', 'admin', 'admin_master', 'admin_cms', 'admin_finance'])) {
            return redirect()->intended(route('backend.dashboard', absolute: false));
        }

        // Redirect default jika role tidak dikenali
        return redirect()->intended(route('/'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
