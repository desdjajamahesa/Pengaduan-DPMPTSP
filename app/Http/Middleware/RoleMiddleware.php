<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check the user's role
        $user = Auth::user();

        // Allow access if the user's role matches the required role
        if ($role == 'admin' && !$user->is_superadmin) {
            return $next($request);
        }

        if ($role == 'superadmin' && $user->is_superadmin) {
            return $next($request);
        }

        // Redirect the user if they don't have the required role
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
