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
}
