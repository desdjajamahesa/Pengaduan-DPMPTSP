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

    if($request->has('search') && $request->search != '')
    {
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
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'tindaklanjut' => $request->tindaklanjut,
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