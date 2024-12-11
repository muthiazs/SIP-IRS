<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TambahJadwalMataKuliahSeeder extends Seeder
{
    public function run()
    {
        $jadwal = [
            // Semester 1 - Kelas A dan B
            ['kode_matkul' => 'MKM1001', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM1001', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 2, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM1001', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 2, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM1002', 'semester' => 1, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM1002', 'semester' => 1, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 4, 'id_dosen' => 25],

            // Semester 2 - Kelas A dan B
            ['kode_matkul' => 'MKM2001', 'semester' => 2, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 5, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM2001', 'semester' => 2, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 6, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM2002', 'semester' => 2, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 7, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM2002', 'semester' => 2, 'kelas' => 'B', 'hari' => 'Kamis', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 8, 'id_dosen' => 25],

            // Semester 3 - Kelas A dan B
            ['kode_matkul' => 'MKM3001', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 1, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM3001', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 2, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM3002', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM3002', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 4, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM3003', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 5, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM3003', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 6, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM3004', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 7, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM3004', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Kamis', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 8, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM3005', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Jumat', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 9, 'id_dosen' => 14],
            ['kode_matkul' => 'MKM3005', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Jumat', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 10, 'id_dosen' => 14],

            ['kode_matkul' => 'MKM3006', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 11, 'id_dosen' => 14],
            ['kode_matkul' => 'MKM3006', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 12, 'id_dosen' => 14],

            ['kode_matkul' => 'MKM3007', 'semester' => 3, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 13, 'id_dosen' => 14],
            ['kode_matkul' => 'MKM3007', 'semester' => 3, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 14, 'id_dosen' => 14],


            // Semester 5
            ['kode_matkul' => 'MKM5001', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 11, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM5001', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 12, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM5002', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 13, 'id_dosen' => 14],
            ['kode_matkul' => 'MKM5002', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 14, 'id_dosen' => 14],

            ['kode_matkul' => 'MKM5003', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 15, 'id_dosen' => 1],
            ['kode_matkul' => 'MKM5003', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 16, 'id_dosen' => 1],

            ['kode_matkul' => 'MKM5004', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 17, 'id_dosen' => 15],
            ['kode_matkul' => 'MKM5004', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Kamis', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 18, 'id_dosen' => 15],

            ['kode_matkul' => 'MKM5005', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Jumat', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 19, 'id_dosen' => 17],
            ['kode_matkul' => 'MKM5005', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Jumat', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 20, 'id_dosen' => 17],

            ['kode_matkul' => 'MKM5006', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 21, 'id_dosen' => 16],
            ['kode_matkul' => 'MKM5006', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Senin', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 22, 'id_dosen' => 16],

            ['kode_matkul' => 'MKM5007', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Selasa', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 23, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM5007', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' =>23, 'id_dosen' => 25],

            ['kode_matkul' => 'MKM5008', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 2, 'id_dosen' => 14],
            ['kode_matkul' => 'MKM5008', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Rabu', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 2, 'id_dosen' => 14],

            ['kode_matkul' => 'MKM5009', 'semester' => 5, 'kelas' => 'A', 'hari' => 'Kamis', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'id_ruang' => 3, 'id_dosen' => 25],
            ['kode_matkul' => 'MKM5009', 'semester' => 5, 'kelas' => 'B', 'hari' => 'Kamis', 'jam_mulai' => '10:00:00', 'jam_selesai' => '12:00:00', 'id_ruang' => 3, 'id_dosen' => 25],
        ];

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

