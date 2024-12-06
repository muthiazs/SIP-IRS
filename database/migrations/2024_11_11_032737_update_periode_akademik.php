<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePeriodeAkademik extends Migration
{
    public function up()
    {
        Schema::table('periode_akademik', function (Blueprint $table) {
            $table->dateTime('tahun_mulai')->nullable();
            $table->dateTime('tahun_selesai')->nullable();
            $table->enum('jenis', ['ganjil', 'genap'])->nullable();
        });
    }

    public function down()
    {
        Schema::table('periode_akademik', function (Blueprint $table) {
            $table->dropColumn(['tahun_mulai', 'tahun_selesai', 'jenis']);
        });
    }
}
