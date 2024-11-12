<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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


    public function store(Request $request)
    {
        // Validasi data yang di-submit
        $validated = $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'tanggal_pengaduan' => 'required|date',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'file_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048',
            'file_balasan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048' // Mengubah menjadi nullable
        ]);

        try {
            // Handle file upload for file_pendukung
            if ($request->hasFile('file_pendukung')) {
                $filePendukung = $request->file('file_pendukung');
                $fileNamePendukung = time() . '_pendukung_' . $filePendukung->getClientOriginalName();
                $filePathPendukung = $filePendukung->storeAs('public/file_pendukung', $fileNamePendukung);
                $filePathPendukungForDB = str_replace('public/', '', $filePathPendukung);
            }

            // Handle file upload for file_balasan
            if ($request->hasFile('file_balasan')) {
                $fileBalasan = $request->file('file_balasan');
                $fileNameBalasan = time() . '_balasan_' . $fileBalasan->getClientOriginalName();
                $filePathBalasan = $fileBalasan->storeAs('public/file_balasan', $fileNameBalasan);
                $filePathBalasanForDB = str_replace('public/', '', $filePathBalasan);
            }

            // Create new pengaduan with all data
            $pengaduan = Pengaduan::create([
                'user_id' => Auth::id(),
                'judul_pengaduan' => $validated['judul_pengaduan'],
                'isi_pengaduan' => $validated['isi_pengaduan'],
                'tanggal_pengaduan' => $validated['tanggal_pengaduan'],
                'lokasi_kejadian' => $validated['lokasi_kejadian'],
                'alamat' => $validated['alamat'],
                'file_pendukung' => $filePathPendukungForDB ?? null,
                'file_balasan' => $filePathBalasanForDB ?? null,
                'status' => 'belum_proses'
            ]);

            return redirect()->route('pengaduan.index')
                ->with('success', 'Pengaduan berhasil dikirim');
        } catch (\Exception $e) {
            // Hapus file jika terjadi kesalahan
            if (isset($filePathPendukung) && Storage::exists($filePathPendukung)) {
                Storage::delete($filePathPendukung);
            }
            if (isset($filePathBalasan) && Storage::exists($filePathBalasan)) {
                Storage::delete($filePathBalasan);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
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

    // Add new download method
    public function download($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->file_pendukung) {
            $filePath = 'public/' . $pengaduan->file_pendukung;

            if (Storage::exists($filePath)) {
                return Storage::download($filePath);
            }
        }
        if ($pengaduan->file_balasan) {
            $filePath = 'public/' . $pengaduan->file_balasan;

            if (Storage::exists($filePath)) {
                return Storage::download($filePath);
            }
        }
        return redirect()->back()->with('error', 'File tidak ditemukan');
    }

    public function showTindakLanjut($id)
    {
        $pengaduan = Pengaduan::findOrFail($id); // Ambil pengaduan berdasarkan id pengaduan
        return view('admin.tindak-lanjut', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:belum_proses,proses,selesai,dilanjutkan',
            'tindaklanjut' => 'required|string|max:500',
            'file_balasan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048'
        ]);

        $fileBalasanPathForDB = $pengaduan->file_balasan;

        // Handle upload file_balasan jika ada file yang diunggah
        if ($request->hasFile('file_balasan')) {
            $fileBalasan = $request->file('file_balasan');
            $fileBalasanName = time() . '_balasan_' . $fileBalasan->getClientOriginalName();
            $fileBalasanPath = $fileBalasan->storeAs('public/file_balasan', $fileBalasanName);
            $fileBalasanPathForDB = str_replace('public/', '', $fileBalasanPath);

            // Hapus file lama jika ada
            if ($pengaduan->file_balasan && Storage::exists('public/' . $pengaduan->file_balasan)) {
                Storage::delete('public/' . $pengaduan->file_balasan);
            }
        }

        $pengaduan->update([
            'status' => $request->status,
            'tindaklanjut' => $request->tindaklanjut,
            'file_balasan' => $fileBalasanPathForDB
        ]);

        return redirect()->route('superadmin.pengaduan')->with('success', 'Pengaduan berhasil ditindak lanjuti!');
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
}
