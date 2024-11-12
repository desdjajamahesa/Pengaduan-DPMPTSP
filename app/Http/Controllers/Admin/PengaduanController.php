<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    $pengaduans = $query->with('user')->paginate(5);

    return view('admin.pengaduan', compact('pengaduans'));
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
          'file_pendukung' => 'required|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048',
          'file_balasan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048',
          'kesesuaian_sop' => 'required|in:sesuai dengan sop,melebihi sop,lebih cepat dari sop',
          'admin' => 'required|string|max:100' // Tambahkan validasi kesesuaian_sop
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
              $filePathBalasanForDB = str_replace('public/', '', $fileBalasan);
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
              'status' => 'belum_proses',
              'kesesuaian_sop' => $validated['kesesuaian_sop'],
              'admin' => $validated['admin'] // Simpan kesesuaian_sop
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

      $validated = $request->validate([
          'status' => 'required|in:belum_proses,proses,selesai,dilanjutkan',
          'tindaklanjut' => 'required|string|max:500',
          'file_balasan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:2048',
          'kesesuaian_sop' => 'required|in:sesuai dengan sop,melebihi sop,lebih cepat dari sop',
          'admin' => 'required|string|max:100' // Tambahkan validasi kesesuaian_sop
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
          'status' => $validated['status'],
          'tindaklanjut' => $validated['tindaklanjut'],
          'file_balasan' => $fileBalasanPathForDB,
          'kesesuaian_sop' => $validated['kesesuaian_sop'],
          'admin' => $validated['admin'] // Update kesesuaian_sop
      ]);

      return redirect()->route('admin.pengaduan')->with('success', 'Pengaduan berhasil ditindak lanjuti!');
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
