<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'super_admin':
                    return Redirect::intended('super-dashboard');
                case 'admin':
                    return Redirect::intended('dashboard');
                default:
                    return Redirect::intended('home');
            }
        }

        return Redirect::back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }

    public function sendEmail()
    {
        $details = [
            'title' => 'Mail from Laravel 11 App',
            'body' => 'This is a test email.'
        ];

        Mail::to('recipient@example.com')->send(new UserEmail($details));

        return 'Email Sent!';
    }
}
