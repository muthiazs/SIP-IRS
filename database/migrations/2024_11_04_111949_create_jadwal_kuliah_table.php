
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
        Schema::create('jadwal_kuliah', function (Blueprint $table) {
            $table->bigIncrements('id_jadwal');
            $table->string('kode_matkul');
            $table->integer('kuota');
            $table->foreignId('id_dosen')->constrained('dosen', 'id_dosen');
            $table->foreignId('id_ruang')->constrained('ruangan', 'id_ruang');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('kelas');
            $table->integer('semester');
            $table->string('status')->default('belum_terkonfirmasi');
; // Allow NULL values
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliah');
    }
};
