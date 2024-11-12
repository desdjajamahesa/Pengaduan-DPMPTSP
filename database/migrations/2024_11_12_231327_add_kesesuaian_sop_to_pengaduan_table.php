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
            $table->enum('kesesuaian_sop', ['sesuai dengan sop', 'melebihi sop', 'lebih cepat dari sop'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropColumn('kesesuaian_sop');
        });
    }
};
