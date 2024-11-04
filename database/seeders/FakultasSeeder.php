<?php
// database/seeders/FakultasSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        $fakultas = [
            [
                'id_fak' => 1,
                'nama' => 'Fakultas Sains dan Matematika',
                'dekan_id' => 1, // Misalkan ID dekan adalah 1, sesuaikan sesuai dengan ID yang ada di tabel dosen
                'created_at' => now(),
            ],
        ];

        DB::table('fakultas')->insert($fakultas);
    }
}
