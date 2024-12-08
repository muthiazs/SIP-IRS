<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            ->where('pegawai.id_user', Auth::id())
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
            ->where('pegawai.id_user', Auth::id())
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
    // In BAK_PembagianruangController.php
    public function storeRuang(Request $request)
    {
        $request->validate([
            'prodi' => 'required|string|exists:program_studi,nama',
            'nama_ruang' => 'required|string|exists:ruangan,nama',
        ]);
    
        // Ambil data ruangan berdasarkan nama
        $ruang = DB::table('ruangan')->where('nama', $request->nama_ruang)->first();
        
        // Ambil data program studi berdasarkan nama
        $prodi = DB::table('program_studi')->where('nama', $request->prodi)->first();
        
        // Ambil data periode akademik terbaru
        $periode = DB::table('periode_akademik')->orderBy('id_periode', 'desc')->first();
    
        // Validasi data terkait
        if (!$ruang || !$prodi || !$periode) {
            $response = [
                'title' => 'Error!',
                'text' => 'Data tidak valid. Pastikan semua input benar.',
                'icon' => 'error'
            ];
    
            if ($request->ajax()) {
                return response()->json(['sweetAlert' => $response]);
            }
            return redirect()->back()->with('sweetAlert', $response);
        }
    
        try {
            // Simpan data ke tabel alokasi_ruangan
            DB::table('alokasi_ruangan')->insert([
                'id_ruang' => $ruang->id_ruang,
                'id_prodi' => $prodi->id_prodi,
                'semester' => $periode->jenis,
                'tahun_ajaran' => date('Y', strtotime($periode->tahun_mulai)) . '/' . date('Y', strtotime($periode->tahun_selesai)),
                'created_at' => now(),
            ]);
    
            // Update status ruangan menjadi 'diajukan'
            DB::table('ruangan')
                ->where('id_ruang', $ruang->id_ruang)
                ->update([
                    'status' => 'diajukan',
                ]);
    
            $response = [
                'title' => 'Berhasil!',
                'text' => 'Ruangan berhasil dialokasikan ke ' . $request->prodi,
                'icon' => 'success'
            ];
    
            if ($request->ajax()) {
                return response()->json(['sweetAlert' => $response]);
            }
            return redirect()->back()->with('sweetAlert', $response);
    
        } catch (\Exception $e) {
            $response = [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan saat mengalokasikan ruangan.',
                'icon' => 'error'
            ];
    
            if ($request->ajax()) {
                return response()->json(['sweetAlert' => $response]);
            }
            return redirect()->back()->with('sweetAlert', $response);
        }
    }
    
    
