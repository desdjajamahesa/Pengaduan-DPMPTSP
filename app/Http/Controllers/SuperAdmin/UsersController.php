<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function showUser(Request $request)
    {
      $query = User::where('role', 'pelapor');
      
      // Filter berdasarkan input pencarian (nama atau email)
      if ($request->has('search') && $request->search != '') {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
          $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
        });
      }
  
      $endUserOnly = $query->count(); // Hitung total pengguna yang sesuai
      $users = $query->paginate(10);  // Paginasi hasil pencarian
  
      return view('superadmin.user', compact('endUserOnly', 'users'));
    }

    // Fungsi untuk menampilkan form edit
    public function edit($id)
    {
      $user = User::findOrFail($id); // Cari user berdasarkan ID
      return view('superadmin.edit_user', compact('user'));
    }

    // Fungsi untuk memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'telephone' => 'required', 'string', 'regex:/^[0-9]{10,13}$/'// Validate telephone if needed
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone'); // Save telephone
        $user->save(); // Simpan perubahan

        return redirect()->route('superadmin.user')->with('success', 'User updated successfully.');
    }

    // Fungsi untuk menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Hapus pengguna

        return redirect()->route('superadmin.user')->with('success', 'User deleted successfully.');
    }
}
