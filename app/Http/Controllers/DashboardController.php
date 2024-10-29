<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method untuk Dashboard Dosen
    public function index()
    {
        // Data dummy untuk dosen
        $data = [
            'user' => [
                'name' => 'Bill Gates',
                'nip' => '198203092006041002',
                'program_studi' => 'S1 Informatika'
            ],
            'semester' => [
                'current' => '2024/2025 Ganjil',
                'period' => '1 Mar - 2 April'
            ],
            'progress' => [
                'disetujui' => ['count' => 40, 'total' => 56],
                'ditolak' => ['count' => 5, 'total' => 46],
                'pending' => ['count' => 11, 'total' => 56]
            ]
        ];
        return view('dashboardDosen', compact('data'));
    }

    // Method untuk Dashboard Kaprodi
    public function indexKaprodi()
    {
        // Data dummy untuk kaprodi
        $data = [
            'kaprodi' => [
                'name' => 'Dewi Suwako Moriya',
                'nip' => '198203092006041002',
                'program_studi' => 'S1 Informatika'
            ],
            'semester' => [
                'current' => '2024/2025 Ganjil',
                'period' => '1 Mar - 2 April'
            ],
            'progressIRSMahasiswaKaprodi' => [
                'sudahKonfirmasi' => ['count' => 40, 'total' => 56],
                'belumKonfirmasi' => ['count' => 5, 'total' => 46],
                'sudahIsiIRS' => ['count' => 11, 'total' => 56],
                'belumIsiIRS' => ['count' => 11, 'total' => 56]
            ],
            'progressMahasiswaProdiKaprodi' => [
                'mangkir' => ['count' => 11, 'total' => 56],
                'cuti' => ['count' => 11, 'total' => 56],
                'sudahKonfirmasi' => ['count' => 40, 'total' => 56],
                'belumKonfirmasi' => ['count' => 5, 'total' => 46]
            ]
        ];
        

        return view('dashboardKaprodi', compact('data'));
    }


    // Method untuk Dashboard Mahasiswa
    public function indexMahasiswa()
    {
        // Data dummy untuk kaprodi
        $data = [
           'mahasiswa' => [
                'name' => 'Draco Lucius Malfoy',
                'nim' => '24060122130071',
                'program_studi' => 'S1 Informatika'
            ],
            'user' => [
                'name' => 'Bill Gates',
                'nip' => '198203092006041002'
            ]
        ];
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
}
