<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required|email|unique:users,email|min:5|max:255', 
            'password' => 'required|min:7'
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session untuk mencegah session fixation
            $request->session()->regenerate();
            
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

        return Redirect::back()
        ->withErrors(['email' => 'Email atau password yang Anda masukkan salah.',])
        ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {        
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return Redirect::to('/login')->with('status', 'Anda telah berhasil logout.');
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
