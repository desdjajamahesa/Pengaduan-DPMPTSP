<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaduProfileController extends Controller
{
    // Tampilkan profile admin yang sedang login
    public function index(Request $request)
    {
        // Mendapatkan ID admin yang sedang login
        $user = User::where('role', 'end_user')
            ->where('id', Auth::id())
            ->firstOrFail();

        return view('User.profile', compact('user'));
    }

    // Perbarui profil admin yang ditentukan dengan data baru
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'telephone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update profil admin
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('user.profile')->with('success', 'Pengadu berhasil diperbarui.');
    }
}
