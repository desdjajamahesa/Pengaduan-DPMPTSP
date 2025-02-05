<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
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
        'jenis',
        'platform',
        'kesesuaian_sop',
        'admin', 
        'kategori_bidang'
    ];

    protected $casts = [
        'tanggal_pengaduan' => 'datetime',
    ];

    // Relasi ke tabel users (many-to-one)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel pelaporan (one-to-one)
    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class, 'pelaporan_id');
    }
}

