<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TambahMataKuliahSeeder extends Seeder
{
    public function run()
    {
        $matkul = [
            // Semester 1
            ['kode_matkul' => 'MKM1001', 'nama_matkul' => 'Experimental in General Chemistry 1', 'sks' => 1, 'semester' => 1],
            ['kode_matkul' => 'MKM1002', 'nama_matkul' => 'General Chemistry 1', 'sks' => 3, 'semester' => 1],
            ['kode_matkul' => 'MKM1003', 'nama_matkul' => 'Chemistry of Elements', 'sks' => 3, 'semester' => 1],
            ['kode_matkul' => 'MKM1004', 'nama_matkul' => 'Management of Chemical Information', 'sks' => 2, 'semester' => 1],

            // Semester 2
            ['kode_matkul' => 'MKM2001', 'nama_matkul' => 'Experimental in General Chemistry 2', 'sks' => 1, 'semester' => 2],
            ['kode_matkul' => 'MKM2002', 'nama_matkul' => 'Experimental in General Physics', 'sks' => 1, 'semester' => 2],
            ['kode_matkul' => 'MKM2003', 'nama_matkul' => 'General Physics 1', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'MKM2004', 'nama_matkul' => 'General Chemistry 2', 'sks' => 3, 'semester' => 2],
            ['kode_matkul' => 'MKM2005', 'nama_matkul' => 'Organic Chemistry 1', 'sks' => 2, 'semester' => 2],
            ['kode_matkul' => 'MKM2006', 'nama_matkul' => 'Inorganic Chemistry 1', 'sks' => 3, 'semester' => 2],

            // Semester 3
            ['kode_matkul' => 'MKM3001', 'nama_matkul' => 'Kimia Analitik Kuantitatif', 'sks' => 3, 'semester' => 3],
            ['kode_matkul' => 'MKM3002', 'nama_matkul' => 'Analisis Pangan', 'sks' => 2, 'semester' => 3],
            ['kode_matkul' => 'MKM3003', 'nama_matkul' => 'Struktur dan Ikatan Kimia', 'sks' => 3, 'semester' => 3],
            ['kode_matkul' => 'MKM3004', 'nama_matkul' => 'Struktur dan Fungsi Biomolekul', 'sks' => 2, 'semester' => 3],
            ['kode_matkul' => 'MKM3005', 'nama_matkul' => 'Elektro Kimia', 'sks' => 2, 'semester' => 3],
            ['kode_matkul' => 'MKM3006', 'nama_matkul' => 'Geo Kimia', 'sks' => 2, 'semester' => 3],
            ['kode_matkul' => 'MKM3007', 'nama_matkul' => 'Kimia Material Organik', 'sks' => 2, 'semester' => 3],

            // Semester 5
            ['kode_matkul' => 'MKM5001', 'nama_matkul' => 'Experimental in Biochemistry', 'sks' => 1, 'semester' => 5],
            ['kode_matkul' => 'MKM5002', 'nama_matkul' => 'Organic Analysis', 'sks' => 2, 'semester' => 5],
            ['kode_matkul' => 'MKM5003', 'nama_matkul' => 'Organic Synthesis', 'sks' => 2, 'semester' => 5],
            ['kode_matkul' => 'MKM5004', 'nama_matkul' => 'Inorganic Chemistry 4', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'MKM5005', 'nama_matkul' => 'Instrumental Analytical Chemistry 2', 'sks' => 2, 'semester' => 5],
            ['kode_matkul' => 'MKM5006', 'nama_matkul' => 'Reaction Kinetics', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'MKM5007', 'nama_matkul' => 'Chemical Thermodynamics', 'sks' => 2, 'semester' => 5],
            ['kode_matkul' => 'MKM5008', 'nama_matkul' => 'Metabolism and the Flow of Genetic Information', 'sks' => 3, 'semester' => 5],
            ['kode_matkul' => 'MKM5009', 'nama_matkul' => 'Chemometric', 'sks' => 2, 'semester' => 5],
        ];

        foreach ($matkul as $data) {
            DB::table('matakuliah')->insert([
                'kode_matkul' => $data['kode_matkul'],
                'nama_matkul' => $data['nama_matkul'],
                'sks' => $data['sks'],
                'semester' => $data['semester'] ?? null,
                'id_prodi' => 2, // Set id_prodi to 2
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}
