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

             // Ambil periode akademik terbaru berdasarkan id_periode
            $periodeTerbaru = DB::table('periode_akademik')
            ->orderBy('id_periode', 'DESC')
            ->first();
            // Pastikan periode akademik terbaru ditemukan
            if (!$periodeTerbaru) {
                return view('dashboardKaprodi', compact('kaprodi'));
            }

            // Mendapatkan tanggal saat ini
            $currentDate = now();

            // Ambil masa setuju ruangan jadwal berdasarkan periode akademik terbaru dan rentang waktu
            $fetchPeriodeSetujuRuanganJadwal = DB::table('kalender_akademik')
                ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'kalender_akademik.id_periode')
                ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode) 
                ->where('kalender_akademik.kode_kegiatan', 'setujuRuanganJadwal') // Menggunakan kode kegiatan 'setujuRuanganJadwal'
                ->whereDate('kalender_akademik.tanggal_mulai', '<=', $currentDate->toDateString()) // Memastikan tanggal mulai tidak melebihi tanggal sekarang
                ->whereDate('kalender_akademik.tanggal_selesai', '>=', $currentDate->toDateString()) // Memastikan tanggal selesai lebih besar dari atau sama dengan tanggal sekarang
                ->select(
                    'kalender_akademik.tanggal_mulai', // Mengambil tanggal mulai
                    'kalender_akademik.tanggal_selesai', // Mengambil tanggal selesai
                    'kalender_akademik.nama_kegiatan' // Mengambil nama kegiatan
                )
                ->first(); // Mengambil hanya satu hasil yang sesuai dengan periode saat ini

            // Tetapkan nilai masa setuju ruangan jadwal berdasarkan hasil query
            $masaSetujuRuanganJadwal = $fetchPeriodeSetujuRuanganJadwal ?? null;
        return view('dashboardDekan', compact('dekan' ,'masaSetujuRuanganJadwal'));
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
        
        $programStudi = DB::table('program_studi')
                    ->select('id_prodi', 'nama')
                    ->get();

        return view('dekan_PersetujuanJadwal', compact('dekan', 'programStudi'));
    }
}