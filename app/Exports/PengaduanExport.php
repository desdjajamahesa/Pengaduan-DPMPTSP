<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengaduanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil kolom yang ada di model Pengaduan dan relasi User
        return Pengaduan::with('user:id,email,name')
            ->select('id', 'judul_pengaduan', 'tanggal_pengaduan', 'isi_pengaduan', 'tindaklanjut', 'status')
            ->get()
            ->map(function ($pengaduan) {
                return [
                    'id' => $pengaduan->id,
                    'judul_pengaduan' => $pengaduan->judul_pengaduan,
                    'email' => $pengaduan->user->email ?? 'N/A', // Pastikan user ada atau beri nilai 'N/A'
                    'username' => $pengaduan->user->name ?? 'N/A',
                    'tanggal_pengaduan' => $pengaduan->tanggal_pengaduan,
                    'isi_pengaduan' => $pengaduan->isi_pengaduan,
                    'tindaklanjut' => $pengaduan->tindaklanjut ?? 'Belum Ditindaklanjuti',
                    'status' => $pengaduan->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID', 'Jenis Pengaduan', 'Email', 'Username', 'Waktu Pengaduan', 'Isi Pengaduan', 'Waktu Jawab', 'Status'
        ];
    }
}
