<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul_pengaduan');
            $table->date('tanggal_pengaduan');
            $table->string('lokasi_kejadian');
            $table->string('alamat');
            $table->text('isi_pengaduan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
};
