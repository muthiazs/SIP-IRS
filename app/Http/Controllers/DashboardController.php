<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data dummy, nantinya bisa diambil dari database
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
}