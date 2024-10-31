<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\Controller;

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

    public function store(Request $request)
    {
        // Validasi data yang di-submit
        $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'tanggal_pengaduan' => 'required|date',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'file_pendukung' => 'required|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048', // Maksimal 2MB
        ]);

        // Ambil data dari form
        $pengaduan = new Pengaduan();
        $pengaduan->user_id = Auth::id();
        $pengaduan->judul_pengaduan = $request->input('judul_pengaduan');
        $pengaduan->isi_pengaduan = $request->input('isi_pengaduan');
        $pengaduan->tanggal_pengaduan = $request->input('tanggal_pengaduan');
        $pengaduan->lokasi_kejadian = $request->input('lokasi_kejadian');
        $pengaduan->alamat = $request->input('alamat');

        // Handle upload file
        if ($request->hasFile('file_pendukung')) {
            $file = $request->file('file_pendukung');
            $filePath = $file->store('file_pendukung', 'public'); // Simpan ke storage/public/file_pendukung
            $pengaduan->file_pendukung = $filePath; // Simpan path file ke database
        }

        // Simpan data pengaduan ke database
        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim');
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
