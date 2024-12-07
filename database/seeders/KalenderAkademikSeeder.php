<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KalenderAkademikSeeder extends Seeder
{
    public function run(): void
    {
        $currentDate = '2024-12-07'; // Tanggal mulai manual (7 Desember 2024)
        $threeWeeksLater = '2024-12-28'; // 3 minggu setelah tanggal mulai
        $sixWeeksLater = '2025-01-18'; // 6 minggu setelah tanggal mulai
        $sixMonthsLater = '2025-06-07'; // 6 bulan setelah tanggal mulai

        // Menambahkan data sesuai dengan peraturan yang baru
        DB::table('kalender_akademik')->insert([
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'isiIRS',
                'nama_kegiatan' => 'Periode Pengisian IRS Mahasiswa',
                'tanggal_mulai' => $currentDate, // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater, // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'setujuiIRS',
                'nama_kegiatan' => 'Periode Penyetujuan IRS oleh Dosen',
                'tanggal_mulai' => $currentDate, // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater, // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'aturRuang',
                'nama_kegiatan' => 'Periode Atur Ruang Kuliah',
                'tanggal_mulai' => $currentDate, // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater, // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'aturJadwal',
                'nama_kegiatan' => 'Periode Atur Jadwal Perkuliahan',
                'tanggal_mulai' => $currentDate, // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater, // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'setujuRuanganJadwal',
                'nama_kegiatan' => 'Periode Setujui Ruang dan Jadwal Kuliah',
                'tanggal_mulai' => $currentDate, // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater, // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'kuliah',
                'nama_kegiatan' => 'Kegiatan Perkuliahan Dimulai',
                'tanggal_mulai' => $sixWeeksLater, // 6 minggu dari sekarang
                'tanggal_selesai' => $sixMonthsLater, // 6 bulan dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'gantiIRS',
                'nama_kegiatan' => 'Periode Penggantian IRS Mahasiswa',
                'tanggal_mulai' => $threeWeeksLater, // 3 minggu setelah isiIRS selesai
                'tanggal_selesai' => $sixWeeksLater, // 6 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'batalIRS',
                'nama_kegiatan' => 'Periode Pembatalan IRS Mahasiswa',
                'tanggal_mulai' => $sixWeeksLater, // 6 minggu setelah gantiIRS selesai
                'tanggal_selesai' => '2025-02-08', // 3 minggu setelah batalIRS mulai
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
