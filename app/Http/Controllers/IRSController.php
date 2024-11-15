<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class IRSController extends Controller
{
    public function index()
    {
        $dosen = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->select(
                            'dosen.nip',                    // Pastikan NIP sudah dipilih
                            'dosen.nama as dosen_nama',
                            'program_studi.nama as prodi_nama',
                            'dosen.prodi_id',
                            'users.username'
                        )
                        ->where('dosen.id_user', '=', auth()->id())
                        ->first();
        return view('dosen_irsMahasiswa' , compact('dosen')); // Sesuaikan dengan nama view yang kamu buat
    }

}
