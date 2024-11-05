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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id_mahasiswa');
            $table->foreignId('id_user')->constrained('users', 'id');
            $table->string('nim');
            $table->string('nama');
            $table->foreignId('id_prodi')->constrained('program_studi', 'id_prodi');
            $table->foreignId('id_dosen')->constrained('dosen', 'id_dosen');
            $table->string('angkatan');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
