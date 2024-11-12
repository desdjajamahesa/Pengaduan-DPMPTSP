<?php
// app/Exports/PengaduanExport.php
namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengaduanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil data pengaduan beserta relasi user (pelapor) dan admin (petugas pelayanan)
        return Pengaduan::with('user')->get()->map(function ($pengaduan) {
            return [
                'ID' => $pengaduan->id,
                'Jenis' => $pengaduan->jenis,
                'Platform' => $pengaduan->platform,
                'Email Pelapor' => $pengaduan->user->email ?? 'N/A',
                'Nama Pelapor' => $pengaduan->user->name ?? 'N/A',
                'NIB/No Resi/Permohonan' => $pengaduan->id,
                'Waktu Pengaduan' => $pengaduan->tanggal_pengaduan->format('d-m-Y H:i'),
                'Isi Pengaduan' => $pengaduan->isi_pengaduan,
                'Tindak Lanjut' => $pengaduan->tindaklanjut ?? 'Belum Ditindaklanjuti',
                'Petugas Pelayanan' => $pengaduan->admin->name ?? 'N/A',
                'Status' => $pengaduan->status,
                'Kesesuaian SOP' => $pengaduan->kesesuaian_sop ?? 'Belum Diperiksa',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Jenis',
            'Platform',
            'Email Pelapor',
            'Nama Pelapor',
            'NIB/No Resi/Permohonan',
            'Waktu Pengaduan',
            'Isi Pengaduan',
            'Tindak Lanjut',
            'Petugas Pelayanan',
            'Status',
            'Kesesuaian SOP',
        ];
    }
}
