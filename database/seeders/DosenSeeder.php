<?php
// database/seeders/DosenSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $dosens = [
            [
                'id_dosen' => 1, // Kusworo Adi
                'nip' => '197203171998021001',
                'nama' => 'Prof. Dr. Kusworo Adi, S.Si., M.T.',
                'prodi_id' => '4', // Departemen Fisika
                'created_at' => now(),
            ],
            [
                'id_dosen' => 2, // Aris Sugiharto
                'nip' => '197108111997021004',
                'nama' => 'Dr. Aris Sugiharto, S.Si., M.Kom.',
                'prodi_id' => '1', // Informatika
                'created_at' => now(),
            ],
            [
                'id_dosen' => 3,
                'nip' => '197601102009122002',
                'nama' => 'Dinar Mutiara Kusumo Nugraheni, S.T., M.InfoTech.(Comp)., Ph.D.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
        ];

        DB::table('dosen')->insert($dosens);
    }
}