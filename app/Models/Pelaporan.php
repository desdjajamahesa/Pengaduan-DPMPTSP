<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;

    protected $table = 'pelaporan';

    protected $fillable = [
        'user_id',
        'judul_pengaduan',
        'platform',
        'nib',
        'tanggal_pengaduan',
        'isi_pengaduan',
        'tindaklanjut',
        'tautan_percakapan',
        'tangkapan_layar',
        'petugas_pelayanan',
        'status',
        'kesesuaian_sop',
    ];

    protected $casts = [
        'tanggal_pengaduan' => 'datetime',
    ];

    // Relasi ke tabel users (many-to-one)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel pengaduan (one-to-one)
    public function pengaduan()
    {
        return $this->hasOne(Pengaduan::class, 'pelaporan_id'); // 'pelaporan_id' adalah foreign key di tabel pengaduan
    }
}

    

