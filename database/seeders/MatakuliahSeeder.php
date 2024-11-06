<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    public function run()
    {
        $matkul = [
            ['id_matkul' => 22, 'kode_matkul' => 'PAIK6301', 'nama_matkul' => 'Struktur Data', 'sks' => 4, 'semester' => 3],
            ['id_matkul' => 23, 'kode_matkul' => 'PAIK6302', 'nama_matkul' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3],
            ['id_matkul' => 24, 'kode_matkul' => 'PAIK6303', 'nama_matkul' => 'Basis Data', 'sks' => 4, 'semester' => 3],
            ['id_matkul' => 25, 'kode_matkul' => 'PAIK6304', 'nama_matkul' => 'Metode Numerik', 'sks' => 3, 'semester' => 3],
            ['id_matkul' => 26, 'kode_matkul' => 'PAIK6305', 'nama_matkul' => 'Interaksi Manusia dan Komputer', 'sks' => 3, 'semester' => 3],
            ['id_matkul' => 27, 'kode_matkul' => 'PAIK6306', 'nama_matkul' => 'Statistika', 'sks' => 2, 'semester' => 3],
            ['id_matkul' => 28, 'kode_matkul' => 'PAIK6401', 'nama_matkul' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 4],
            ['id_matkul' => 29, 'kode_matkul' => 'PAIK6402', 'nama_matkul' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4],
            ['id_matkul' => 30, 'kode_matkul' => 'PAIK6403', 'nama_matkul' => 'Manajemen Basis Data', 'sks' => 3, 'semester' => 4],
            ['id_matkul' => 31, 'kode_matkul' => 'PAIK6404', 'nama_matkul' => 'Grafika dan Komputasi Visual', 'sks' => 3, 'semester' => 4],
            ['id_matkul' => 32, 'kode_matkul' => 'PAIK6405', 'nama_matkul' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 4],
            ['id_matkul' => 33, 'kode_matkul' => 'PAIK6406', 'nama_matkul' => 'Sistem Cerdas', 'sks' => 3, 'semester' => 4],
            ['id_matkul' => 34, 'kode_matkul' => 'PAIK6501', 'nama_matkul' => 'Pengembangan Berbasis Platform', 'sks' => 4, 'semester' => 5],
            ['id_matkul' => 35, 'kode_matkul' => 'PAIK6502', 'nama_matkul' => 'Komputasi Tersebar dan Pararel', 'sks' => 3, 'semester' => 5],
            ['id_matkul' => 36, 'kode_matkul' => 'PAIK6503', 'nama_matkul' => 'Sistem Informasi', 'sks' => 3, 'semester' => 5],
            ['id_matkul' => 37, 'kode_matkul' => 'PAIK6504', 'nama_matkul' => 'Proyek Perangkat Lunak', 'sks' => 3, 'semester' => 5],
            ['id_matkul' => 38, 'kode_matkul' => 'PAIK6505', 'nama_matkul' => 'Pembelajaran Mesin', 'sks' => 3, 'semester' => 5],
            ['id_matkul' => 39, 'kode_matkul' => 'PAIK6506', 'nama_matkul' => 'Keamanan dan Jaminan Informasi', 'sks' => 3, 'semester' => 5],
            ['id_matkul' => 40, 'kode_matkul' => 'UUW00008', 'nama_matkul' => 'Kewirausahaan', 'sks' => 2, 'semester' => 5],
            ['id_matkul' => 41, 'kode_matkul' => 'PAIK6601', 'nama_matkul' => 'Analisis dan Strategi Algoritma', 'sks' => 3, 'semester' => 6],
            ['id_matkul' => 42, 'kode_matkul' => 'PAIK6602', 'nama_matkul' => 'Uji Perangkat Lunak', 'sks' => 3, 'semester' => 6],
        ];

        foreach ($matkul as $data) {
            DB::table('matakuliah')->insert([
                'id_matkul' => $data['id_matkul'],
                'kode_matkul' => $data['kode_matkul'],
                'nama_matkul' => $data['nama_matkul'],
                'sks' => $data['sks'],
                'semester' => $data['semester'],
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}
