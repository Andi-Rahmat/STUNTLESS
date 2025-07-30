<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (Auth::check()) {
            if (Auth::user()->role != $role) {  
                return redirect('/')->with('error', 'Akses ditolak. Peran Anda tidak cukup untuk mengakses halaman ini.');
            }
        } else {
            return redirect('/login');
        }

        return $next($request);
    }
}
