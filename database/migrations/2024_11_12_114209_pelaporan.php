<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pengaduan');
            $table->string('platform')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('nib')->nullable();
            $table->text('isi_pengaduan');
            $table->timestamp('tanggal_pengaduan');
            $table->string('tindaklanjut')->nullable();
            $table->string('tautan_percakapan')->nullable();
            $table->string('tangkapan_layar')->nullable();
            $table->string('petugas_pelayanan')->nullable();
            $table->string('status');
            $table->string('kesesuaian_sop')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelaporan');
    }
};

