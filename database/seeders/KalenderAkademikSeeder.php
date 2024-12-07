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
        $threeWeeksLater = $currentDate->copy()->addWeeks(3); // 3 weeks from now
        $sixWeeksLater = $currentDate->copy()->addWeeks(6); // 6 weeks from now
        $sixMonthsLater = $currentDate->copy()->addMonths(6); // 6 months from now

        // Menambahkan data sesuai dengan peraturan yang baru
        DB::table('kalender_akademik')->insert([
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'isiIRS',
                'nama_kegiatan' => 'Periode Pengisian IRS Mahasiswa',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'setujuiIRS',
                'nama_kegiatan' => 'Periode Penyetujuan IRS oleh Dosen',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'aturRuang',
                'nama_kegiatan' => 'Periode Atur Ruang Kuliah',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'aturJadwal',
                'nama_kegiatan' => 'Periode Atur Jadwal Perkuliahan',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'setujuRuanganJadwal',
                'nama_kegiatan' => 'Periode Setujui Ruang dan Jadwal Kuliah',
                'tanggal_mulai' => $currentDate->toDateTimeString(), // Mulai sekarang
                'tanggal_selesai' => $threeWeeksLater->toDateTimeString(), // 3 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'kuliah',
                'nama_kegiatan' => 'Kegiatan Perkuliahan Dimulai',
                'tanggal_mulai' => $sixWeeksLater->toDateTimeString(), // 6 minggu dari sekarang
                'tanggal_selesai' => $sixMonthsLater->toDateTimeString(), // 6 bulan dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'gantiIRS',
                'nama_kegiatan' => 'Periode Penggantian IRS Mahasiswa',
                'tanggal_mulai' => $threeWeeksLater->toDateTimeString(), // 3 minggu dari sekarang (setelah isiIRS selesai)
                'tanggal_selesai' => $sixWeeksLater->toDateTimeString(), // 6 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'id_periode' => '24251',
                'kode_kegiatan' => 'batalIRS',
                'nama_kegiatan' => 'Periode Pembatalan IRS Mahasiswa',
                'tanggal_mulai' => $sixWeeksLater->toDateTimeString(), // 6 minggu dari sekarang (setelah gantiIRS selesai)
                'tanggal_selesai' => $sixWeeksLater->copy()->addWeeks(3)->toDateTimeString(), // 9 minggu dari sekarang
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
