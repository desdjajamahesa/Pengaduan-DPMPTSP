<?php
namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengaduanExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pengaduan::select(
            'id',
            'user_id',
            'judul_pengaduan',
            'tanggal_pengaduan',
            'lokasi_kejadian',
            'alamat',
            'isi_pengaduan',
            'status',
            'tindaklanjut',
            'pelaporan_id',
            'jenis',
            'platform',
            'kesesuaian_sop'
        )->get();
    }

    /**
     * Menentukan header untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Judul Pengaduan',
            'Tanggal Pengaduan',
            'Lokasi Kejadian',
            'Alamat',
            'Isi Pengaduan',
            'Status',
            'Tindak Lanjut',
            'Pelaporan ID',
            'Jenis',
            'Platform',
            'Kesesuaian SOP'
        ];
    }
}
