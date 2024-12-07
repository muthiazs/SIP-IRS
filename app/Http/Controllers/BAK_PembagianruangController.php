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
            ->leftJoin('alokasi_ruangan as ar', 'ar.id_ruang', '=', 'r.id_ruang')
            ->whereNull('ar.id_ruang') // Memastikan hanya ruangan yang tidak teralokasi yang dipilih
            ->select('r.nama', 'r.kapasitas')
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
            ->join('program_studi', 'program_studi.id_prodi', '=', 'alokasi_ruangan.id_prodi') // Ganti 'id' menjadi 'id_prodi'
            ->where('ruangan.status', '=', 'diajukan')
            ->select(
                'ruangan.nama',
                'ruangan.kapasitas',
                'program_studi.nama as nama_prodi' // Ambil dari tabel program_studi
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

        return view('bak_CekStatusRuang', compact('statusRuang', 'akademik'));
    }

    // Controller untuk Alokasi Pembagian Ruang
    public function storeRuang(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_ruang' => 'required|string|exists:ruangan,nama',
            'prodi' => 'required|string|exists:program_studi,nama',
        ]);
    
        // Ambil data ruangan berdasarkan nama
        $ruang = DB::table('ruangan')->where('nama', $request->nama_ruang)->first();
    
        // Ambil data program studi berdasarkan nama
        $prodi = DB::table('program_studi')->where('nama', $request->prodi)->first();
    
        // Ambil data periode akademik terbaru
        $periode = DB::table('periode_akademik')->orderBy('created_at', 'desc')->first();
    
        // Validasi data terkait
        if (!$ruang || !$prodi || !$periode) {
            return redirect()->back()->with('error', 'Data tidak valid. Pastikan semua input benar.');
        }
    
        // Simpan data ke tabel alokasi_ruangan
        DB::table('alokasi_ruangan')->insert([
            'id_ruang' => $ruang->id_ruang,
            'id_prodi' => $prodi->id_prodi,
            'semester' => $periode->jenis,
            'tahun_ajaran' => $periode->tahun_mulai . '/' . $periode->tahun_selesai,
            'created_at' => now(),
        ]);
    
        // Update status ruangan menjadi 'diajukan'
        DB::table('ruangan')
            ->where('id_ruang', $ruang->id_ruang)
            ->update([
                'status' => 'diajukan',
            ]);
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Ruangan berhasil dialokasikan dan status diperbarui.');
    }
    
    
    public function cancelAlokasiRuang(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_ruang' => 'required|string|exists:ruangan,nama',
        ]);

        // Cari data ruangan berdasarkan nama
        $ruangan = DB::table('ruangan')->where('nama', $request->input('nama_ruang'))->first();

        if ($ruangan) {
            // Hapus data alokasi ruangan berdasarkan ID ruangan
            DB::table('alokasi_ruangan')->where('id_ruang', $ruangan->id_ruang)->delete();

            // Ubah status ruangan menjadi 'tersedia'
            DB::table('ruangan')->where('id_ruang', $ruangan->id_ruang)->update([
                'status' => 'tersedia',
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Alokasi ruangan berhasil dibatalkan dan status diperbarui.');
        }

        // Jika tidak menemukan ruangan, berikan pesan error
        return redirect()->back()->with('error', 'Ruangan tidak ditemukan.');
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
            return redirect()->back()->with('error', 'Ruangan dengan nama tersebut sudah ada.');
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
        return redirect()->back()->with('success', 'Ruangan baru berhasil ditambahkan.');
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

    public function updateRuang(Request $request)
    {
        $request->validate([
            'id_ruang' => 'required|exists:ruangan,id_ruang',
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);
    
        DB::table('ruangan')->where('id_ruang', $request->id_ruang)->update([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'updated_at' => now(),
        ]);
    
        return redirect()->route('bak_UpdateDeleteRuang')->with('success', 'Ruangan berhasil diperbarui.');
    }
       
      

    public function deleteRuang(Request $request)
    {
        DB::table('ruangan')->where('id_ruang', $request->id_ruang)->delete();
        return response()->json(['message' => 'Ruangan berhasil dihapus'], 200);
    }


}