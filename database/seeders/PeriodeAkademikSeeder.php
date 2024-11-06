<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeAkademikSeeder extends Seeder
{
    public function run()
    {
        $periodes = [
            ['id_periode' => '24252', 'nama_periode' => 'Semester Akademik 2023/2024 Genap'],
            ['id_periode' => '24251', 'nama_periode' => 'Semester Akademik 2024/2025 Ganjil']
        ];

        foreach ($periodes as $periode) {
            DB::table('periode_akademik')->insert([
                'id_periode' => $periode['id_periode'],
                'nama_periode' => $periode['nama_periode'],
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}
