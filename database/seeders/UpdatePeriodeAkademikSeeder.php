<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdatePeriodeAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Perbarui data untuk tabel periode_akademik
        DB::table('periode_akademik')->update([
            [
                'id_periode' => 23242, // ID untuk "Semester Akademik 2023/2024 Genap"
                'nama_periode' => 'Semester Akademik 2023/2024 Genap',
                'tahun_mulai' => '2024-01-03 00:00:00',
                'tahun_selesai' => '2024-07-05 23:59:59',
                'updated_at' => now(),
            ],
            [
                'id_periode' => 24251, // ID untuk "Semester Akademik 2024/2025 Ganjil"
                'nama_periode' => 'Semester Akademik 2024/2025 Ganjil',
                'tahun_mulai' => '2024-07-10 00:00:00', // Updated start date
                'tahun_selesai' => '2025-01-10 23:59:59', // Updated end date
                'updated_at' => now(),
            ],
        ]);
    }
}
