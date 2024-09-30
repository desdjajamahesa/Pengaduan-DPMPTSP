<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\Mail;

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
