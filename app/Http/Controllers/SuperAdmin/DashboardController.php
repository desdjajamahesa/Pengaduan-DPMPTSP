<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    $totalPengaduan = Pengaduan::count();
    $pengaduanToday = Pengaduan::whereDate('tanggal_pengaduan', Carbon::today())->count();
    $endUserCount = User::count(); // or use a condition for specific user roles if needed

    return view('superadmin.dashboard', compact('totalPengaduan', 'pengaduanToday', 'endUserCount'));
    $endUserCount = User::where('role', 'end_user')->count();
  }
}
