<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BAK_PembagianruangController extends Controller
{
    public function indexPembagianRuang()
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
        return view('bak_pembagianRuang', compact('tabelRuang', 'akademik'));
    }

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
        return view('bak_pembagianRuang', compact('tabelRuang', 'akademik'));
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
        return view('bak_pembagianRuang', compact('tabelRuang', 'akademik'));
    }
}