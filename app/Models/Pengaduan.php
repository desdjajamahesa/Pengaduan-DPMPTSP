<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'user_id',
        'judul_pengaduan',
        'tanggal_pengaduan',
        'lokasi_kejadian',
        'alamat',
        'isi_pengaduan',
        'status',  // Tambahkan status di sini
    ];

    // Relasi ke tabel users (relasi many-to-one)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
