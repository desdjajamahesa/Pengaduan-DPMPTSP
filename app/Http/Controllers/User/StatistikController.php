<?php

namespace App\Http\Controllers\User;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Data statistik pengaduan
        $totalPengaduan = Pengaduan::count();  // Total pengaduan
        $pengaduanProses = Pengaduan::where('status', 'selesai')->count();  // Pengaduan yang sudah diproses
    
        $persentaseProses = $totalPengaduan > 0 ? ($pengaduanProses / $totalPengaduan) * 100 : 0;

        Log::info('Total Pengaduan:', ['total' => $totalPengaduan]);
        Log::info('Pengaduan Proses:', ['proses' => $pengaduanProses]);
        Log::info('Persentase Proses:', ['persentase' => $persentaseProses]);
        return view('user.home', compact('totalPengaduan', 'pengaduanProses', 'persentaseProses'));
    }
}