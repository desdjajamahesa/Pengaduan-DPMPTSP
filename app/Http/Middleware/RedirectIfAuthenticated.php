<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Mengecek apakah pengguna sudah terautentikasi
        if (Auth::check()) {
            // Jika pengguna terautentikasi, arahkan ke halaman yang sesuai
            return redirect()->route('home'); // Ganti 'home' dengan rute yang sesuai
        }

        // Jika tidak terautentikasi, lanjutkan ke permintaan berikutnya
        return $next($request);
    }
}
