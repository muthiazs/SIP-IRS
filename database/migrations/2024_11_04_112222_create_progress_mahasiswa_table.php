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
        Schema::create('progress_mahasiswa', function (Blueprint $table) {
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa', 'id_mahasiswa');
            $table->integer('semester_studi');
            $table->float('IPk');
            $table->float('IPs_lalu');
            $table->integer('SKSk');
            $table->string('status')->default('aktif');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_mahasiswa');
    }
};
