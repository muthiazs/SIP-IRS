<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




class KalenderAkademikSeeder extends Seeder
{
    public function run(): void
    {
        $currentDate = Carbon::now();
        $endDate = $currentDate->copy()->addWeeks(3); // Menambahkan 3 minggu ke depan

        // Menambahkan data sesuai dengan gambar yang diunggah
        DB::table('kalender_akademik')->insert([
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'isiIRS',
                'nama_kegiatan' => 'Periode Pengisian IRS Mahasiswa',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'setujuiIRS',
                'nama_kegiatan' => 'Periode Penyetujuan IRS oleh Dosen',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'aturRuang',
                'nama_kegiatan' => 'Periode Atur Ruang Kuliah',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'aturJadwal',
                'nama_kegiatan' => 'Periode Atur Jadwal Perkuliahan',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'setujuRuanganJadwal',
                'nama_kegiatan' => 'Periode Setujui Ruang dan Jadwal Kuliah',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'kuliah',
                'nama_kegiatan' => 'Kegiatan Perkuliahan Dimulai',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'gantiIRS',
                'nama_kegiatan' => 'Periode Penggantian IRS Mahasiswa',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'batalIRS',
                'nama_kegiatan' => 'Periode Pembatalan IRS Mahasiswa',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $endDate->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}