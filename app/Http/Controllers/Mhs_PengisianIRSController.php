<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Mhs_PengisianIRSController extends Controller
{
        public function index()
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
}