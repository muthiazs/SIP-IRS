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
                'id_mahasiswa' => 1,
                'semester_studi' => 3,
                'IPk' => 3.92,
                'IPs_lalu' => 3.8,
                'SKSk' => 45,
                'status' => 'aktif',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [
                'id_mahasiswa' => 2,
                'semester_studi' => 3,
                'IPk' => 4.0,
                'IPs_lalu' => 4.0,
                'SKSk' => 45,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 3,
                'semester_studi' => 5,
                'IPk' => 4.0,
                'IPs_lalu' => 4.0,
                'SKSk' => 87,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 4,
                'semester_studi' => 5,
                'IPk' => 4.0,
                'IPs_lalu' => 4.0,
                'SKSk' => 85,
                'status' => 'aktif',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
        ];

        DB::table('progress_mahasiswa')->insert($data);
    }
}
