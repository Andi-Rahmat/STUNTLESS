<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            // Jika sudah login, lanjutkan request
            return $next($request);
        }

        // Jika belum login, redirect ke halaman login
        return redirect('login');
    }
}
