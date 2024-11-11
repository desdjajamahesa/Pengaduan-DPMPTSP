<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminProfileController extends Controller
{
    // Tampilkan daftar profile superadmin dengan fitur pencarian
    public function index(Request $request)
    {
        $superadmin = User::where('role', 'super_admin')
            ->where('id', Auth::id())
            ->firstOrFail();  // Menggunakan `firstOrFail()` untuk mendapatkan satu entri
    
        return view('superadmin.profile', compact('superadmin'));  // Kirim data tunggal
    }

    // Perbarui profil superadmin yang ditentukan dengan data baru
    public function update(Request $request, $id)
    {
        $superadmin = User::findOrFail($id);

        // Validasi data request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'telephone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update profil superadmin
        $superadmin->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password ? Hash::make($request->password) : $superadmin->password,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('superadmin.profile')->with('success', 'SuperAdmin berhasil diperbarui.');
    }
}
