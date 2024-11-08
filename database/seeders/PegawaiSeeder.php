<?php
// database/seeders/PegawaiSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $pegawai = [
            [
                'id_pegawai' => 1,
                'nama' => 'Awang Kurnia Saputra, S.Kom',
                'nip' => '197801252001121001',
                'id_fak' => 1, // ID Fakultas yang terkait
                'id_user' => 4, // ID User yang terkait
                'created_at' => now(),
            ],
        ];

        DB::table('pegawai')->insert($pegawai);
    }
}
