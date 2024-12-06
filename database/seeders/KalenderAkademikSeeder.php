<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KalenderAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tanggal acuan
        $tanggal_mulai_kuliah = Carbon::create(2024, 8, 17, 0, 0, 0); // Tanggal mulai kuliah: 17 Agustus 2024, pukul 00:00
        
        // Periode pengisian IRS
        DB::table('kalender_akademik')->insert([
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'isiIRS',
                'nama_kegiatan' => 'Periode Pengisian IRS Mahasiswa',
                'tanggal_mulai' => $tanggal_mulai_kuliah->copy()->subWeeks(2), // Mulai 2 minggu sebelum kuliah
                'tanggal_selesai' => $tanggal_mulai_kuliah->copy()->subDays(1)->setTime(23, 59, 59), // Selesai 1 hari sebelum kuliah
                'created_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
                'updated_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'kuliah',
                'nama_kegiatan' => 'Kegiatan Perkuliahan Dimulai',
                'tanggal_mulai' => $tanggal_mulai_kuliah,
                'tanggal_selesai' => $tanggal_mulai_kuliah->copy()->addMonths(4)->setTime(23, 59, 59),
                'created_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
                'updated_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'gantiIRS',
                'nama_kegiatan' => 'Periode Penggantian IRS Mahasiswa',
                'tanggal_mulai' => $tanggal_mulai_kuliah,
                'tanggal_selesai' => $tanggal_mulai_kuliah->copy()->addWeeks(2)->setTime(23, 59, 59), // 2 minggu setelah mulai kuliah
                'created_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
                'updated_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'batalIRS',
                'nama_kegiatan' => 'Periode Pembatalan IRS Mahasiswa',
                'tanggal_mulai' => $tanggal_mulai_kuliah->copy()->addWeeks(4), // Mulai 2 minggu setelah gantiIRS selesai
                'tanggal_selesai' => $tanggal_mulai_kuliah->copy()->addWeeks(6)->setTime(23, 59, 59), // Selesai 2 minggu setelah mulai
                'created_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
                'updated_at' => $tanggal_mulai_kuliah->copy()->subWeeks(2),
            ],
        ]);
    }
}
