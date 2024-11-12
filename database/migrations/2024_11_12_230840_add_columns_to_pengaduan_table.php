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
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->string('jenis')->default('pengaduan'); // kolom baru dengan default 'auto pengaduan'
            $table->string('platform')->default('SiPadu');  // kolom baru dengan default 'auto sipadu'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'platform']);
        });
    }
};
