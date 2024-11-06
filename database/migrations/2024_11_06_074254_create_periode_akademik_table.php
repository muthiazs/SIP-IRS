<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodeAkademikTable extends Migration
{
    public function up()
    {
        Schema::create('periode_akademik', function (Blueprint $table) {
            $table->string('id_periode')->primary(); // id_periode sesuai format
            $table->string('nama_periode');          // nama periode, misalnya "Semester Akademik 2024/2025 Ganjil"
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periode_akademik');
    }
}
