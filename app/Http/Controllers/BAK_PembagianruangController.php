<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BAK_PembagianruangController extends Controller
{
    public function index()
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
            ]
        ];

        return view('bak_pembagianruang', compact('data'));
    }
}