<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ProgressMhsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_mahasiswa' => 9,
                'semester_studi' => 6,
                'IPk' => 3.92,
                'IPs_lalu' => 3.8,
                'SKSk' => 87,
                'status' => 'aktif',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [
                'id_mahasiswa' => 10,
                'semester_studi' => 6,
                'IPk' => 4.0,
                'IPs_lalu' => 4.0,
                'SKSk' => 90,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 11,
                'semester_studi' => 6,
                'IPk' => 4.0,
                'IPs_lalu' => 4.0,
                'SKSk' => 90,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 12,
                'semester_studi' => 6,
                'IPk' => 4.0,
                'IPs_lalu' => 4.0,
                'SKSk' => 90,
                'status' => 'aktif',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
        ];

        DB::table('progress_mahasiswa')->insert($data);
    }
}
