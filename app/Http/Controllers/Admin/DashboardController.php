<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
  public function index()
  {
    $totalPengaduan = Pengaduan::count();
    $pengaduanToday = Pengaduan::whereDate('tanggal_pengaduan', Carbon::today())->count();
    $endUserCount = User::count(); // or use a condition for specific user roles if needed

    return view('admin.dashboard', compact('totalPengaduan', 'pengaduanToday', 'endUserCount'));
    $endUserCount = User::where('role', 'end_user')->count();
  }
}
