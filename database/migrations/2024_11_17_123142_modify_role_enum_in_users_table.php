<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyRoleEnumInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update data yang tidak sesuai dengan ENUM baru
        DB::table('users')->where('role', 'pengadu')->update(['role' => 'pelapor']);

        // Modifikasi kolom 'role'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'super_admin', 'pelapor'])
                  ->default('pelapor')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'super_admin', 'pengadu'])
                  ->default('pengadu')
                  ->change();
        });
    }
}

