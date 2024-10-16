<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PengaduanController extends Controller
{
    # USER
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id); // Mencari pengaduan berdasarkan id
        return view('user.detail', compact('pengaduan')); // Mengirimkan data pengaduan ke view
    }
    
    # USER
    public function home(Request $request)
    {

        $query = Pengaduan::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul_pengaduan', 'like', "%{$search}%")
                    ->orWhere('isi_pengaduan', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $pengaduans = $query->with('user')->paginate(5);

        return view('user.home', compact('pengaduans'));
    }

    # SUPER ADMIN
    public function superAdminIndex(Request $request)
    {
        $query = Pengaduan::query()->where('status', 'dilanjutkan');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul_pengaduan', 'like', "%{$search}%")
                    ->orWhere('isi_pengaduan', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $pengaduans = $query->with('user')->paginate(10);

        return view('superadmin.pengaduan', compact('pengaduans'));
    }

    # SUPER ADMIN
    public function showTindakLanjutsuper($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('superadmin.tindak-lanjut', compact('pengaduan'));
    }

    # USER
    public function create()
    {
        return view('user.home'); // Ganti dengan path view Anda
    }

    # BELUM
    public function downloadFile($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $path = storage_path('app/public/' . $pengaduan->file_pendukung);

        if (!Storage::exists('public/' . $pengaduan->file_pendukung)) {
            abort(404, 'File not found');
        }

        return response()->download($path);
    }
}