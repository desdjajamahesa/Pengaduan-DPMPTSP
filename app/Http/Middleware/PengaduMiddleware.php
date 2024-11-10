<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class PengaduMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna memiliki role user
        if (Auth::user() && Auth::user()->role !== 'user') {
            // Redirect jika bukan user
            return redirect()->route('home'); // Misalnya, redirect ke halaman home
        }

        return $next($request);
    }
}
