<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function index()
{
    // Ambil data dosen
    $dosen = DB::table('dosen')
        ->join('users', 'dosen.id_user', '=', 'users.id')
        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
        ->crossJoin('periode_akademik')
        ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
        ->select(
            'dosen.nip',
            'dosen.nama as dosen_nama',
            'program_studi.nama as prodi_nama',
            'dosen.prodi_id',
            'users.username',
            'periode_akademik.nama_periode'
        )
        ->where('dosen.id_user', '=', auth()->id())
        ->first();

    // Ambil periode akademik terbaru
    $periodeTerbaru = DB::table('periode_akademik')
        ->orderBy('id_periode', 'desc')
        ->first();


    // Ambil masa IRS berdasarkan periode akademik terbaru dan rentang waktu
    $fetchPeriodeSetujuIRS = DB::table('kalender_akademik')
    ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'kalender_akademik.id_periode')
    ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode) // Menggunakan periode akademik terbaru
    ->where('kalender_akademik.kode_kegiatan','=','setujuiIRS')
    ->select(
        'kalender_akademik.tanggal_mulai', // Menggunakan nama kolom yang valid
        'kalender_akademik.tanggal_selesai', // Menggunakan nama kolom yang valid
        'kalender_akademik.nama_kegiatan' // Untuk kebutuhan tambahan
    )
    ->first();

    // Cek apakah data periode penyetujuan IRS ada
    if (!$fetchPeriodeSetujuIRS) {
        // Jika data tidak ditemukan, beri nilai default
        $fetchPeriodeSetujuIRS = (object)[
            'tanggal_mulai' => 'Data tidak ditemukan',
            'tanggal_selesai' => 'Data tidak ditemukan',
            'nama_kegiatan' => 'Data tidak ditemukan'
        ];
    }

    // Ambil masa penyetujuan IRS yang aktif saat ini
    $currentDate = now();
    $periodeIRS = DB::table('kalender_akademik')
        ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'kalender_akademik.id_periode')
        ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode)
        ->where(function ($query) use ($currentDate) {
            $query->where('kode_kegiatan', '=', 'setujuIRS')  // Gunakan '=' untuk mencocokkan 'setujuIRS'
                ->whereDate('tanggal_mulai', '<=', $currentDate->toDateString())
                ->whereDate('tanggal_selesai', '>=', $currentDate->toDateString());
        })
        ->pluck('kalender_akademik.nama_kegiatan')
        ->first();

    // Tetapkan nilai masa IRS berdasarkan hasil query
    $masaIRS = $periodeIRS ?? null;

    // Kirim data ke view
    return view('dashboardDosen', compact('dosen', 'masaIRS', 'fetchPeriodeSetujuIRS'));
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



    //Method untuk dashboard Mahasiswa
    public function indexMahasiswa()
    {
        $currentDate = Carbon::now()->toDateString(); // Tanggal saat ini
        // dump($currentDate);

        // Ambil periode akademik terbaru berdasarkan id_periode
        $periodeTerbaru = DB::table('periode_akademik')
            ->orderBy('id_periode', 'DESC') // Mengambil periode akademik berdasarkan id_periode terbaru
            ->first();
        // dump($periodeTerbaru);

        // Pastikan periode akademik terbaru ditemukan
        if (!$periodeTerbaru) {
            return view('dashboardMahasiswa', compact('mahasiswa', 'masaIRS'));
        }
        
        // Ambil data mahasiswa dengan periode akademik terbaru
        $mahasiswa = DB::table('mahasiswa')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
            ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
            ->join('progress_mahasiswa as prg', 'prg.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->crossJoin('periode_akademik')
            ->join('kalender_akademik', 'kalender_akademik.id_periode', '=', 'periode_akademik.id_periode')
            ->where('mahasiswa.id_user', auth()->id())
            ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode) // Menggunakan periode akademik terbaru
            ->whereIn('kalender_akademik.kode_kegiatan', ['isiIRS', 'gantiIRS', 'batalIRS']) // Mengambil kode kegiatan IRS
            ->orderBy('periode_akademik.id_periode', 'desc') // Mengurutkan berdasarkan periode terbaru
            ->select(
                'mahasiswa.nim',
                'mahasiswa.nama as nama_mhs',
                'program_studi.nama as prodi_nama',
                'dosen.nama as nama_doswal',
                'dosen.nip',
                'users.username',
                'periode_akademik.nama_periode',
                'prg.IPk as IPk',
                'prg.SKSk as SKSk',
                'prg.semester_studi as semester',
                'kalender_akademik.tanggal_mulai',
                'kalender_akademik.tanggal_selesai'
            )
            ->first();

        // Ambil masa IRS berdasarkan periode akademik terbaru dan rentang waktu
        $fetchPeriodeISIIRS = DB::table('kalender_akademik')
            ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'kalender_akademik.id_periode')
            ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode) // Menggunakan periode akademik terbaru
            ->where('kalender_akademik.kode_kegiatan','=','isiIRS')
            ->select(
                'kalender_akademik.tanggal_mulai', // Menggunakan nama kolom yang valid
                'kalender_akademik.tanggal_selesai', // Menggunakan nama kolom yang valid
                'kalender_akademik.nama_kegiatan' // Untuk kebutuhan tambahan
            )
            ->first();

        // dump($mahasiswa);
    
        // // Ambil masa IRS berdasarkan periode akademik terbaru dan rentang waktu
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
        // dump($periodeIRS);
        
        // Tetapkan nilai masa IRS berdasarkan hasil query
        $masaIRS = $periodeIRS ?? null;
        // dump($masaIRS);
        
        // Kirim data ke view
        return view('dashboardMahasiswa', compact('mahasiswa', 'masaIRS','fetchPeriodeISIIRS',));
    }
    
    
    
    
    
    
    

    

    // public function indexMahasiswa()
    // {
    //     $mahasiswa = DB::table('mahasiswa')
    //                 ->join('users', 'mahasiswa.id_user', '=', 'users.id')
    //                 ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
    //                 ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
    //                 ->join('progress_mahasiswa as prg' , 'prg.id_mahasiswa' , '=' , 'mahasiswa.id_mahasiswa')
    //                 ->crossJoin('periode_akademik')
    //                 ->where('mahasiswa.id_user', auth()->id())
    //                 ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
    //                 ->select(
    //                     'mahasiswa.nim',
    //                     'mahasiswa.nama as nama_mhs',
    //                     'program_studi.nama as prodi_nama',
    //                     'dosen.nama as nama_doswal',
    //                     'dosen.nip',
    //                     'users.username',
    //                     'periode_akademik.nama_periode',
    //                     'prg.IPk as IPk',
    //                     'prg.SKSk as SKSk',
    //                     'prg.semester_studi as semester'
    //                 ) 
    //                 ->first();  // Ambil baris pertama dengan timestamp terbaru
    //     return view('dashboardMahasiswa', compact('mahasiswa'));
    // }

    
    

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
