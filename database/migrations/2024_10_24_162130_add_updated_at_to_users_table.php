<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// class AddUpdatedAtToUsersTable extends Migration
// {
//     public function up()
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->timestamp('updated_at')->nullable(); // Add the updated_at column
//         });
//     }

//     public function down()
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->dropColumn('updated_at'); // Drop the updated_at column if rolled back
//         });
//     }
// }


class AddUpdatedAtToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom 'updated_at' sudah ada sebelum menambahkannya
            if (!Schema::hasColumn('users', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom 'updated_at' ada sebelum menghapusnya
            if (Schema::hasColumn('users', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
}
