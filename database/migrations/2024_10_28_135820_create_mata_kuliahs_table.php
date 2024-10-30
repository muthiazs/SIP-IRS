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
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mata_kuliah')->unique();
            $table->string('nama_mata_kuliah');
            $table->integer('sks');
            $table->unsignedBigInteger('prodi_id')->constrained('program_studi')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
       });
    }

    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
};