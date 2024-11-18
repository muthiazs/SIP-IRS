<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalKuliahSeeder extends Seeder
{
    public function run()
    {
        $jadwal = [

            // Semester 1 - Kelas A
            ['kode_matkul' => 'PAIK6101', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6102', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 2, 'id_dosen' => 2],
            ['kode_matkul' => 'PAIK6103', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 3],
            ['kode_matkul' => 'PAIK6104', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 4, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6105', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 5, 'id_dosen' => 5],
            ['kode_matkul' => 'UUW00003', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 6, 'id_dosen' => 6],
            ['kode_matkul' => 'UUW00005', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:00:00', 'id_ruang' => 7, 'id_dosen' => 7],
            ['kode_matkul' => 'UUW00007', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '09:30:00', 'jam_selesai' => '11:30:00', 'id_ruang' => 8, 'id_dosen' => 8],

            // Semester 1 - Kelas B
            ['kode_matkul' => 'PAIK6101', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6102', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 2, 'id_dosen' => 2],
            ['kode_matkul' => 'PAIK6103', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 3],
            ['kode_matkul' => 'PAIK6104', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 4, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6105', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 5, 'id_dosen' => 5],
            ['kode_matkul' => 'UUW00003', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 6, 'id_dosen' => 6],
            ['kode_matkul' => 'UUW00005', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:00:00', 'id_ruang' => 7, 'id_dosen' => 7],
            ['kode_matkul' => 'UUW00007', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Kamis', 'jam_mulai' => '09:30:00', 'jam_selesai' => '11:30:00', 'id_ruang' => 8, 'id_dosen' => 8],

            // Semester 2 - Kelas A
            ['kode_matkul' => 'PAIK6201', 'semester' => 2, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6202', 'semester' => 2, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 2, 'id_dosen' => 10],
            ['kode_matkul' => 'PAIK6203', 'semester' => 2, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 11],
            ['kode_matkul' => 'PAIK6204', 'semester' => 2, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 4, 'id_dosen' => 12],
            ['kode_matkul' => 'UUW00004', 'semester' => 2, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 5, 'id_dosen' => 13],

            // Semester 2 - Kelas B
            ['kode_matkul' => 'PAIK6201', 'semester' => 2, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6202', 'semester' => 2, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 2, 'id_dosen' => 10],
            ['kode_matkul' => 'PAIK6203', 'semester' => 2, 'kelas' => 'B', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 11],
            ['kode_matkul' => 'PAIK6204', 'semester' => 2, 'kelas' => 'B', 'hari' => 'Jumat', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 4, 'id_dosen' => 12],
            ['kode_matkul' => 'UUW00004', 'semester' => 2, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 5, 'id_dosen' => 13],
            // Semester 3 (Ganjil) - Kelas A
            ['kode_matkul' => 'PAIK6301', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6302', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 1, 'id_dosen' => 2],
            ['kode_matkul' => 'PAIK6303', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 2, 'id_dosen' => 3],
            ['kode_matkul' => 'PAIK6304', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 2, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6305', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 5],
            ['kode_matkul' => 'PAIK6306', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 3, 'id_dosen' => 6],

            // Semester 3 (Ganjil) - Kelas B
            ['kode_matkul' => 'PAIK6301', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 4, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6302', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 4, 'id_dosen' => 2],
            ['kode_matkul' => 'PAIK6303', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 5, 'id_dosen' => 3],
            ['kode_matkul' => 'PAIK6304', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 5, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6305', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 6, 'id_dosen' => 5],
            ['kode_matkul' => 'PAIK6306', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 6, 'id_dosen' => 6],

            // Semester 3 (Ganjil) - Kelas C
            ['kode_matkul' => 'PAIK6301', 'semester' => 3, 'kelas' => 'C', 'hari' => 'Kamis', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 7, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6302', 'semester' => 3, 'kelas' => 'C', 'hari' => 'Kamis', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 7, 'id_dosen' => 2],
            ['kode_matkul' => 'PAIK6303', 'semester' => 3, 'kelas' => 'C', 'hari' => 'Jumat', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 8, 'id_dosen' => 3],
            ['kode_matkul' => 'PAIK6304', 'semester' => 3, 'kelas' => 'C', 'hari' => 'Jumat', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 8, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6305', 'semester' => 3, 'kelas' => 'C', 'hari' => 'Jumat', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 9, 'id_dosen' => 5],
            ['kode_matkul' => 'PAIK6306', 'semester' => 3, 'kelas' => 'C', 'hari' => 'Jumat', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 9, 'id_dosen' => 6],

            // Semester 4 (Genap) - Kelas A
            ['kode_matkul' => 'PAIK6401', 'semester' => 4, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 7],
            ['kode_matkul' => 'PAIK6402', 'semester' => 4, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 1, 'id_dosen' => 8],
            ['kode_matkul' => 'PAIK6403', 'semester' => 4, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6404', 'semester' => 4, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 1, 'id_dosen' => 10],
            ['kode_matkul' => 'PAIK6405', 'semester' => 4, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 11],
            ['kode_matkul' => 'PAIK6406', 'semester' => 4, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 1, 'id_dosen' => 12],

            // Semester 4 (Genap) - Kelas B (Menggunakan ruangan yang sama karena semester genap)
            ['kode_matkul' => 'PAIK6401', 'semester' => 4, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 1, 'id_dosen' => 7],
            ['kode_matkul' => 'PAIK6402', 'semester' => 4, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 1, 'id_dosen' => 8],
            ['kode_matkul' => 'PAIK6403', 'semester' => 4, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 1, 'id_dosen' => 9],
            ['kode_matkul' => 'PAIK6404', 'semester' => 4, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 1, 'id_dosen' => 10],
            ['kode_matkul' => 'PAIK6405', 'semester' => 4, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 1, 'id_dosen' => 11],
            ['kode_matkul' => 'PAIK6406', 'semester' => 4, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 1, 'id_dosen' => 12],

            // Semester 5 (Ganjil) - Kelas A
            ['kode_matkul' => 'PAIK6501', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 10, 'id_dosen' => 13],
            ['kode_matkul' => 'PAIK6502', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 10, 'id_dosen' => 14],
            ['kode_matkul' => 'PAIK6503', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Jumat', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 11, 'id_dosen' => 15],
            ['kode_matkul' => 'PAIK6504', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Jumat', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 11, 'id_dosen' => 16],
            ['kode_matkul' => 'PAIK6505', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 12, 'id_dosen' => 17],
            ['kode_matkul' => 'PAIK6506', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 12, 'id_dosen' => 8],
            ['kode_matkul' => 'UUW00008', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:00:00', 'id_ruang' => 17, 'id_dosen' => 1],

            // Semester 5 (Ganjil) - Kelas B
            ['kode_matkul' => 'PAIK6501', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 14, 'id_dosen' => 13],
            ['kode_matkul' => 'PAIK6502', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 14, 'id_dosen' => 14],
            ['kode_matkul' => 'PAIK6503', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 15, 'id_dosen' => 15],
            ['kode_matkul' => 'PAIK6504', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 15, 'id_dosen' => 16],
            ['kode_matkul' => 'PAIK6505', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 16, 'id_dosen' => 17],
            ['kode_matkul' => 'PAIK6506', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 16, 'id_dosen' => 8],
            ['kode_matkul' => 'UUW00008', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:00:00', 'id_ruang' => 17, 'id_dosen' => 1],

            // Semester 5 (Ganjil) - Kelas C
            ['kode_matkul' => 'PAIK6501', 'semester' => 5, 'kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 18, 'id_dosen' => 13],
            ['kode_matkul' => 'PAIK6502', 'semester' => 5, 'kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 18, 'id_dosen' => 14],
            ['kode_matkul' => 'PAIK6503', 'semester' => 5, 'kelas' => 'C', 'hari' => 'Kamis', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 19, 'id_dosen' => 15],
            ['kode_matkul' => 'PAIK6504', 'semester' => 5, 'kelas' => 'C', 'hari' => 'Kamis', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 19, 'id_dosen' => 16],
            ['kode_matkul' => 'PAIK6505', 'semester' => 5, 'kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:30:00', 'id_ruang' => 20, 'id_dosen' => 17],
            ['kode_matkul' => 'PAIK6506', 'semester' => 5, 'kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '15:45:00', 'jam_selesai' => '17:45:00', 'id_ruang' => 20, 'id_dosen' => 8],
            ['kode_matkul' => 'UUW00008', 'semester' => 5, 'kelas' => 'C', 'hari' => 'Kamis', 'jam_mulai' => '13:00:00', 'jam_selesai' => '15:00:00', 'id_ruang' => 21, 'id_dosen' => 1],

            // Semester 6 (Genap) - Kelas A
            ['kode_matkul' => 'PAIK6601', 'semester' => 6, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6602', 'semester' => 6, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 1, 'id_dosen' => 2],

            // Semester 6 (Genap) - Kelas B
            ['kode_matkul' => 'PAIK6601', 'semester' => 6, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6602', 'semester' => 6, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 1, 'id_dosen' => 2],
            // Semester 6 (Genap) - Kelas C
            ['kode_matkul' => 'PAIK6601', 'semester' => 6, 'kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '07:30:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 1],
            ['kode_matkul' => 'PAIK6602', 'semester' => 6, 'kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '10:30:00', 'jam_selesai' => '12:30:00', 'id_ruang' => 1, 'id_dosen' => 2],
        ];
          // Tambahkan id_periode dan timestamps ke setiap record
          foreach ($jadwal as $data) {
            $id_periode = $this->getPeriodeBySemester($data['semester']);
        

            DB::table('jadwal_kuliah')->insert([
                'kode_matkul' => $data['kode_matkul'],
                'semester' => $data['semester'],
                'kelas' => $data['kelas'],
                'hari' => $data['hari'],
                'kuota' => 50, // Tambahkan kuota di sini
                'jam_mulai' => $data['jam_mulai'],
                'jam_selesai' => $data['jam_selesai'],
                'id_ruang' => $data['id_ruang'],
                'id_dosen' => $data['id_dosen'],
                'id_periode' => $id_periode,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    // Fungsi helper untuk memilih id_periode berdasarkan semester
    private function getPeriodeBySemester($semester)
    {
        // Cek semester ganjil (1, 3, 5, dst) atau genap (2, 4, 6, dst)
        if ($semester % 2 === 1) {
            // Semester ganjil
            return '24251'; // ID periode untuk ganjil
        } else {
            // Semester genap
            return '23242'; // ID periode untuk genap
        }
    }

}

