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
      $endUserCount = User::count();
      $pengaduanDiproses = Pengaduan::where('status', 'diproses')->count();
      $pengaduanTertunda = Pengaduan::where('status', 'tertunda')->count();
      $pengaduanSelesai = Pengaduan::where('status', 'selesai')->count();
  
      // Mengambil 5 pengguna terakhir yang baru saja melakukan pengaduan
      $recentPengaduans = Pengaduan::with('user')
          ->orderBy('tanggal_pengaduan', 'desc')
          ->take(5)
          ->get();
  
      return view('superadmin.dashboard', compact(
          'totalPengaduan',
          'pengaduanToday',
          'endUserCount',
          'pengaduanDiproses',
          'pengaduanTertunda',
          'pengaduanSelesai',
          'recentPengaduans'
      ));
  }

  public function dashboard()
{
    $recentPengaduans = Pengaduan::with('user')->latest()->take(5)->get(); // Get the latest 5 pengaduan

    return view('superadmin.dashboard', compact('recentPengaduans'));
}
}