public function cancelAlokasiRuang(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_ruang' => 'required|string|exists:ruangan,nama',
    ]);

    try {
        // Cari data ruangan berdasarkan nama
        $ruangan = DB::table('ruangan')->where('nama', $request->input('nama_ruang'))->first();

        if (!$ruangan) {
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Error!',
                'text' => 'Ruangan tidak ditemukan.',
                'icon' => 'error'
            ]);
        }

        // Hapus data alokasi ruangan berdasarkan ID ruangan
        DB::table('alokasi_ruangan')->where('id_ruang', $ruangan->id_ruang)->delete();

        // Ubah status ruangan menjadi 'tersedia'
        DB::table('ruangan')->where('id_ruang', $ruangan->id_ruang)->update([
            'status' => 'tersedia',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('sweetAlert', [
            'title' => 'Berhasil!',
            'text' => 'Alokasi ruangan berhasil dibatalkan.',
            'icon' => 'success'
        ]);

    } catch (\Exception $e) {
        return redirect()->back()->with('sweetAlert', [
            'title' => 'Error!',
            'text' => 'Terjadi kesalahan saat membatalkan alokasi ruangan.',
            'icon' => 'error'
        ]);
    }
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
                        ->where('pegawai.id_user', Auth::id())
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
        try {
            // Validasi data
            $cekRuangan = DB::table('ruangan')
                ->where('nama', $request->nama)
                ->first();
    
            if ($cekRuangan) {
                return redirect()->back()->with('sweetAlert', [
                    'title' => 'Error!',
                    'text' => 'Ruangan dengan nama tersebut sudah ada.',
                    'icon' => 'error'
                ]);
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
    
            // Redirect dengan pesan sukses
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Berhasil!',
                'text' => 'Ruangan baru berhasil ditambahkan.',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan saat menambahkan ruangan.',
                'icon' => 'error'
            ]);
        }
    }

    public function indexUpdateDeleteRuang()
    {
        $tabelRuang = DB::table('ruangan')
            ->select(
                'ruangan.nama',
                'ruangan.kapasitas',
                'ruangan.id_ruang'
            )
            ->get();
            // ->map(function($ruang) {
            //     // Cek constraint untuk setiap ruangan
            //     $hasConstraint = DB::table('jadwal_kuliah')
            //         ->where('id_ruang', $ruang->id_ruang)
            //         ->exists() || 
            //         DB::table('alokasi_ruangan')
            //         ->where('id_ruang', $ruang->id_ruang)
            //         ->exists();
                
            //     $ruang->hasConstraint = $hasConstraint;
            //     return $ruang;
            // });
    
        $akademik = DB::table('pegawai')
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->crossJoin('periode_akademik')
            ->where('pegawai.id_user', Auth::id())
            ->orderBy('periode_akademik.created_at', 'desc')
            ->select(
                'pegawai.nama',
                'pegawai.nip',
                'periode_akademik.nama_periode'
            )
            ->first();
    
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
                        ->where('pegawai.id_user', Auth::id())
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
        try {
            $request->validate([
                'id_ruang' => 'required|exists:ruangan,id_ruang',
                'nama' => 'required|string|max:255',
                'kapasitas' => 'required|integer|min:1',
            ]);
    
            DB::table('ruangan')
                ->where('id_ruang', $request->id_ruang)
                ->update([
                    'nama' => $request->nama,
                    'kapasitas' => $request->kapasitas,
                    'created_at' => now(),
                ]);
            
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Berhasil!',
                'text' => 'Ruangan berhasil diperbarui.',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan saat memperbarui ruangan.',
                'icon' => 'error'
            ]);
        }
    }
    
    public function deleteRuang(Request $request)
{
    try {
        // Log ID ruang yang akan dihapus
        Log::info('Attempting to delete room:', ['id_ruang' => $request->id_ruang]);

        // Cek di tabel alokasi_ruangan
        $alokasiCount = DB::table('alokasi_ruangan')
            ->where('id_ruang', $request->id_ruang)
            ->count();
        Log::info('Related records in alokasi_ruangan:', ['count' => $alokasiCount]);

        // Tampilkan detail ruangan yang akan dihapus
        $ruangan = DB::table('ruangan')
            ->where('id_ruang', $request->id_ruang)
            ->first();
        Log::info('Room details:', ['ruangan' => $ruangan]);

        // Coba hapus dengan transaction dan log setiap step
        DB::transaction(function() use ($request) {
            Log::info('Starting delete transaction');

            // Hapus dari alokasi_ruangan
            $deletedAlokasi = DB::table('alokasi_ruangan')
                ->where('id_ruang', $request->id_ruang)
                ->delete();
            Log::info('Deleted from alokasi_ruangan:', ['count' => $deletedAlokasi]);

            // Hapus ruangan
            $deletedRuang = DB::table('ruangan')
                ->where('id_ruang', $request->id_ruang)
                ->delete();
            Log::info('Deleted from ruangan:', ['count' => $deletedRuang]);
        });

        return redirect()->back()->with('sweetAlert', [
            'title' => 'Berhasil!',
            'text' => 'Ruangan berhasil dihapus.',
            'icon' => 'success'
        ]);
    } catch (\Exception $e) {
        // Log detail error
        Log::error('Error deleting room:', [
            'id_ruang' => $request->id_ruang,
            'error_message' => $e->getMessage(),
            'error_code' => $e->getCode(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'stack_trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->with('sweetAlert', [
            'title' => 'Error!',
            'text' => 'Terjadi kesalahan saat menghapus ruangan: ' . $e->getMessage(),
            'icon' => 'error'
        ]);
    }
}
}