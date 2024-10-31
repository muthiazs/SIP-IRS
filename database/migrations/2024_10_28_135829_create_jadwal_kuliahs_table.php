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
        Schema::create('jadwal_kuliah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_kuliah_id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('kelas');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->string('status');
            $table->timestamps();           
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_kuliah');
    }
};