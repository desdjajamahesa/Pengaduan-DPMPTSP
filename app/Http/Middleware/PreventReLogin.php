<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventReLogin
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
        // Mengecek apakah user sudah logout
        if (!Auth::check()) {
            // Mengarahkan ke halaman login atau halaman tertentu jika sudah logout
            return redirect()->route('login');
        }

        return $next($request);
    }
}
