<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Your middleware logic
        if (auth()->check() && auth()->user()->role != 'admin') {
            return redirect()->route('home');
        }

        return $next($request);
    }
}

