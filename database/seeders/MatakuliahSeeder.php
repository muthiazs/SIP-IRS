<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    public function run()
    {
        $matkul = [
            // Semester 1
            ['kode_matkul' => 'PAIK6101', 'nama_matkul' => 'Matematika I', 'sks' => 2, 'semester' => 1],
            ['kode_matkul' => 'PAIK6102', 'nama_matkul' => 'Dasar Pemrograman', 'sks' => 3, 'semester' => 1],
            ['kode_matkul' => 'PAIK6103', 'nama_matkul' => 'Dasar Sistem', 'sks' => 3, 'semester' => 1],
            ['kode_matkul' => 'PAIK6104', 'nama_matkul' => 'Logika Informatika', 'sks' => 3, 'semester' => 1],
            ['kode_matkul' => 'PAIK6105', 'nama_matkul' => 'Struktur Diskrit', 'sks' => 4, 'semester' => 1],
            ['kode_matkul' => 'UUW00003', 'nama_matkul' => 'Pancasila dan Kewarganegaraan', 'sks' => 3, 'semester' => 1],
            ['kode_matkul' => 'UUW00005', 'nama_matkul' => 'Olahraga', 'sks' => 1, 'semester' => 1],
            ['kode_matkul' => 'UUW00007', 'nama_matkul' => 'Bahasa Inggris', 'sks' => 2, 'semester' => 1],

            // Semester 2
            ['kode_matkul' => 'PAIK6201', 'nama_matkul' => 'Matematika II', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'PAIK6202', 'nama_matkul' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 2],
            ['kode_matkul' => 'PAIK6203', 'nama_matkul' => 'Organisasi dan Arsitektur Komputer', 'sks' => 3, 'semester' => 2],
            ['kode_matkul' => 'PAIK6204', 'nama_matkul' => 'Aljabar Linier', 'sks' => 3, 'semester' => 2],
            ['kode_matkul' => 'UUW00004', 'nama_matkul' => 'Bahasa Indonesia', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00006', 'nama_matkul' => 'Internet of Things IoT', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00011', 'nama_matkul' => 'Pendidikan Agama Islam', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00021', 'nama_matkul' => 'Pendidikan Agama Kristen', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00031', 'nama_matkul' => 'Pendidikan Agama Khatolik', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00041', 'nama_matkul' => 'Pendidikan Agama Hindu', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00051', 'nama_matkul' => 'Pendidikan Agama Buddha', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00061', 'nama_matkul' => 'Pendidikan Agama Kong Hu Chu', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'UUW00071', 'nama_matkul' => 'Aliran Kepercayaan terhadap Tuhan Yang Maha Esa', 'sks' => 2, 'semester' => 2],
            // Semester 3
            ['kode_matkul' => 'PAIK6301', 'nama_matkul' => 'Struktur Data', 'sks' => 4, 'semester' => 3],
            ['kode_matkul' => 'PAIK6302', 'nama_matkul' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3],
            ['kode_matkul' => 'PAIK6303', 'nama_matkul' => 'Basis Data', 'sks' => 4, 'semester' => 3],
            ['kode_matkul' => 'PAIK6304', 'nama_matkul' => 'Metode Numerik', 'sks' => 3, 'semester' => 3],
            ['kode_matkul' => 'PAIK6305', 'nama_matkul' => 'Interaksi Manusia dan Komputer', 'sks' => 3, 'semester' => 3],
            ['kode_matkul' => 'PAIK6306', 'nama_matkul' => 'Statistika', 'sks' => 2, 'semester' => 3],

            // Semester 4
            ['kode_matkul' => 'PAIK6401', 'nama_matkul' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 4],
            ['kode_matkul' => 'PAIK6402', 'nama_matkul' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4],
            ['kode_matkul' => 'PAIK6403', 'nama_matkul' => 'Manajemen Basis Data', 'sks' => 3, 'semester' => 4],
            ['kode_matkul' => 'PAIK6404', 'nama_matkul' => 'Grafika dan Komputasi Visual', 'sks' => 3, 'semester' => 4],
            ['kode_matkul' => 'PAIK6405', 'nama_matkul' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 4],
            ['kode_matkul' => 'PAIK6406', 'nama_matkul' => 'Sistem Cerdas', 'sks' => 3, 'semester' => 4],

            // Semester 5
            ['kode_matkul' => 'PAIK6501', 'nama_matkul' => 'Pengembangan Berbasis Platform', 'sks' => 4, 'semester' => 5],
            ['kode_matkul' => 'PAIK6502', 'nama_matkul' => 'Komputasi Tersebar dan Pararel', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'PAIK6503', 'nama_matkul' => 'Sistem Informasi', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'PAIK6504', 'nama_matkul' => 'Proyek Perangkat Lunak', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'PAIK6505', 'nama_matkul' => 'Pembelajaran Mesin', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'PAIK6506', 'nama_matkul' => 'Keamanan dan Jaminan Informasi', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'UUW00008', 'nama_matkul' => 'Kewirausahaan', 'sks' => 2, 'semester' => 5],
        ];

        foreach ($matkul as $data) {
            DB::table('matakuliah')->insert([
                'kode_matkul' => $data['kode_matkul'],
                'nama_matkul' => $data['nama_matkul'],
                'sks' => $data['sks'],
                'semester' => $data['semester'] ?? null,
                'id_prodi' => 1, // Default id_prodi value
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}
