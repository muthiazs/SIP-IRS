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

    //Buat nampilin data di persetujuan ruang
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

        $accRuang = DB::table('alokasi_ruangan')
                    -> join('ruangan', 'ruangan.id_ruang', '=', 'alokasi_ruangan.id_ruang')
                    -> join('program_studi', 'alokasi_ruangan.id_prodi', '=', 'program_studi.id_prodi')
                    -> where(
                        'alokasi_ruangan.status', '=', 'belum_disetujui'
                    )
                    -> select(
                        'alokasi_ruangan.id_ruang',
                        'ruangan.nama as ruang_nama',
                        'ruangan.kapasitas',
                        'program_studi.nama as prodi_nama'
                        )
                    -> get();
        return view('dekan_PersetujuanRuang', compact('dekan', 'accRuang'));
    }

    public function setujuiRuang($id_ruang)
    {
        if (!$id_ruang) {
            abort(400, 'Parameter id_ruang tidak ditemukan.');
        }
    
        // Update status di tabel alokasi_ruangan berdasarkan id_ruang
        DB::table('alokasi_ruangan')
            ->where('alokasi_ruangan.id_ruang', $id_ruang)
            ->update(['status' => 'disetujui']);
        DB::table('ruangan')
            ->where('ruangan.id_ruang', $id_ruang)
            ->update(['status' => 'disetujui']);
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Ruangan berhasil disetujui.');
    }
    
    public function setujuiSemuaRuang()
    {
        // Update semua ruangan dengan status 'belum_disetujui' menjadi 'telah digunakan'
        DB::table('alokasi_ruangan')
            ->where('status', 'belum_disetujui')
            ->update(['status' => 'disetujui']);
        DB::table('ruangan')
            ->where('status', 'diajukan')
            ->update(['status' => 'disetujui']);
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Semua ruangan berhasil disetujui.');
    }

    // public function tolakRuang(Request $request)
    // {
    //     $ruang = DB::table('ruangan')
    //     ->where('nama', $request->nama_ruang)
    //     ->first();
    //     // dd($ruang);

    //     DB::table('ruangan')
    //     ->where('id_ruang', $ruang->id_ruang)
    //     ->update([
    //         'status' => 'tersedia'
    //     ]);

    //     DB::table('alokasi_ruangan')
    //     ->where('id_ruang', $ruang->id_ruang)  
    //     ->delete();

    //     // Redirect kembali dengan pesan sukses
    //     return redirect()->back()->with('success', 'Persetujuan ditolak.');
    // }

    public function PersetujuanJadwal()
    {
        $dekan = DB::table('dosen')
            ->join('users', 'dosen.id_user', '=', 'users.id')
            ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
            ->crossJoin('periode_akademik')
            ->where('users.roles1', '=', 'dosen')
            ->where('users.roles2', '=', 'dekan')
            ->where('dosen.id_user', '=', Auth::id())
            ->orderBy('periode_akademik.created_at', 'desc')
            ->select(
                'dosen.nip',
                'dosen.nama as dosen_nama',
                'program_studi.nama as prodi_nama',
                'dosen.prodi_id',
                'users.username',
                'periode_akademik.nama_periode'
            )
            ->first();

        // Ambil semua program studi
        $prodi = DB::table('program_studi')
        ->select('id_prodi', 'nama')
        ->get();
    
        // Ambil semua jadwal berdasarkan program studi
        $jadwalPerProdi = [];
        foreach ($prodi as $item) {
            $jadwalPerProdi[$item->id_prodi] = DB::table('jadwal_kuliah as jk')
                ->join('matakuliah', 'jk.kode_matkul', '=', 'matakuliah.kode_matkul')
                ->join('ruangan', 'jk.id_ruang', '=', 'ruangan.id_ruang')
                ->join('dosen', 'jk.id_dosen', '=', 'dosen.id_dosen')
                ->where('jk.status', '=', 'belum_terkonfirmasi')
                ->where('matakuliah.id_prodi', '=', $item->id_prodi)
                ->select(
                    'jk.id_jadwal',
                    'jk.kode_matkul',
                    'matakuliah.nama_matkul as nama_matkul',
                    'jk.kelas',
                    'matakuliah.sks',
                    'ruangan.nama as nama_ruang',
                    'dosen.nama as nama_dosen',
                    'matakuliah.id_prodi'
                )
                ->get();
        }
    
        return view('dekan_PersetujuanJadwal', compact('dekan', 'prodi', 'jadwalPerProdi'));
    }
    

    public function setujuiJadwal(Request $request)
    {
        // Fetch the schedule by ID
        $jadwal = DB::table('jadwal_kuliah')
            ->where('id_jadwal', $request->id_jadwal)
            ->first();
    
        // Check if the schedule exists and its status
        if (!$jadwal || $jadwal->status !== 'belum_terkonfirmasi') {
            return response()->json(['error' => 'Jadwal tidak ditemukan atau sudah disetujui.'], 400);
        }
    
        // Update the status of the schedule to 'disetujui'
        DB::table('jadwal_kuliah')
            ->where('id_jadwal', $jadwal->id_jadwal)
            ->where('status', 'belum_terkonfirmasi')
            ->update(['status' => 'disetujui']);
    
        return response()->json(['success' => 'Jadwal berhasil disetujui.']);
    }
    
    
    public function setujuiSemuaJadwal(Request $request)
    {
        $ids = $request->input('id_jadwals', []);
    
        if (empty($ids)) {
            return response()->json(['error' => 'Tidak ada jadwal yang dipilih'], 400);
        }
    
        // Cek apakah jadwal ada dan statusnya 'belum_terkonfirmasi'
        $updated = DB::table('jadwal_kuliah')
            ->whereIn('id_jadwal', $ids)
            ->where('status', 'belum_terkonfirmasi')
            ->update(['status' => 'disetujui']);
    
        if ($updated) {
            return response()->json(['success' => 'Semua jadwal berhasil disetujui']);
        } else {
            return response()->json(['error' => 'Tidak ada jadwal yang diubah atau statusnya sudah disetujui'], 400);
        }
    }
    
    

}
