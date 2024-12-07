<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeriodeAkademikSeeder extends Seeder
{
    public function run()
    {
        // Ambil tanggal saat ini
        $currentDate = Carbon::now();
        
        // Data periode akademik
        $periode = [
            [
                'id_periode' => '23242',
                'nama_periode' => 'Semester Akademik 2023/2024 Genap',
                'tahun_mulai' => '2023-08-03 00:00:00',
                'tahun_selesai' => '2023-12-03 23:59:59',
                'jenis' => 'genap',
            ],
            [
                'id_periode' => '24251',
                'nama_periode' => 'Semester Akademik 2024/2025 Ganjil',
                'tahun_mulai' => $currentDate->subWeek(1)->toDateTimeString(), // 2 minggu dari sekarang + 1 tahun
                'tahun_selesai' => $currentDate->copy()->addWeeks(3)->addYear()->toDateTimeString(), // 3 minggu dari sekarang + 1 tahun
                'jenis' => 'ganjil',
            ]
        ];

        // Insert data periode akademik
        DB::table('periode_akademik')->insert($periode);
    }
}
