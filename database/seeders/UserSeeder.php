<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Pastikan User model diimport di sini

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan factory untuk membuat 10 data user dummy
        User::factory()->count(10)->create();
    }
}
