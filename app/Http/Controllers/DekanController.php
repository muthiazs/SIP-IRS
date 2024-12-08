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

    public function setujuiSemuaRuang()
    {
        // Update semua ruangan yang diajukan menjadi 'telah digunakan'
        DB::table('ruangan')
            ->where('status', 'diajukan')
            ->update(['status' => 'telah digunakan']);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Semua ruangan berhasil disetujui.');
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
        
        $prodi = DB::table('program_studi')
                    ->select('id_prodi', 'nama')
                    ->get();

        $jadwal = DB::table('jadwal_kuliah as jk')
                    ->join('matakuliah', 'jk.kode_matkul', '=', 'matakuliah.kode_matkul')
                    ->join('ruangan', 'jk.id_ruang', '=', 'ruangan.id_ruang')
                    ->join('dosen', 'jk.id_dosen', '=', 'dosen.id_dosen')
                    ->where('jk.status', '=', 'belum_disetujui')
                    ->select(
                    'jk.kode_matkul',
                    'matakuliah.nama_matkul as nama_matkul',
                    'jk.kelas',
                    'matakuliah.sks',
                    'ruangan.nama as nama_ruang',
                    'dosen.nama as nama_dosen'
                    )
                    ->get();

        return view('dekan_PersetujuanJadwal', compact('dekan', 'prodi', 'jadwal'));
    }

    public function setujuiJadwal(Request $request)
{
    $jadwal = DB::table('jadwal_kuliah')
        ->where('id_jadwal', $request->id_jadwal)
        ->first();

    if (!$jadwal || $jadwal->status !== 'belum_disetujui') {
        return redirect()->back()->with('error', 'Jadwal tidak ditemukan atau sudah disetujui.');
    }

    DB::table('jadwal_kuliah')
        ->where('id_jadwal', $jadwal->id_jadwal)
        ->update([
            'status' => 'disetujui'
        ]);

    return redirect()->back()->with('success', 'Jadwal berhasil disetujui.');
}

public function setujuiSemuaJadwal()
{
    DB::table('jadwal_kuliah')
        ->where('status', 'belum_disetujui')
        ->update(['status' => 'disetujui']);

    return redirect()->back()->with('success', 'Semua jadwal berhasil disetujui.');
}

}