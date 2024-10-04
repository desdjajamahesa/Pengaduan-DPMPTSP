<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
  public function jumlah()
  {
    $userCount = User::count();
    return view('admin.dasboard', compact('userCount'));
  }
  public function users(Request $request)
  {
    // Cek role pengguna saat ini
    if (Auth::user()->role === 'super_admin') {
      // Jika role adalah superadmin, ambil pengguna dengan role end_user atau admin
      $users = User::whereIn('role', ['end_user'])->get();

      // Jika ada pencarian, filter berdasarkan nama atau email
      if ($request->has('search')) {
        $users = User::whereIn('role', ['end_user'])
          ->where(function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
          })->get();
      }

      // Render view untuk superadmin
      return view('superadmin.user', compact('users'));
    } elseif (Auth::user()->role === 'admin') {
      // Jika role adalah admin, ambil pengguna dengan role end_user saja
      $users = User::where('role', 'end_user')->get();

      // Jika ada pencarian, filter berdasarkan nama atau email
      if ($request->has('search')) {
        $users = User::where('role', 'end_user')
          ->where(function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
          })->get();
      }

      // Render view untuk admin
      return view('admin.user', compact('users'));
    } else {
      // Jika role tidak diketahui atau bukan admin/superadmin, bisa diarahkan ke halaman error
      abort(403, 'Unauthorized action.');
    }
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
