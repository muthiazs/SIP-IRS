<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalKuliahSeeder extends Seeder
{
    public function run()
    {
        // Data mata kuliah
        $matkul = [
            ['kode_matkul' => 'PAIK6301', 'semester' => 3],
            ['kode_matkul' => 'PAIK6302', 'semester' => 3],
            ['kode_matkul' => 'PAIK6303', 'semester' => 3],
            ['kode_matkul' => 'PAIK6304', 'semester' => 3],
            ['kode_matkul' => 'PAIK6305', 'semester' => 3],
            ['kode_matkul' => 'PAIK6306', 'semester' => 3],
            ['kode_matkul' => 'PAIK6401', 'semester' => 4],
            ['kode_matkul' => 'PAIK6402', 'semester' => 4],
            ['kode_matkul' => 'PAIK6403', 'semester' => 4],
            ['kode_matkul' => 'PAIK6404', 'semester' => 4],
            ['kode_matkul' => 'PAIK6405', 'semester' => 4],
            ['kode_matkul' => 'PAIK6406', 'semester' => 4],
            ['kode_matkul' => 'PAIK6501', 'semester' => 5],
            ['kode_matkul' => 'PAIK6502', 'semester' => 5],
            ['kode_matkul' => 'PAIK6503', 'semester' => 5],
            ['kode_matkul' => 'PAIK6504', 'semester' => 5],
            ['kode_matkul' => 'PAIK6505', 'semester' => 5],
            ['kode_matkul' => 'PAIK6506', 'semester' => 5],
            ['kode_matkul' => 'UUW00008', 'semester' => 5],
            ['kode_matkul' => 'PAIK6601', 'semester' => 6],
            ['kode_matkul' => 'PAIK6602', 'semester' => 6],
        ];

        // Data dosen
        $dosen = [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];

        // Data ruangan
        $ruangan = range(1, 23);

        // Hari perkuliahan
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        // Jam mulai dan jam selesai
        $jam_mulai = ['08:00:00', '10:00:00', '13:00:00', '15:00:00'];
        $jam_selesai = ['10:00:00', '12:00:00', '15:00:00', '17:00:00'];

        // Kelas
        $kelas = ['A', 'B', 'C'];

        // ID Periode Akademik
        $periodes = [
            ['id_periode' => '23242', 'nama_periode' => 'Semester Akademik 2023/2024 Genap', 'tahun_mulai' => '2023', 'tahun_selesai' => '2024', 'jenis' => 'genap'],
            ['id_periode' => '24251', 'nama_periode' => 'Semester Akademik 2024/2025 Ganjil', 'tahun_mulai' => '2024', 'tahun_selesai' => '2025', 'jenis' => 'ganjil']
        ];

        // Insert jadwal kuliah
        foreach ($matkul as $mat) {
            // Pilih periode berdasarkan semester
            $selectedPeriode = $mat['semester'] % 2 == 0
                ? $periodes[0] // Semester Genap (Periode 23242)
                : $periodes[1]; // Semester Ganjil (Periode 24251)

            // Randomly select jam mulai dan jam selesai sesuai dengan pola yang diinginkan
            $indexJam = array_rand($jam_mulai);

            DB::table('jadwal_kuliah')->insert([
                'kode_matkul' => $mat['kode_matkul'],
                'kuota' => 50,
                'id_dosen' => $dosen[array_rand($dosen)],
                'id_ruang' => $ruangan[array_rand($ruangan)],
                'hari' => $hari[array_rand($hari)],
                'jam_mulai' => $jam_mulai[$indexJam],
                'jam_selesai' => $jam_selesai[$indexJam],
                'kelas' => $kelas[array_rand($kelas)],
                'semester' => $mat['semester'],
                'id_periode' => $selectedPeriode['id_periode'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
