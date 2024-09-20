<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan (jika nama tabel berbeda)
    protected $table = 'sops';

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = ['image_url'];
}
