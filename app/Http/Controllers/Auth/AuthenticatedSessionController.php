<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        dd([
            'Logged in user ID' => Auth::id(),
            'User data' => Auth::user()
        ]);
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('home', ['id' => Auth::id()], false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}