<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return Redirect::intended('home'); // Redirect to your dashboard or intended route
        }

        return Redirect::back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
