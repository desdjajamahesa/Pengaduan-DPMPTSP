<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index(Request $request)
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

        $pengaduans = $query->with('user')->paginate(10);

        return view('admin.pengaduan', compact('pengaduans'));
    }
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

    public function showTindakLanjut($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $view = Auth::user()->is_superadmin ? 'superadmin.tindak-lanjut' : 'admin.tindak-lanjut';

        return view($view, compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pengaduan')->with('success', 'Pengaduan berhasil ditindak lanjuti!');
    }

    public function create()
    {
        return view('user.home'); // Ganti dengan path view Anda
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'tanggal_pengaduan' => 'required|date',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
        ]);

        Pengaduan::create([
            'user_id' => Auth::id(),
            'judul_pengaduan' => $request->judul_pengaduan,
            'tanggal_pengaduan' => $request->tanggal_pengaduan,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'alamat' => $request->alamat,
            'isi_pengaduan' => $request->isi_pengaduan,
        ]);

        return redirect()->route('pengaduan.form')->with('success', 'Pengaduan berhasil disimpan!');
    }
}
