<?php 

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\Pengaduan;
use App\Exports\PengaduanExport;
use Maatwebsite\Excel\Facades\Excel;
class PelaporanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('superadmin.pelaporan', compact('pengaduans'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|string',
        ]);
        Pelaporan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);
        return redirect()->route('pelaporan.index')->with('success', 'Pelaporan berhasil disubmit!');
    }
    public function exportPengaduan()
    {
        return Excel::download(new PengaduanExport, 'pengaduan.xlsx');
    }
}