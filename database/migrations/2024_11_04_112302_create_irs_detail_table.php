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
        Schema::create('irs_detail', function (Blueprint $table) {
            $table->bigIncrements('id_irs_detail');
            $table->foreignId('id_irs')->constrained('irs', 'id_irs');
            $table->foreignId('id_jadwal')->constrained('jadwal_kuliah', 'id_jadwal');
            $table->timestamp('created_at');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs_detail');
    }
};
