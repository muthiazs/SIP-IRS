<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    // Method untuk Dashboard Dosen
    public function index()
    {
        $dosen = DB::table('dosen')
                    ->join('users', 'dosen.id_user', '=', 'users.id')
                    ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                    ->crossJoin('periode_akademik')
                    ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                    ->select(
                        'dosen.nip',                    // Pastikan NIP sudah dipilih
                        'dosen.nama as dosen_nama',
                        'program_studi.nama as prodi_nama',
                        'dosen.prodi_id',
                        'users.username',
                        'periode_akademik.nama_periode'
                    )
                    ->where('dosen.id_user', '=', auth()->id())
                    ->first();
        // dd($dosen);
        return view('dashboardDosen', compact('dosen'));
    }


    // Method untuk Dashboard Kaprodi
    public function indexKaprodi()
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

    // Method untuk Dashboard Mahasiswa
    public function indexMahasiswa()
    {
        $mahasiswa = DB::table('mahasiswa')
                    ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                    ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                    ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
                    ->crossJoin('periode_akademik')
                    ->where('mahasiswa.id_user', auth()->id())
                    ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                    ->select(
                        'mahasiswa.nim',
                        'mahasiswa.nama as nama_mhs',
                        'program_studi.nama as prodi_nama',
                        'dosen.nama as nama_doswal',
                        'dosen.nip',
                        'users.username',
                        'periode_akademik.nama_periode'
                    ) 
                    ->first();  // Ambil baris pertama dengan timestamp terbaru
        return view('dashboardMahasiswa', compact('mahasiswa'));
    }
    
    

    //Method untuk Dasboard Dekan
    public function indexDekan()
    {
        // Debugging query langsung
        $dekan = DB::table('dosen')
                    ->join('users', 'dosen.id_user', '=', 'users.id')
                    ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                    ->crossJoin('periode_akademik')
                    ->where('users.roles1', '=', 'dosen')
                    ->where('users.roles2', '=', 'dekan')
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
        Log::debug('Kaprodi Data:', (array) $dekan);  // Log data yang diambil untuk diperiksa

        if (!$dekan) {
            return redirect()->back()->with('error', 'Kaprodi tidak ditemukan.');
        }
        return view('dashboardDekan', compact('dekan'));
    }

    
    
    public function indexAkademik()
    {
        // Contoh data dummy, nantinya bisa diambil dari database
        $akademik = DB::table('pegawai')
                        ->join('users', 'pegawai.id_user', '=', 'users.id')
                        ->crossJoin('periode_akademik')
                        ->where('pegawai.id_user', auth()->id())
                        ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
                        ->select(
                            'pegawai.nama',
                            'pegawai.nip',
                            'periode_akademik.nama_periode'
                        )
                        ->first();
        ;

        return view('dashboardAkademik', compact('akademik'));
    }
    
    
}
