<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RuanganSeeder extends Seeder
{
    public function run()
    {
        $ruangan = [
            ['id_ruang' => 1, 'nama' => 'a101', 'kapasitas' => 50],
            ['id_ruang' => 2, 'nama' => 'a102', 'kapasitas' => 50],
            ['id_ruang' => 3, 'nama' => 'a103', 'kapasitas' => 50],
            ['id_ruang' => 4, 'nama' => 'a104', 'kapasitas' => 50],
            ['id_ruang' => 5, 'nama' => 'a105', 'kapasitas' => 50],
            ['id_ruang' => 6, 'nama' => 'b102', 'kapasitas' => 50],
            ['id_ruang' => 7, 'nama' => 'b103', 'kapasitas' => 50],
            ['id_ruang' => 8, 'nama' => 'e102', 'kapasitas' => 50],
            ['id_ruang' => 9, 'nama' => 'e103', 'kapasitas' => 50],
            ['id_ruang' => 10, 'nama' => 'a201', 'kapasitas' => 50],
            ['id_ruang' => 11, 'nama' => 'a202', 'kapasitas' => 50],
            ['id_ruang' => 12, 'nama' => 'a203', 'kapasitas' => 50],
            ['id_ruang' => 13, 'nama' => 'a204', 'kapasitas' => 50],
            ['id_ruang' => 14, 'nama' => 'a205', 'kapasitas' => 50],
            ['id_ruang' => 15, 'nama' => 'a301', 'kapasitas' => 50],
            ['id_ruang' => 16, 'nama' => 'a302', 'kapasitas' => 50],
            ['id_ruang' => 17, 'nama' => 'a303', 'kapasitas' => 50],
            ['id_ruang' => 18, 'nama' => 'a304', 'kapasitas' => 50],
            ['id_ruang' => 19, 'nama' => 'a305', 'kapasitas' => 50],
            ['id_ruang' => 20, 'nama' => 'b202', 'kapasitas' => 50],
            ['id_ruang' => 21, 'nama' => 'b203', 'kapasitas' => 50],
            ['id_ruang' => 22, 'nama' => 'b302', 'kapasitas' => 50],
            ['id_ruang' => 23, 'nama' => 'b303', 'kapasitas' => 50],
        ];

        foreach ($ruangan as $data) {
            DB::table('ruangan')->insert([
                'id_ruang' => $data['id_ruang'],
                'nama' => $data['nama'],
                'kapasitas' => $data['kapasitas'],
                'status' => 'tersedia',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
        }
    }
}

