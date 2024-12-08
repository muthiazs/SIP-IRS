<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DekanController extends Controller
{
    public function indexDekan()
    {
        // Debugging query langsung
        $dekan = DB::table('dosen')
                    ->join('users', 'dosen.id_user', '=', 'users.id')
                    ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                    ->crossJoin('periode_akademik')
                    ->where('users.roles1', '=', 'dosen')
                    ->where('users.roles2', '=', 'dekan')
                    ->where('dosen.id_user', '=', Auth::id())
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
        return view('dashboardDekan', compact('dekan'));
    }

    public function PersetujuanRuang()
    {
        // Debugging query langsung
        $dekan = DB::table('dosen')
                    ->join('users', 'dosen.id_user', '=', 'users.id')
                    ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                    ->crossJoin('periode_akademik')
                    ->where('users.roles1', '=', 'dosen')
                    ->where('users.roles2', '=', 'dekan')
                    ->where('dosen.id_user', '=', Auth::id())
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

        $accRuang = DB::table('ruangan')
                    -> join('alokasi_ruangan', 'ruangan.id_ruang', '=', 'alokasi_ruangan.id_ruang')
                    -> join('program_studi', 'alokasi_ruangan.id_prodi', '=', 'program_studi.id_prodi')
                    -> where(
                        'ruangan.status', '=', 'diajukan'
                    )
                    -> select(
                        'ruangan.nama as ruang_nama',
                        'ruangan.kapasitas',
                        'program_studi.nama as prodi_nama'
                        )
                    -> get();
        return view('dekan_PersetujuanRuang', compact('dekan', 'accRuang'));
    }

    public function setujuiRuang(Request $request)
    {
        $ruang = DB::table('ruangan')
        ->where('nama', $request->nama_ruang)
        ->first();
        // dd($ruang);
        
        DB::table('ruangan')
        ->where('id_ruang', $ruang->id_ruang)
        ->update([
            'status' => 'telah digunakan'
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Ruangan berhasil disetujui.');
    }

    public function tolakRuang(Request $request)
    {
        $ruang = DB::table('ruangan')
        ->where('nama', $request->nama_ruang)
        ->first();
        // dd($ruang);

        DB::table('ruangan')
        ->where('id_ruang', $ruang->id_ruang)
        ->update([
            'status' => 'tersedia'
        ]);

        DB::table('alokasi_ruangan')
        ->where('id_ruang', $ruang->id_ruang)  
        ->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Persetujuan ditolak.');
    }

    public function PersetujuanJadwal()
    {
        // Debugging query langsung
        $dekan = DB::table('dosen')
                    ->join('users', 'dosen.id_user', '=', 'users.id')
                    ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                    ->crossJoin('periode_akademik')
                    ->where('users.roles1', '=', 'dosen')
                    ->where('users.roles2', '=', 'dekan')
                    ->where('dosen.id_user', '=', Auth::id())
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
        
        $programStudi = DB::table('program_studi')
                    ->select('id_prodi', 'nama')
                    ->get();

        return view('dekan_PersetujuanJadwal', compact('dekan', 'programStudi'));
    }
}