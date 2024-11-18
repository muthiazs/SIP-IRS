<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan DB di-import

class Mhs_PengisianIRSController extends Controller
{
    public function indexPilihJadwal()
    {
        // Ngambil Periode 
        $Periode_sekarang = DB::table('periode_akademik')
            ->orderByRaw('periode_akademik.created_at desc')
            ->select('periode_akademik.jenis')
            ->first();
    
        // Pastikan ada data yang ditemukan untuk periode_sekarang
        if (!$Periode_sekarang) {
            return redirect()->back()->with('error', 'Periode akademik tidak ditemukan.');
        }
    
        // Fetch daftar matkul (list of courses)
        $jadwalKuliah = DB::table('jadwal_kuliah')
            ->join('matakuliah', 'matakuliah.kode_matkul', '=', 'jadwal_kuliah.kode_matkul')
            ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
            ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'jadwal_kuliah.id_periode')
            ->when($Periode_sekarang->jenis == 'ganjil', function($query) {
                return $query->whereRaw('matakuliah.semester % 2 != 0');
            })
            ->when($Periode_sekarang->jenis == 'genap', function($query) {
                return $query->whereRaw('matakuliah.semester % 2 = 0');
            })
            ->orderBy('matakuliah.semester')
            ->orderBy('matakuliah.nama_matkul')
            ->select(
                'matakuliah.kode_matkul as kode_matkul',
                'matakuliah.nama_matkul',
                'jadwal_kuliah.kelas',
                'matakuliah.semester',
                'matakuliah.sks',
                'ruangan.nama as namaruang',
                'jadwal_kuliah.hari',
                'jadwal_kuliah.jam_mulai',
                'jadwal_kuliah.jam_selesai',
                'jadwal_kuliah.kuota',
            )
            ->get();
    
        // Fetch mahasiswa data
        $mahasiswa = DB::table('mahasiswa')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
            ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
            ->crossJoin('periode_akademik')
            ->where('mahasiswa.id_user', auth()->id())
            ->select(
                'mahasiswa.nim',
                'mahasiswa.nama as nama_mhs',
                'program_studi.nama as prodi_nama',
                'dosen.nama as nama_doswal',
                'dosen.nip',
                'users.username',
                'periode_akademik.nama_periode'
            )
            ->first();
    
        return view('mhs_pengisianIRS', compact('Periode_sekarang','jadwalKuliah', 'mahasiswa'));  // Pass data to the view
    }
    

    // public function indexPengisianIRS()
    // {
    //     $data = [
    //         'mahasiswa' => [
    //             'name' => 'Draco Lucius Malfoy',
    //             'nim' => '24060122130071',
    //             'program_studi' => 'S1 Informatika'
    //         ],
    //         'user' => [
    //             'name' => 'Bill Gates',
    //             'nip' => '198203092006041002'
    //         ],
    //         'semester' => [
    //             'current' => '2024/2025 Ganjil',
    //             'period' => '1 Mar - 2 April'
    //         ],
    //         'stats' => [
    //             'semester' => 5,
    //             'ipk' => '3.6/4.0',
    //             'sksk' => 86
    //         ],
    //         'status' => [
    //             'irs' => 'ditolak',
    //             'registrasi' => true
    //         ],
    //         'pengisianirs' => [
    //             'maxbeban' => 24,
    //             'total' => 0
    //         ]
    //     ];
        
    //     return view('mhs_pengisianIRS', compact('data'));  // Gunakan dot notation
    // }


    public function indexDaftarMatkul()
    {
        // Fetch daftar matkul (list of courses)
        $daftarMk = DB::table('matakuliah')
            ->select('kode_matkul', 'nama_matkul', 'semester', 'sks')
            ->get();
        
        // Fetch mahasiswa data
        $mahasiswa = DB::table('mahasiswa')
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
        
            // Pass both daftarMk and mahasiswa data to the view
        return view('mhs_daftarMatkul', compact('daftarMk', 'mahasiswa'));
        }    

        public function periodeHabis()
        {
                // Fetch mahasiswa data
            $mahasiswa = DB::table('mahasiswa')
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

            // Pass both daftarMk and mahasiswa data to the view
            return view('mhs_habisPeriodeIRS', compact('mahasiswa'));
        }

        public function draftIRS()
        {
                // Fetch mahasiswa data
            $mahasiswa = DB::table('mahasiswa')
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

            // Pass both daftarMk and mahasiswa data to the view
            return view('mhs_draftIRS', compact('mahasiswa'));
        }

        public function newIRS()
        {
                // Fetch mahasiswa data
            $mahasiswa = DB::table('mahasiswa')
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

            // Pass both daftarMk and mahasiswa data to the view
            return view('mhs_newIRS', compact('mahasiswa'));
        }

        
        

}