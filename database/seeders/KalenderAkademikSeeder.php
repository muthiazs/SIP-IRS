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
       // Ambil tanggal saat ini
       $currentDate = Carbon::now();
        
       // Periode pengisian IRS
       DB::table('kalender_akademik')->insert([
           [
               'id_periode' => '24251',
               'kode_kegiatan' => 'isiIRS',
               'nama_kegiatan' => 'Periode Pengisian IRS Mahasiswa',
               'tanggal_mulai' => $currentDate->toDateTimeString(), // Tanggal mulai: saat ini
               'tanggal_selesai' => $currentDate->copy()->addWeeks(2)->setTime(23, 59, 59)->toDateTimeString(), // 2 minggu dari sekarang
               'created_at' => $currentDate,
               'updated_at' => $currentDate,
           ],
           [
               'id_periode' => '24251',
               'kode_kegiatan' => 'kuliah',
               'nama_kegiatan' => 'Kegiatan Perkuliahan Dimulai',
               'tanggal_mulai' => $currentDate->copy()->addWeeks(2)->toDateTimeString(), // 2 minggu dari sekarang
               'tanggal_selesai' => $currentDate->copy()->addWeeks(2)->addMonths(4)->setTime(23, 59, 59)->toDateTimeString(),
               'created_at' => $currentDate,
               'updated_at' => $currentDate,
           ],
           [
               'id_periode' => '24251',
               'kode_kegiatan' => 'gantiIRS',
               'nama_kegiatan' => 'Periode Penggantian IRS Mahasiswa',
               'tanggal_mulai' => $currentDate->copy()->addWeeks(2)->toDateTimeString(), // 2 minggu dari sekarang
               'tanggal_selesai' => $currentDate->copy()->addWeeks(4)->setTime(23, 59, 59)->toDateTimeString(), // 2 minggu setelah mulai kuliah
               'created_at' => $currentDate,
               'updated_at' => $currentDate,
           ],
           [
               'id_periode' => '24251',
               'kode_kegiatan' => 'batalIRS',
               'nama_kegiatan' => 'Periode Pembatalan IRS Mahasiswa',
               'tanggal_mulai' => $currentDate->copy()->addWeeks(6)->toDateTimeString(), // Mulai 2 minggu setelah gantiIRS selesai
               'tanggal_selesai' => $currentDate->copy()->addWeeks(8)->setTime(23, 59, 59)->toDateTimeString(),
               'created_at' => $currentDate,
               'updated_at' => $currentDate,
           ],
       ]);
    }
}
