<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IrsSeeder extends Seeder
{
    public function run()
    {
        // Data untuk Muthia Zhafira Sahnah (Semester 1 - Kelas A) NIM: 24060122130071
        DB::table('irs')->insert([
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 1,  // id_jadwal untuk Matematika Diskrit
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 2,  // id_jadwal untuk Pemrograman Dasar
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 3,  // id_jadwal untuk Dasar-Dasar Komputer
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 5,  // id_jadwal untuk Bahasa Inggris
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 6,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 7,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 8,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 9,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 1,
                'id_jadwal' => 10,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Data untuk Muthia Zhafira Sahnah (Semester 2 - Kelas A) NIM: 24060122130071
        DB::table('irs')->insert([
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 2,
                'id_jadwal' => 21,  // id_jadwal untuk Matematika Diskrit
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 2,
                'id_jadwal' => 22,  // id_jadwal untuk Pemrograman Dasar
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 2,
                'id_jadwal' => 23,  // id_jadwal untuk Sistem Informasi
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 2,
                'id_jadwal' => 24,  // id_jadwal untuk Dasar-Dasar Komputer
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130071',  // NIM Muthia
                'semester' => 2,
                'id_jadwal' =>25,  // id_jadwal untuk Bahasa Inggris
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Data untuk Tirza Aurellia Wijaya (Semester 1 - Kelas B) NIM: 24060122130047
        DB::table('irs')->insert([
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 1,  // id_jadwal untuk Matematika Diskrit
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 2,  // id_jadwal untuk Pemrograman Dasar
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 3,  // id_jadwal untuk Dasar-Dasar Komputer
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 5,  // id_jadwal untuk Bahasa Inggris
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 6,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 7,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 8,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 9,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '24060122130047',  // NIM Tirza
                'semester' => 1,
                'id_jadwal' => 10,  // id_jadwal untuk Pendidikan Pancasila
                'status' => 'BARU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
