<?php
// database/seeders/DosenSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $dosens = [
            [
                'id_dosen' => 2,
                'id_user' => 2, // id_user mulai dari angka 9
                'nip' => '197108111997021004',
                'nama' => 'Dr. Aris Sugiharto, S.Si., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 5,
                'id_user' => 9, // id_user mulai dari angka 9
                'nip' => '197308291998022001',
                'nama' => 'Beta Noranita, S.Si., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 6,
                'id_user' => 10,
                'nip' => '197404011999031002',
                'nama' => 'Dr. Aris Puji Widodo, S.Si., M.T.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 7,
                'id_user' => 11,
                'nip' => '197902122008121002',
                'nama' => 'Dr. Indra Waspada, S.T., M.T.I',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 8,
                'id_user' => 12,
                'nip' => '198104202005012001',
                'nama' => 'Dr. Retno Kusumaningrum, S.Si., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 9,
                'id_user' => 13,
                'nip' => '198511252018032001',
                'nama' => 'Rismiyati, B.Eng, M.Cs',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 10,
                'id_user' => 14,
                'nip' => 'H.7.199603032022041001',
                'nama' => 'Sandy Kurniawan, S.Kom., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 11,
                'id_user' => 15,
                'nip' => 'H.7.198806142022102001',
                'nama' => 'Yunila Dwi Putri Ariyanti, S.Kom., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 12,
                'id_user' => 16,
                'nip' => 'H.7.199204252023072001',
                'nama' => 'Dr. Yeva Fadhilah Ashari, S.Si., M.Si.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 13,
                'id_user' => 17,
                'nip' => 'H.7.199602212023072001',
                'nama' => 'Etna Vianita, S.Mat., M.Mat.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 14,
                'id_user' => 18,
                'nip' => '196005101989032001',
                'nama' => 'Prof. Dr. Dra. Meiny Suzery, M.S.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 15,
                'id_user' => 19,
                'nip' => '197309161997021001',
                'nama' => 'Dr.rer.nat. Anto Budiharjo, S.Si., M.Biotech.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 16,
                'id_user' => 20,
                'nip' => '196902141994032002',
                'nama' => 'Prof. Dr. Widowati, S.Si., M.Si.',
                'prodi_id' => '4',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 17,
                'id_user' => 21,
                'nip' => '199307302018031001',
                'nama' => 'Arief Rachman Hakim, S.SI., M.Si.',
                'prodi_id' => '4',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 20, // plss ternyata ak error krn gk ad dosen yg id ny 20 ini dummy dulu aja adjkshfhjk
                'id_user' => 22,
                'nip' => '200405242406012214',
                'nama' => 'Dewi Suwako Moriya',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
        ];
    
        DB::table('dosen')->insert($dosens);
    }

}

    


