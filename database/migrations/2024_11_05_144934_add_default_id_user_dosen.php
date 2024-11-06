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
        Schema::table('dosen', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            // Ubah kembali kolom 'id_user' ke tipe sebelumnya (jika perlu)
            $table->unsignedBigInteger('id_user')->nullable(false)->change();
        });
    }
};
