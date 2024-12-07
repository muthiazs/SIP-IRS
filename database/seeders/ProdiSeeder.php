<?php
// database/seeders/ProdiSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $prodis = [
            [
                'id_prodi' => 1,
                'nama' => 'Informatika',
                'kaprodi_id' => 2, // Dr. Aris Sugiharto, sesuai permintaan
                'id_fak' => 1, // Misalkan Fakultas Sains dan Matematika
                'created_at' => now(),
            ],
            [
                'id_prodi' => 2,
                'nama' => 'Kimia',
                'kaprodi_id' => 14, // Randomly chosen: Prof. Dr. Dra. Meiny Suzery
                'id_fak' => 1,
                'created_at' => now(),
            ],
            [
                'id_prodi' => 3,
                'nama' => 'Biologi',
                'kaprodi_id' => 15, // Randomly chosen: Dr.rer.nat. Anto Budiharjo
                'id_fak' => 1,
                'created_at' => now(),
            ],
            [
                'id_prodi' => 4,
                'nama' => 'Fisika',
                'kaprodi_id' => 1, // Randomly chosen: Prof. Dr. Kusworo Adi
                'id_fak' => 1,
                'created_at' => now(),
            ],
            [
                'id_prodi' => 5,
                'nama' => 'Matematika',
                'kaprodi_id' => 16, // Randomly chosen: Prof. Dr. Widowati
                'id_fak' => 1,
                'created_at' => now(),
            ],
            [
                'id_prodi' => 6,
                'nama' => 'Statistika',
                'kaprodi_id' => 17, // Randomly chosen: Arief Rachman Hakim
                'id_fak' => 1,
                'created_at' => now(),
            ],
            [
                'id_prodi' => 7,
                'nama' => 'Bioteknologi',
                'kaprodi_id' => 20, 
                'id_fak' => 1,
                'created_at' => now(),
            ],
        ];

        DB::table('program_studi')->insert($prodis);
    }
}
