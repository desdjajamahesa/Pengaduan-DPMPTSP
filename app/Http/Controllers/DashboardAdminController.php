<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardAdminController extends Controller
{
  public function jumlah()
  {
    $userCount = User::count();
    return view('admin.dasboard', compact('userCount'));
  }
  public function users(Request $request)
  {
    // Mengambil pengguna dengan role 'admin'
    $users = User::where('role', 'end_user')->get();

    // Jika ada pencarian, filter berdasarkan nama atau email
    if ($request->has('search')) {
      $users = User::where('role', 'end_user')
        ->where(function ($query) use ($request) {
          $query->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%');
        })->get();
    }

    return view('admin.user', compact('users'));
  }
  public function admin(Request $request)
  {
    // Mengambil pengguna dengan role 'admin'
    $admins = User::where('role', 'admin')->get();

    // Jika ada pencarian, filter berdasarkan nama atau email
    if ($request->has('search')) {
      $admins = User::where('role', 'admin')
        ->where(function ($query) use ($request) {
          $query->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%');
        })->get();
    }

    return view('superadmin.admin', compact('admins'));
  }
}
