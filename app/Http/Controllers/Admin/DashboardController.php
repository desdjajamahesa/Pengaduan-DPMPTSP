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
      $endUserCount = User::count();
      $pengaduanDiproses = Pengaduan::where('status', 'proses')->count();
      $pengaduanTertunda = Pengaduan::where('status', 'belum_proses')->count();
      $pengaduanSelesai = Pengaduan::where('status', 'selesai')->count();
  
      // Mengambil 5 pengguna terakhir yang baru saja melakukan pengaduan
      $recentPengaduans = Pengaduan::with('user')
          ->orderBy('tanggal_pengaduan', 'desc')
          ->take(5)
          ->get();
  
      return view('admin.dashboard', compact(
          'totalPengaduan',
          'pengaduanToday',
          'endUserCount',
          'pengaduanDiproses',
          'pengaduanTertunda',
          'pengaduanSelesai',
          'recentPengaduans'
      ));
  }
  
}
