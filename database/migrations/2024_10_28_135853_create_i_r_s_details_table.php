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
        Schema::create('irs_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('irs_id');
            $table->unsignedBigInteger('jadwal_kuliah_id');
            $table->timestamps();    
        });
    }

    public function down()
    {
        Schema::dropIfExists('irs_detail');
    }
};