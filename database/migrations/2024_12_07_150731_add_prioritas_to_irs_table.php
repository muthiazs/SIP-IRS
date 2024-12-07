<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrioritasToIrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('irs', function (Blueprint $table) {
            $table->integer('prioritas')->after('status')->default(0)->comment('Level prioritas untuk IRS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('irs', function (Blueprint $table) {
            $table->dropColumn('prioritas');
        });
    }
}

