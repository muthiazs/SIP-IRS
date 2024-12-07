<?php

namespace App\Http\Controllers;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class KaprodiControler extends Controller
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
            ->where('users.roles1', '=', 'dosen')
            ->where('users.roles2', '=', 'kaprodi')
            ->where('dosen.id_user', '=', auth()->id())
            ->orderBy('periode_akademik.created_at', 'desc')
            ->select('dosen.nip', 'dosen.nama as dosen_nama', 'program_studi.nama as prodi_nama', 'dosen.prodi_id', 'users.username', 'periode_akademik.nama_periode')
            ->first();

        $namaMK = Matakuliah::all();
        $jadwal = DB::table('jadwal_kuliah')
            ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
            ->join('ruangan', 'jadwal_kuliah.id_ruang', '=', 'ruangan.id_ruang')
            ->select('jadwal_kuliah.*', 'matakuliah.nama_matkul', 'ruangan.nama as namaruang')
            ->get();


        return view('kaprodi_JadwalKuliah', compact('kaprodi', 'namaMK', 'jadwal'));
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

    public function storeJadwalKuliah(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'kode_matkul' => 'required|string',
        'hari' => 'required|string',
        'ruang' => 'required|string',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    ]);

    // Simpan ke database (misalnya ke tabel 'jadwal_kuliah')
    DB::table('jadwal_kuliah')->insert([
        'kode_matkul' => $validated['kode_matkul'],
        'hari' => $validated['hari'],
        'ruang' => $validated['ruang'],
        'jam_mulai' => $validated['jam_mulai'],
        'jam_selesai' => $validated['jam_selesai'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Redirect dengan pesan sukses
    return redirect()->back()->with('toast_success', 'Jadwal berhasil ditambahkan.');
}


} 
