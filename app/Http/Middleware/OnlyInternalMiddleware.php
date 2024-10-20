<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyInternalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) { // Check status login
            return redirect('/login');
        }

        $user = Auth::user(); // Ambil pengguna yang sedang terautentikasi

        // Jika pengguna memiliki role 'customer', alihkan ke halaman depan
        if ($user->hasRole('customer')) {
            return redirect('/')->with('error', __('You do not have access to admin pages.'));
        }

        // Izinkan akses jika pengguna tidak memiliki role 'customer'
        return $next($request);
    }
}
