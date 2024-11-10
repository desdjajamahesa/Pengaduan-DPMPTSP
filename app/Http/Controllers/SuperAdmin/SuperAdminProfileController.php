<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminProfileController extends Controller
{
    // Tampilkan daftar profile superadmin dengan fitur pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mendapatkan semua pengguna dengan role 'superadmin' dan filter berdasarkan nama jika ada kata pencarian
        $superadmins = User::where('role', 'super_admin')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('superadmin.profile', compact('superadmins'));
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
