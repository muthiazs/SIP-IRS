<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function usulanIRSMahasiswa()
    {
        // Ambil data dosen yang sedang login
        $dosen = DB::table('dosen')
            ->join('users', 'dosen.id_user', '=', 'users.id')
            ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
            ->where('dosen.id_user', auth()->id())
            ->select(
                'dosen.nip',
                'dosen.nama as dosen_nama',
                'program_studi.nama as prodi_nama',
                'dosen.prodi_id'
            )
            ->first();
    
        // Ambil list mahasiswa dengan usulan IRS yang bukan draft
        $usulanIRS = DB::table('irs')
            ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
            ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
            ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
            ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
            ->where('mahasiswa.id_dosen', auth()->user()->id) // Filter mahasiswa berdasarkan dosen wali
            ->where('irs.status', '!=', 'draft')
            ->select(
                'mahasiswa.nim',
            'mahasiswa.nama as nama_mahasiswa',
            'mahasiswa.angkatan',
            'program_studi.nama as prodi_nama',
            DB::raw('COUNT(irs.id_irs) as total_usulan'),
            DB::raw('MAX(irs.status) as status_terakhir')
            )
            ->groupBy(
                'mahasiswa.nim', 
                'mahasiswa.nama', 
                'mahasiswa.angkatan', 
                'program_studi.nama'
            )
            ->get();
    
        return view('dosen_irsMahasiswa', compact('dosen', 'usulanIRS'));
    }
}
