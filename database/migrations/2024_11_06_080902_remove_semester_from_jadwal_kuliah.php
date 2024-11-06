<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSemesterFromJadwalKuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tidak ada perubahan untuk up, karena kita hanya akan menghapus kolom pada migrasi down
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_kuliah', function (Blueprint $table) {
            $table->dropColumn('semester'); // Menghapus kolom semester
        });
    }
}
