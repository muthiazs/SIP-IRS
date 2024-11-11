<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan DB di-import

class Mhs_PengisianIRSController extends Controller
{
    public function indexRencanaStudi()
    {
        // $data = [
        //     'mahasiswa' => [
        //         'name' => 'Draco Lucius Malfoy',
        //         'nim' => '24060122130071',
        //         'program_studi' => 'S1 Informatika'
        //     ],
        //     'user' => [
        //         'name' => 'Bill Gates',
        //         'nip' => '198203092006041002'
        //     ],
        //     'semester' => [
        //         'current' => '2024/2025 Ganjil',
        //         'period' => '1 Mar - 2 April'
        //     ],
        //     'stats' => [
        //         'semester' => 5,
        //         'ipk' => '3.6/4.0',
        //         'sksk' => 86
        //     ],
        //     'status' => [
        //         'irs' => 'ditolak',
        //         'registrasi' => true
        //     ],
        //     'pengisianirs' => [
        //         'maxbeban' => 24,
        //         'total' => 0
        //     ]
        // ];

        // Fetch mahasiswa data
        $mahasiswa = DB::table('mahasiswa')
                        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                        ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                        ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
                        ->where('mahasiswa.id_user', auth()->id())
                        ->select(
                            'mahasiswa.nim',
                            'mahasiswa.nama as nama_mhs',
                            'program_studi.nama as prodi_nama',
                            'dosen.nama as nama_doswal',
                            'dosen.nip',
                            'users.username'
        ) 
        ->first();
        
        
        return view('mhs_rencanaStudi', compact('data'));  // Gunakan dot notation
    }

    public function indexPilihJadwal()
    {
        $data = [
            'mahasiswa' => [
                'name' => 'Draco Lucius Malfoy',
                'nim' => '24060122130071',
                'program_studi' => 'S1 Informatika'
            ],
            'user' => [
                'name' => 'Bill Gates',
                'nip' => '198203092006041002'
            ],
            'semester' => [
                'current' => '2024/2025 Ganjil',
                'period' => '1 Mar - 2 April'
            ],
            'stats' => [
                'semester' => 5,
                'ipk' => '3.6/4.0',
                'sksk' => 86
            ],
            'status' => [
                'irs' => 'ditolak',
                'registrasi' => true
            ],
            'pengisianirs' => [
                'maxbeban' => 24,
                'total' => 0
            ]
        ];
        // Fetch mahasiswa data
        $mahasiswa = DB::table('mahasiswa')
                        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                        ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                        ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
                        ->where('mahasiswa.id_user', auth()->id())
                        ->select(
                            'mahasiswa.nim',
                            'mahasiswa.nama as nama_mhs',
                            'program_studi.nama as prodi_nama',
                            'dosen.nama as nama_doswal',
                            'dosen.nip',
                            'users.username'
        ) 
        ->first();
        
        return view('mhs_pengisianIRS', compact('data'));  // Gunakan dot notation
    }

    public function indexPengisianIRS()
    {
        $data = [
            'mahasiswa' => [
                'name' => 'Draco Lucius Malfoy',
                'nim' => '24060122130071',
                'program_studi' => 'S1 Informatika'
            ],
            'user' => [
                'name' => 'Bill Gates',
                'nip' => '198203092006041002'
            ],
            'semester' => [
                'current' => '2024/2025 Ganjil',
                'period' => '1 Mar - 2 April'
            ],
            'stats' => [
                'semester' => 5,
                'ipk' => '3.6/4.0',
                'sksk' => 86
            ],
            'status' => [
                'irs' => 'ditolak',
                'registrasi' => true
            ],
            'pengisianirs' => [
                'maxbeban' => 24,
                'total' => 0
            ]
        ];
        
        return view('mhs_pengisianIRS', compact('data'));  // Gunakan dot notation
    }


    public function indexDaftarMatkul()
    {
        // Fetch daftar matkul (list of courses)
        $daftarMk = DB::table('matakuliah')
            ->select('kode_matkul', 'nama_matkul', 'semester', 'sks')
            ->get();
        
        // Fetch mahasiswa data
        $mahasiswa = DB::table('mahasiswa')
                        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                        ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                        ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
                        ->where('mahasiswa.id_user', auth()->id())
                        ->select(
                            'mahasiswa.nim',
                            'mahasiswa.nama as nama_mhs',
                            'program_studi.nama as prodi_nama',
                            'dosen.nama as nama_doswal',
                            'dosen.nip',
                            'users.username'
        ) 
        ->first();
        
            // Pass both daftarMk and mahasiswa data to the view
        return view('mhs_daftarMatkul', compact('daftarMk', 'mahasiswa'));
        }
        
        

        
        

}