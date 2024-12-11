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
        Schema::table('matakuliah', function (Blueprint $table) {
            $table->unsignedBigInteger('id_prodi')->after('sks');

            // Assuming the program_studi table exists
            $table->foreign('id_prodi')->references('id_prodi')->on('program_studi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matakuliah', function (Blueprint $table) {
            $table->dropForeign(['id_prodi']);
            $table->dropColumn('id_prodi');
        });
    }
};