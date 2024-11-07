<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Data statistik pengaduan
        $totalPengaduan = Pengaduan::count();  // Total pengaduan
        $pengaduanProses = Pengaduan::where('status', 'selesai')->count();  // Pengaduan yang sudah diproses
    
        $persentaseProses = $totalPengaduan > 0 ? ($pengaduanProses / $totalPengaduan) * 100 : 0;

        return view('user.home', compact('totalPengaduan', 'pengaduanProses', 'persentaseProses'));
    }

        // Passing data ke view
 
    
}