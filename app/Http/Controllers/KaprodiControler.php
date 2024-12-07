<?php

namespace App\Http\Controllers;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function DashboardKaprodi()
    {
        $kaprodi = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->crossJoin('periode_akademik')
                        ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
                        ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
                        ->where('dosen.id_user', '=', auth()->id())
                        ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                        ->select(
                            'dosen.nip',
                            'dosen.nama as dosen_nama',
                            'program_studi.nama as prodi_nama',
                            'dosen.prodi_id',
                            'users.username',
                            'periode_akademik.nama_periode'
                        )
                        ->first();
        return view('dashboardKaprodi', compact('kaprodi'));
    }

    public function JadwalKuliah()
    {
        $kaprodi = DB::table('dosen')
            ->join('users', 'dosen.id_user', '=', 'users.id')
            ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
            ->crossJoin('periode_akademik')
            ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
            ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
            ->where('dosen.id_user', '=', auth()->id())
            ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
            ->select(
                'dosen.nip',
                'dosen.nama as dosen_nama',
                'program_studi.nama as prodi_nama',
                'dosen.prodi_id',
                'users.username',
                'periode_akademik.nama_periode'
            )
            ->first();
    
        // Ambil semua mata kuliah
        $namaMK = Matakuliah::all();
    
        // Ambil ruangan dengan status "telah digunakan"
        $ruangan = DB::table('ruangan')->where('status', 'telah digunakan')->get();
    
        // Kirimkan data ke view
        return view('kaprodi_JadwalKuliah', compact('kaprodi', 'namaMK', 'ruangan'));
    }
    

    public function StatusMahasiswa()
    {
        $kaprodi = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->crossJoin('periode_akademik')
                        ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
                        ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
                        ->where('dosen.id_user', '=', auth()->id())
                        ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                        ->select(
                            'dosen.nip',
                            'dosen.nama as dosen_nama',
                            'program_studi.nama as prodi_nama',
                            'dosen.prodi_id',
                            'users.username',
                            'periode_akademik.nama_periode'
                        )
                        ->first();
        return view('kaprodi_StatusMahasiswa', compact('kaprodi'));
    }

    public function setMatkul()
    {
        $kaprodi = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->crossJoin('periode_akademik')
                        ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
                        ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
                        ->where('dosen.id_user', '=', auth()->id())
                        ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                        ->select(
                            'dosen.nip',
                            'dosen.nama as dosen_nama',
                            'program_studi.nama as prodi_nama',
                            'dosen.prodi_id',
                            'users.username',
                            'periode_akademik.nama_periode'
                        )
                        ->first();
        
        $mataKuliah = DB::table('matakuliah')
                        -> select(
                            'kode_matkul',
                            'nama_matkul',
                            'sks',
                            'semester'
                        )
                        -> get();
        return view('kaprodi_SetMatkul', compact('kaprodi', 'mataKuliah'));
    }

    public function UpdateDeleteMatkul()
    {
        $kaprodi = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->crossJoin('periode_akademik')
                        ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
                        ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
                        ->where('dosen.id_user', '=', auth()->id())
                        ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                        ->select(
                            'dosen.nip',
                            'dosen.nama as dosen_nama',
                            'program_studi.nama as prodi_nama',
                            'dosen.prodi_id',
                            'users.username',
                            'periode_akademik.nama_periode'
                        )
                        ->first();
        
        $mataKuliah = DB::table('matakuliah')
                        -> select(
                            'kode_matkul',
                            'nama_matkul',
                            'sks',
                            'semester'
                        )
                        -> get();
        return view('kaprodi_UpdateDeleteMatkul', compact('kaprodi', 'mataKuliah'));
    }

    public function indexCreateMatkul()
    {
        $kaprodi = DB::table('matakuliah')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->crossJoin('periode_akademik')
                        ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
                        ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
                        ->where('dosen.id_user', '=', auth()->id())
                        ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                        ->select(
                            'dosen.nip',
                            'dosen.nama as dosen_nama',
                            'program_studi.nama as prodi_nama',
                            'dosen.prodi_id',
                            'users.username',
                            'periode_akademik.nama_periode'
                        )
                        ->first();
        return view('kaprodi_CreateMatkul', compact('kaprodi'));
    }

    public function createMatkul(Request $request)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|string|max:50',
            'nama_matkul' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:8',
        ]);
    
        $cekMatkul = DB::table('matakuliah')->where('kode_matkul', $validated['kode_matkul'])->first();
    
        if ($cekMatkul) {
            return redirect()->back()->with('error', 'Kode mata kuliah sudah ada.');
        }
    
        DB::table('matakuliah')->insert([
            'kode_matkul' => $validated['kode_matkul'],
            'nama_matkul' => $validated['nama_matkul'],
            'sks' => $validated['sks'],
            'created_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Mata kuliah baru berhasil ditambahkan.');
    }    


} 
