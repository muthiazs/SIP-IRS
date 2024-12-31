<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TambahJadwalSeeder extends Seeder
{
    public function run()
    {
        DB::table('jadwal_kuliah')->insert([
            'kode_matkul' => 'PAIK6303', // Ganti sesuai data yang disediakan
            'semester' => 3,
            'kelas' => 'D',
            'hari' => 'Senin',
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '10:00:00',
            'id_periode' => '24251',
            'id_ruang' => 3,
            'id_dosen' => 11,
            'kuota' => 2, // Tetap gunakan kuota 2 seperti request
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

