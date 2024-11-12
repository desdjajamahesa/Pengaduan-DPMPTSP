<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengaduanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengaduan::select( 'id','user_id', 'judul_pengaduan', 'tanggal_pengaduan','lokasi_kejadian', 'alamat','isi_pengaduan','status','file_pendukung', 'file_balasan','tindaklanjut',)->get();
    }

    public function headings(): array
    {
        return [
        'ID',
        'user_id',
        'judul_pengaduan',
        'tanggal_pengaduan',
        'lokasi_kejadian',
        'alamat',
        'isi_pengaduan',
        'status',
        'file_pendukung',
        'file_balasan',
        'tindaklanjut',
        'pelaporan_id',
        ];
    }
}
