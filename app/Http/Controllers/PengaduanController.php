<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PengaduanController extends Controller
{
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id); // Mencari pengaduan berdasarkan id
        return view('user.detail', compact('pengaduan')); // Mengirimkan data pengaduan ke view
    }
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

        $pengaduans = $query->with('user')->paginate(5);

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
        // Cek apakah route atau URL berasal dari superadmin
        if (request()->is('superadmin/pengaduan/*')) {
            // Jika route mengandung 'superadmin/pengaduan', tampilkan view superadmin
            $view = 'superadmin.tindak-lanjut';
        } else {
            // Jika bukan, tampilkan view admin
            $view = 'admin.tindak-lanjut';
        }
        return view($view, compact('pengaduan'));
    }
    public function showTindakLanjutsuper($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('superadmin.tindak-lanjut', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:belum_proses,proses,selesai,dilanjutkan',
            'tindaklanjut' => 'required|string|max:500',
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'tindaklanjut' => $request->tindaklanjut,
        ]);

        return redirect()->route('admin.pengaduan')->with('success', 'Pengaduan berhasil ditindak lanjuti!');
    }

    public function create()
    {
        return view('user.home'); // Ganti dengan path view Anda
    }

    public function downloadFile($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $path = storage_path('app/public/' . $pengaduan->file_pendukung);

        if (!Storage::exists('public/' . $pengaduan->file_pendukung)) {
            abort(404, 'File not found');
        }

        return response()->download($path);
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'tanggal_pengaduan' => 'required|date',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            
            // 'file_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048', // validasi file
        ]);
        // $request->validate([
        //     'file_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048',

        // ]);
        // Simpan data pengaduan tanpa file terlebih dahulu
        $pengaduan = Pengaduan::create([
            'user_id' => Auth::id(), // Pastikan user_id disertakan
            'judul_pengaduan' => $request->judul_pengaduan,
            'tanggal_pengaduan' => $request->tanggal_pengaduan,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'alamat' => $request->alamat,
            'isi_pengaduan' => $request->isi_pengaduan,
            'tindaklanjut' =>  $request->tindakLanjut ?? null, // Optional jika tidak ada tindak lanjut
        ]);

        // Proses upload file pendukung
        if ($request->hasFile('file_pendukung')) {
            // Dapatkan file yang diupload
            $file = $request->file('file_pendukung');

            // Buat nama file yang unik berdasarkan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file di storage public
            $filePath = $file->storeAs('file_pendukung', $fileName, 'public');

            // Simpan path file ke dalam database
            $pengaduan->file_pendukung = $filePath;
            $pengaduan->save(); // Simpan kembali dengan path file
        }

        // Redirect ke halaman form pengaduan dengan pesan sukses
        return redirect()->route('pengaduan.form')->with('success', 'Pengaduan berhasil disimpan!');
    }
    public function batalkan($id)
    {
        // Temukan pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);

        // Pastikan hanya pengaduan yang belum selesai yang dapat dibatalkan
        if ($pengaduan->status == 'selesai') {
            return redirect()->back()->with('error', 'Pengaduan yang sudah selesai tidak dapat dibatalkan.');
        }

        // Update status pengaduan menjadi "dibatalkan"
        $pengaduan->update([
            'status' => 'dibatalkan',
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dibatalkan.');
    }

    // Tambahkan method untuk mengunduh file

}
