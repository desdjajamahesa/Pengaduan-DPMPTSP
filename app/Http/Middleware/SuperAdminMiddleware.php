<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna memiliki role super_admin
        if (Auth::user() && Auth::user()->role !== 'superadmin') {
            // Redirect jika bukan superadmin
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}

