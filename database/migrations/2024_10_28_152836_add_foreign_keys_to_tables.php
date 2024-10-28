<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add foreign key for 'mahasiswa' table
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Foreign key for 'dosen_pembimbing_id'
            $table->foreign('dosen_pembimbing_id')->references('id')->on('dosen')->onDelete('set null');
        });

        // Add foreign key for 'dosen' table
        Schema::table('program_studi', function (Blueprint $table) {
            // Foreign key for 'kaprodi_id'
            $table->foreign('kaprodi_id')->references('id')->on('dosen')->onDelete('set null');
        });

        // Add foreign key for 'jadwal_kuliah' table
        Schema::table('jadwal_kuliah', function (Blueprint $table) {
            // Foreign key for 'mata_kuliah_id', 'dosen_id', and 'ruangan_id'
            $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangan')->onDelete('cascade');
        });

        // Add foreign key for 'irs_detail' table
        Schema::table('irs_detail', function (Blueprint $table) {
            // Foreign key for 'irs_id' and 'jadwal_kuliah_id'
            $table->foreign('irs_id')->references('id')->on('irs')->onDelete('cascade');
            $table->foreign('jadwal_kuliah_id')->references('id')->on('jadwal_kuliah')->onDelete('cascade');
        });

        // Add foreign key for 'alokasi_ruangan' table
        Schema::table('alokasi_ruangan', function (Blueprint $table) {
            // Foreign key for 'ruangan_id' and 'prodi_id'
            $table->foreign('ruangan_id')->references('id')->on('ruangan')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('program_studi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop foreign key for 'mahasiswa' table
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['dosen_pembimbing_id']);
        });

        // Drop foreign key for 'program_studi' table
        Schema::table('program_studi', function (Blueprint $table) {
            $table->dropForeign(['kaprodi_id']);
        });

        // Drop foreign key for 'jadwal_kuliah' table
        Schema::table('jadwal_kuliah', function (Blueprint $table) {
            $table->dropForeign(['mata_kuliah_id']);
            $table->dropForeign(['dosen_id']);
            $table->dropForeign(['ruangan_id']);
        });

        // Drop foreign key for 'irs_detail' table
        Schema::table('irs_detail', function (Blueprint $table) {
            $table->dropForeign(['irs_id']);
            $table->dropForeign(['jadwal_kuliah_id']);
        });

        // Drop foreign key for 'alokasi_ruangan' table
        Schema::table('alokasi_ruangan', function (Blueprint $table) {
            $table->dropForeign(['ruangan_id']);
            $table->dropForeign(['prodi_id']);
        });
    }
};
