<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{

    public function index(Request $request)
    {
        // Mengambil semua data pengaduan beserta relasi user
        $pengaduans = Pengaduan::with('user')->get();
        $query = Pengaduan::query();
        // Pencarian
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

        // Pagination
        $pengaduans = $query->paginate(10); // Ubah jumlah halaman sesuai kebutuhan

        return view('admin.pengaduan', compact('pengaduans'));
    }
    public function showTindakLanjut($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('admin.tindak-lanjut', compact('pengaduan'));
    }
    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // Validasi input
        $request->validate([
            'status' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        // Update pengaduan dengan data tindak lanjut
        $pengaduan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pengaduan')->with('success', 'Pengaduan berhasil ditindak lanjuti!');
    }

    public function store(Request $request)
    {
        // Validasi input pengaduan
        $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'tanggal_pengaduan' => 'required|date',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
        ]);

        // Simpan pengaduan ke database
        Pengaduan::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'judul_pengaduan' => $request->judul_pengaduan,
            'tanggal_pengaduan' => $request->tanggal_pengaduan,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'alamat' => $request->alamat,
            'isi_pengaduan' => $request->isi_pengaduan,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Pengaduan berhasil disimpan!');
    }
}
