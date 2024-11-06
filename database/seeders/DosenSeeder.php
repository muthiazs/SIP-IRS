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
                'id_dosen' => 18,
                'id_user' => 1, // Pastikan id_user sesuai dengan id pengguna yang ada di tabel users
                'nip' => '197203171998021001',
                'nama' => 'Prof. Dr. Kusworo Adi, S.Si., M.T.',
                'prodi_id' => '4',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 19,
                'id_user' => 2, // Sesuaikan dengan id_user yang valid
                'nip' => '197108111997021004',
                'nama' => 'Dr. Aris Sugiharto, S.Si., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 20,
                'id_user' => 3, // Sesuaikan dengan id_user yang valid
                'nip' => '197601102009122002',
                'nama' => 'Dinar Mutiara Kusumo Nugraheni, S.T., M.InfoTech.(Comp)., Ph.D.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
        ];
    
        DB::table('dosen')->insert($dosens);
    }
    
    
}