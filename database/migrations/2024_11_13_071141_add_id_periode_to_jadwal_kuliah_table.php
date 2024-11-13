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
        Schema::table('jadwal_kuliah', function (Blueprint $table) {
            $table->string('id_periode')->after('semester'); // Sesuaikan tipe data jika perlu
        });
    }

    public function down()
    {
        Schema::table('jadwal_kuliah', function (Blueprint $table) {
            $table->dropColumn('id_periode');
        });
    }

};
