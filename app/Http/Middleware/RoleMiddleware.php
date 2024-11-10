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
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if the user has the required role
        if ($role == 'admin' && $user->role == 'admin') {
            return $next($request);
        }

        if ($role == 'superadmin' && $user->role == 'superadmin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
