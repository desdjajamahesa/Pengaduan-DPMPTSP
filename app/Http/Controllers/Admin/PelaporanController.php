<?php 

namespace App\Http\Controllers\Admin;

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
        return view('pelaporan', compact('pengaduans'));

        $query = Pengaduan::query();
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
    
        // Filter Tanggal
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_pengaduan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }
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