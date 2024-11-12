<?php

namespace App\Exports;

use App\Models\Pelaporan;
use App\Models\Pengaduan;  // Pastikan sudah ada model Pengaduan
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengaduanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil data dari pelaporan dan pengaduan
        return Pelaporan::with(['user:id,email,name', 'pengaduan:id,pelaporan_id,judul_pengaduan,platform,isi_pengaduan'])
            ->select(
                'id',
                'judul_pengaduan',
                'platform',
                'user_id',
                'nib',
                'tanggal_pengaduan',
                'isi_pengaduan',
                'tindaklanjut',
                'tautan_percakapan',
                'tangkapan_layar',
                'petugas_pelayanan',
                'status',
                'kesesuaian_sop'
            )
            ->get()
            ->map(function ($pelaporan) {
                $pengaduan = $pelaporan->pengaduan; // Mengambil relasi pengaduan
                return [
                    'id' => $pelaporan->id,
                    'judul_pengaduan' => $pengaduan->judul_pengaduan ?? 'N/A',  // Data dari tabel pengaduan
                    'platform' => $pengaduan->platform ?? 'N/A',  // Data dari tabel pengaduan
                    'email' => $pelaporan->user->email ?? 'N/A', // Data dari tabel user (relasi)
                    'username' => $pelaporan->user->name ?? 'N/A', // Data dari tabel user (relasi)
                    'nib' => $pelaporan->nib ?? 'N/A',
                    'tanggal_pengaduan' => $pelaporan->tanggal_pengaduan,
                    'isi_pengaduan' => $pengaduan->isi_pengaduan ?? 'N/A',  // Data dari tabel pengaduan
                    'tindaklanjut' => $pelaporan->tindaklanjut ?? 'Belum Ditindaklanjuti',
                    'tautan_percakapan' => $pelaporan->tautan_percakapan ?? 'N/A',
                    'tangkapan_layar' => $pelaporan->tangkapan_layar ?? 'N/A',
                    'petugas_pelayanan' => $pelaporan->petugas_pelayanan ?? 'N/A',
                    'status' => $pelaporan->status,
                    'kesesuaian_sop' => $pelaporan->kesesuaian_sop ?? 'Belum Diperiksa',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Pelaporan',
            'Judul Pengaduan',
            'Platform Pengaduan',
            'Email Pengguna',
            'Username Pengguna',
            'NIB/Nomor Resi/Nomor Permohonan/Jenis Permohonan',
            'Waktu Pengaduan',
            'Isi Pengaduan',
            'Waktu Jawab',
            'Tautan Percakapan',
            'Tangkapan Layar',
            'Petugas Yang Melayani',
            'Status Pelaporan',
            'Kesesuaian SOP'
        ];
    }
}
