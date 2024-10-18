<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $admins = User::where('role', 'admin')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('superadmin.admin', compact('admins'));
    }

    public function create()
    {
        // View form tambah
        return view('superadmin.admin.tambah_admin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'telephone' => 'nullable',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'telephone' => $request->telephone,
            'role' => 'admin',
        ]);

        return redirect()->route('superadmin.admin')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        // View form edit dengan data admin
        return view('superadmin.admin.edit_admin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'telephone' => 'nullable',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('superadmin.admin')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('superadmin.admin')->with('success', 'Admin berhasil dihapus.');
    }
}
