<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Menambahkan foreign key untuk kolom id_prodi
            $table->foreign('id_prodi')
                  ->references('id_prodi')
                  ->on('program_studi')
                  ->onDelete('cascade'); // sesuaikan aksi onDelete sesuai kebutuhan

            // Menambahkan foreign key untuk kolom id_dosen
            $table->foreign('id_dosen')
                  ->references('id_dosen')
                  ->on('dosen')
                  ->onDelete('cascade'); // sesuaikan aksi onDelete sesuai kebutuhan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['id_prodi']);
            $table->dropForeign(['id_dosen']);
        });
    }
};
