<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use UpdatePeriodeAkademik;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            DosenSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            MahasiswaSeeder::class,
            MatakuliahSeeder::class,
            PeriodeAkademikSeeder::class,
            RuanganSeeder::class,
            PegawaiSeeder::class,
            JadwalKuliahSeeder::class,
            IrsSeeder::class,
            ProgressMhsSeeder::class,
            KalenderAkademikSeeder::class,
            TambahJadwalSeeder::class
        ]);
    }
}
