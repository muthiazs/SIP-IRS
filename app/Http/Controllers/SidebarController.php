<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class SidebarController extends Controller
{
    // Method untuk Dashboard Dosen
    public function index()
    {
        $Dosen = DB::table('dosen')
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
        return view('dashboardDosen', compact('Dosen'));
    }


    // Method untuk Dashboard Kaprodi
    public function indexKaprodi()
    {
        $Kaprodi = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
                        ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
                        ->where('dosen.id_user', '=', auth()->id())
                        ->select(
                            'dosen.nip',
                            'dosen.nama as dosen_nama',
                            'program_studi.nama as prodi_nama',
                            'dosen.prodi_id',
                            'users.username'
                        )
                        ->first();

        dd($Kaprodi);
        return view('sidebar', ['Kaprodi' => $Kaprodi]);

    }


    // Method untuk cek masa isi IRS
    // public function cekMasaIsiIRS()
    // {
    //     // Tanggal saat ini
    //     $currentDate = Carbon::now();

    //     // Dapatkan periode akademik terbaru
    //     $periodeTerbaru = DB::table('periode_akademik')
    //         ->latest('id_periode') // Ambil periode akademik berdasarkan id_periode terbaru
    //         ->first();

    //     // Cek apakah ada periode terbaru
    //     if (!$periodeTerbaru) {
    //         return null; // Jika tidak ada periode, kembalikan null
    //     }

    //     // Query untuk mendapatkan kegiatan di kalender akademik berdasarkan periode terbaru
    //     $masaPeriode = DB::table('kalender_akademik')
    //         ->where('id_periode', $periodeTerbaru->id_periode) // Filter berdasarkan periode terbaru
    //         ->where('tanggal_mulai', '<=', $currentDate) // Tanggal sesuai dengan waktu sekarang
    //         ->where('tanggal_selesai', '>=', $currentDate)
    //         ->select('kode_kegiatan') // Ambil hanya kode kegiatan
    //         ->first();

    //     // Jika ditemukan kegiatan yang sesuai, kembalikan kode kegiatan
    //     if ($masaPeriode) {
    //         return $masaPeriode->kode_kegiatan; // Contoh: 'isiIRS', 'gantiIRS', atau 'batalIRS'
    //     }

    //     return null; // Jika tidak ada kegiatan yang sesuai, kembalikan null
    // }

    
    
    

    public function indexMahasiswa()
    {
        // Ambil data mahasiswa
        $Mahasiswa = DB::table('mahasiswa')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
            ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
            ->where('mahasiswa.id_user', auth()->id())
            ->select(
                'mahasiswa.nim',
                'mahasiswa.nama as nama_mhs',
                'program_studi.nama as prodi_nama',
                'dosen.nama as nama_doswal',
                'dosen.nip',
                'users.username'
            )
            ->first();
    
        // Ambil tanggal saat ini
        $currentDate = Carbon::now()->toDateString();
        
        // Ambil periode akademik terbaru berdasarkan id_periode
        $periodeTerbaru = DB::table('periode_akademik')
        ->orderBy('id_periode', 'DESC') // Urutkan berdasarkan id_periode terbaru
        ->first();
        dd($periodeTerbaru);
        
        // Pastikan periode akademik terbaru ditemukan
        if (!$periodeTerbaru) {
            return view('dashboardMahasiswa', compact('Mahasiswa', 'masaIRS'));
        }
    
        // // Cek masa IRS berdasarkan periode akademik terbaru dan tanggal saat ini
        $periodeIRS = DB::table('kalender_akademik')
            ->join('periode_akademik','periode_akademik.id_periode','=','kalender_akademik.id_periode')
            ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode) // Menggunakan periode akademik terbaru
            ->where(function ($query) use ($currentDate) {
                $query->whereIn('kode_kegiatan', ['isiIRS', 'gantiIRS', 'batalIRS'])
                    ->whereDate('tanggal_mulai', '<=', $currentDate)
                    ->whereDate('tanggal_selesai', '>=', $currentDate);
            })
            ->pluck('kalender_akademik.nama_kegiatan')
            ->first();
        
        // // Tetapkan nilai masa IRS berdasarkan hasil query
        $masaIRS = $periodeIRS ?? null;
        
        // Kirim data ke view
        return view('dashboardMahasiswa', compact('mahasiswa', 'masaIRS'));
    }
    
    //Method untuk Dasboard Dekan
    public function indexDekan()
    {
        // Debugging query langsung
        $Dekan = DB::table('dosen')
                    ->join('users', 'dosen.id_user', '=', 'users.id')
                    ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                    ->where('users.roles1', '=', 'dosen')
                    ->where('users.roles2', '=', 'dekan')
                    ->where('dosen.id_user', '=', auth()->id())
                    ->select(
                        'dosen.nip',
                        'dosen.nama as dosen_nama',
                        'program_studi.nama as prodi_nama',
                        'dosen.prodi_id',
                        'users.username'
                    )
                    ->first();
        return view('sidebar', ['Dekan' => $Dekan]);
    }

    
    
    public function indexAkademik()
    {
        // Contoh data dummy, nantinya bisa diambil dari database
        $akademik = DB::table('pegawai')
                        ->join('users', 'pegawai.id_user', '=', 'users.id')
                        ->where('pegawai.id_user', auth()->id())
                        ->select(
                            'pegawai.nama',
                            'pegawai.nip',
                        )
                        ->first();
        ;

        return view('dashboardAkademik', compact('akademik'));
    }
    
    
}