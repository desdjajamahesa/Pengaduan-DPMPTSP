<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
  public function showUser()
  {
    $endUserOnly = User::where('role', 'end_user')->count();
    $filter = User::where('role', 'end_user');
    $users = $filter->paginate(10);

    return view('admin.user', compact('endUserOnly', 'users'));
  }

  // Fungsi untuk menampilkan form edit
  public function edit($id)
  {
    $user = User::findOrFail($id); // Cari user berdasarkan ID
    return view('admin.edit_user', compact('user'));
  }

  // Fungsi untuk memperbarui data pengguna
  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255|unique:users,email,' . $id,
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save(); // Simpan perubahan

    return redirect()->route('admin.user')->with('success', 'User updated successfully.');
  }

  // Fungsi untuk menghapus pengguna
  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete(); // Hapus pengguna

    return redirect()->route('admin.user')->with('success', 'User deleted successfully.');
  }
}
