<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Method untuk Dashboard Dosen
    public function index()
    {
        // Data dummy untuk dosen
        $dosen = DB::table('dosen')
                    ->join('users', 'dosen.id_user', '=', 'users.id')
                    ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                    ->select(
                        'dosen.nip',
                        'dosen.nama as dosen_nama',         // Alias to avoid conflict
                        'program_studi.nama as prodi_nama', // Alias for program_studi's nama
                        'dosen.prodi_id',
                        'users.username'
                    )
                    ->where ('dosen.id_user', '=', auth()->id())
                    ->first(); 
        return view('dashboardDosen', compact('dosen'));

    }

    // Method untuk Dashboard Kaprodi
    public function indexKaprodi()
    {
        $kaprodi = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id') // Corrected 'user' to 'users'
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->where('users.roles2', '=', 'kaprodi') // Filtering by 'kaprodi' role
                        ->where('dosen.id_user', '=', auth()->id()) // Ensuring data for logged-in user
                        ->select(
                            'dosen.nip',
                            'dosen.nama as dosen_nama',         // Alias to avoid conflict
                            'program_studi.nama as prodi_nama', // Alias for program_studi's nama
                            'dosen.prodi_id',
                            'users.username'
                        )
                        ->first();
    
        return view('dashboardKaprodi', compact('kaprodi'));
    }
    


    // Method untuk Dashboard Mahasiswa
    public function indexMahasiswa()
{
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
    
    return view('dashboardMahasiswa', compact('mahasiswa'));  // Gunakan dot notation
}
    //Method untuk Dasboard Dekan
    public function indexDekan()
    {
        //Data dummy untuk dekan
        $data = [
            'dekan' => [
                'name' => 'Sherlock Holmes',
                'nip' => '194577123475985',
                'program_studi' => 'S1-Informatika',
                'roles1' => 'dosen',
                'roles2' => 'dekan'
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
                'irs' => 'ditolak', // or 'disetujui', 'pending'
                'registrasi' => true
            ],
            'progress' => [
                'belum_mengusulkan' => ['count' => 1, 'total' => 6],
                'telah_dikonfirmasi' => ['count' => 4, 'total' => 6],
                'belum_dikonfirmasi' => ['count' => 1, 'total' => 6]
            ]
        ];
            return view('dashboardDekan', compact('data'));
    }
    public function indexAkademik()
    {
        // Contoh data dummy, nantinya bisa diambil dari database
        $data = [
            'user' => [
                'name' => 'Albus Dumbledore',
                'nip' => '198203092006041002',
                'role' => 'Tenaga Kependidikan',
                'periode' => 'Periode 2024-2029'
            ],
            'semester' => [
                'current' => '2024/2025 Ganjil',
                'period' => '19 Jan - 2 Mar'
            ],
            'progress' => [
                'belum_usul' => ['count' => 1, 'total' => 6],
                'dikonfirmasi' => ['count' => 4, 'total' => 6],
                'belum_dikonfirmasi' => ['count' => 1, 'total' => 6]
            ],
            'status' => [
                'bagiruang' => 'Belum Disetujui Dekan', // or 'disetujui', 'pending'
            ]
        ];

        return view('dashboardAkademik', compact('data'));
    }
}
