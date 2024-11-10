<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    // Tampilkan daftar profile admin dengan fitur pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mendapatkan semua pengguna dengan role 'admin' dan filter berdasarkan nama jika ada kata pencarian
        $admins = User::where('role', 'admin')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('admin.profile', compact('admins'));
    }

    // Perbarui profil admin yang ditentukan dengan data baru
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // Validasi data request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'telephone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update profil admin
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.profile')->with('success', 'Admin berhasil diperbarui.');
    }
}
