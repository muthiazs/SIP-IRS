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
                'id_dosen' => 4,
                'nip' => '198203092006041002',
                'nama' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 5,
                'nip' => '197308291998022001',
                'nama' => 'Beta Noranita, S.Si., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 6,
                'nip' => '197404011999031002',
                'nama' => 'Dr. Aris Puji Widodo, S.Si., M.T.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 7,
                'nip' => '197902122008121002',
                'nama' => 'Dr. Indra Waspada, S.T., M.T.I',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 8,
                'nip' => '198104202005012001',
                'nama' => 'Dr. Retno Kusumaningrum, S.Si., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 9,
                'nip' => '198511252018032001',
                'nama' => 'Rismiyati, B.Eng, M.Cs',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 10,
                'nip' => 'H.7.199603032022041001',
                'nama' => 'Sandy Kurniawan, S.Kom., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 11,
                'nip' => 'H.7.198806142022102001',
                'nama' => 'Yunila Dwi Putri Ariyanti, S.Kom., M.Kom.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 12,
                'nip' => 'H.7.199204252023072001',
                'nama' => 'Dr. Yeva Fadhilah Ashari, S.Si., M.Si.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 13,
                'nip' => 'H.7.199602212023072001',
                'nama' => 'Etna Vianita, S.Mat., M.Mat.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 14,
                'nip' => '196005101989032001',
                'nama' => 'Prof. Dr. Dra. Meiny Suzery, M.S.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 15,
                'nip' => '197309161997021001',
                'nama' => 'Dr.rer.nat. Anto Budiharjo, S.Si., M.Biotech.',
                'prodi_id' => '1',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 16,
                'nip' => '196902141994032002',
                'nama' => 'Prof. Dr. Widowati, S.Si., M.Si.',
                'prodi_id' => '4',
                'created_at' => now(),
            ],
            [
                'id_dosen' => 17,
                'nip' => '199307302018031001',
                'nama' => 'Arief Rachman Hakim, S.SI., M.Si.',
                'prodi_id' => '4',
                'created_at' => now(),
            ],
        ];

        DB::table('dosen')->insert($dosens);
    }
}
