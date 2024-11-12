<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Kolom id yang otomatis auto-increment
            $table->string('name'); // Kolom untuk nama pengguna
            $table->string('email')->unique(); // Kolom email yang unik
            $table->string('password'); // Kolom password
            $table->string('telephone')->nullable(); // Kolom nomor telepon (opsional)
            $table->string('address')->nullable(); // Kolom alamat (opsional)
            $table->enum('role', ['admin', 'super_admin', 'pengadu'])->default('pengadu'); // Kolom role untuk menentukan peran pengguna
            $table->rememberToken(); // Kolom untuk "remember me" pada login
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
