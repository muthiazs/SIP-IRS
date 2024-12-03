<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BAK_PembagianruangController extends Controller
{
    // Controller untuk Pembagian Ruang
    public function indexPembagianRuang()
    {
        // Ambil ruangan yang belum dialokasikan
        $tabelRuang = DB::table('ruangan as r')
            ->whereNotExists(function($query) {
                $query->select(DB::raw(1))
                    ->from('alokasi_ruangan as ar')
                    ->whereRaw('ar.id_ruang = r.id_ruang');
            })
            ->select(
                'r.nama',
                'r.kapasitas'
            )
            ->get();

        $akademik = DB::table('pegawai')
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->crossJoin('periode_akademik')
            ->where('pegawai.id_user', auth()->id())
            ->orderBy('periode_akademik.created_at', 'desc')
            ->select(
                'pegawai.nama',
                'pegawai.nip',
                'periode_akademik.nama_periode'
            )
            ->first();

        return view('bak_pembagianRuang', compact('tabelRuang', 'akademik'));
    }

    // Controller untuk Cek Status Ruang (apakah sudah di-acc Dekan atau belum)
    public function indexCekStatusRuang()
    {
        // Ambil ruangan yang belum dialokasikan
        $statusRuang = DB::table('ruangan')
                        ->join('alokasi_ruangan', 'alokasi_ruangan.id_ruang', '=', 'ruangan.id_ruang')
                        ->where('ruangan.status', '=', 'tersedia')  // Perbaiki penggunaan '=='
                        ->where('ruangan.id_ruang', '=', DB::raw('alokasi_ruangan.id_ruang'))  // Pastikan kondisi kedua terpisah
                        ->select(
                            'ruangan.nama',
                            'ruangan.kapasitas'
                        )
                        ->get();

        $akademik = DB::table('pegawai')
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->crossJoin('periode_akademik')
            ->where('pegawai.id_user', auth()->id())
            ->orderBy('periode_akademik.created_at', 'desc')
            ->select(
                'pegawai.nama',
                'pegawai.nip',
                'periode_akademik.nama_periode'
            )
            ->first();

        return view('bak_pembagianRuang', compact('statusRuang', 'akademik'));
    }

    // Controller untuk Alokasi Pembagian Ruang
    public function storeRuang(Request $request)
    {
        $ruang = DB::table('ruangan')
        ->where('nama', $request->nama_ruang)
        ->first();
        
        $prodi = DB::table('program_studi')
        ->where('nama', $request->prodi)
        ->first();
        
        $periode = DB::table('periode_akademik')->orderBy('created_at', 'desc')->first();
        
        // dd($ruang, $prodi, $periode);

        // Simpan ke database
        DB::table('alokasi_ruangan')->insert([
            'id_ruang' => $ruang->id_ruang,
            'id_prodi' => $prodi->id_prodi,
            'semester' => $periode->jenis,
            'tahun_ajaran' =>$periode->tahun_mulai . '/' . $periode->tahun_selesai,
            'created_at' => now(),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('toast_success', 'Ruangan berhasil dialokasikan.');
    }
    

    // Controller untuk page Create Ruang
    public function indexCreateRuang()
    {

        $tabelRuang = DB::table('ruangan')
            ->select(
                'ruangan.nama',
                'ruangan.kapasitas'
            )
            ->get();

        // dd($tabelRuang);

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
        return view('bak_CreateRuang', compact('tabelRuang', 'akademik'));
    }

    public function createRuang(Request $request)
    {
        // dd($request->all());
        // Validasi data
        $cekRuangan = DB::table('ruangan')
            ->where('nama', $request->nama)
            ->first();

        if ($cekRuangan) {
            return redirect()->back()->with('toast_error', 'Ruangan dengan nama tersebut sudah ada.');
        }

        $lastRuangan = DB::table('ruangan')
            ->orderBy('id_ruang', 'desc')
            ->first();

        $id_ruang = $lastRuangan ? $lastRuangan->id_ruang + 1 : 1;

        // Simpan ke database
        DB::table('ruangan')->insert([
            'id_ruang' => $id_ruang,
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'status' => 'tersedia', 
            'created_at' => now(),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('toast_success', 'Ruangan baru berhasil ditambahkan.');
    }

    public function indexUpdateDeleteRuang()
    {

        $tabelRuang = DB::table('ruangan')
            ->select(
                'ruangan.nama',
                'ruangan.kapasitas'
            )
            ->get();

        // dd($tabelRuang);

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
        return view('bak_UpdateDeleteRuang', compact('tabelRuang', 'akademik'));
    }

    public function indexNextUpdateDeleteRuang()
    {

        $tabelRuang = DB::table('ruangan')
            ->select(
                'ruangan.nama',
                'ruangan.kapasitas'
            )
            ->get();

        // dd($tabelRuang);

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
        return view('bak_NextUpdateDeleteRuang', compact('tabelRuang', 'akademik'));
    }
}