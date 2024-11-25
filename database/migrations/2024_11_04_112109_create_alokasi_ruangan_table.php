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
        Schema::create('alokasi_ruangan', function (Blueprint $table) {
            $table->foreignId('id_ruang')->constrained('ruangan', 'id_ruang');
            $table->foreignId('id_prodi')->constrained('program_studi', 'id_prodi');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alokasi_ruangan');
    }
};
