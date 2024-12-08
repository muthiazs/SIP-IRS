<?php

namespace App\Http\Controllers;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalKuliah;
use App\Models\Dosen;
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
    
        // Ambil semua mata kuliah
        $namaMK = Matakuliah::all();
    
        // Ambil data ruangan yang sesuai dengan prodi kaprodi
        $ruangan = DB::table('alokasi_ruangan')
        ->join('ruangan', 'alokasi_ruangan.id_ruang', '=', 'ruangan.id_ruang')
        ->where('alokasi_ruangan.id_prodi', $kaprodi->prodi_id)
        ->select(
            'alokasi_ruangan.id_ruang',
            'ruangan.nama as nama_ruang',
        )
        ->get();
    
        // Ambil jadwal kuliah
        $jadwal = DB::table('jadwal_kuliah')
        ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        ->join('ruangan', 'jadwal_kuliah.id_ruang', '=', 'ruangan.id_ruang')
        ->select(
            'jadwal_kuliah.id_jadwal',
            'jadwal_kuliah.kode_matkul',
            'matakuliah.nama_matkul',
            'jadwal_kuliah.kelas',
            'matakuliah.semester',
            'jadwal_kuliah.hari',
            'ruangan.nama as nama_ruang',
            'jadwal_kuliah.jam_mulai',
            'jadwal_kuliah.jam_selesai'
        )
        ->get();

        // Ambil nama dosen
        $dosen = Dosen::where('prodi_id', $kaprodi->prodi_id)->get(); // Ambil dosen berdasarkan prodi_id kaprodi

        // Kirimkan data ke view
        return view('kaprodi_JadwalKuliah', compact('kaprodi', 'namaMK', 'ruangan', 'jadwal', 'dosen'));
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

    // Fungsi untuk menambah jadwal kuliah
    public function storeJadwalKuliah(Request $request)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|exists:matakuliah,kode_matkul', // Validasi kode_matkul
            'id_dosen' => 'required|exists:dosen,id', // Validasi dosen pengampu
            'id_ruang' => 'required|exists:ruangan,id_ruang', // Validasi ruangan
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat', // Validasi hari
            'jam_mulai' => 'required|date_format:H:i', // Validasi jam mulai
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Jam selesai harus setelah jam mulai
            'kelas' => 'required|in:A,B,C,D,E', // Validasi kelas
        ]);

        
    try {
        // Ambil data mata kuliah
        $matakuliah = Matakuliah::where('kode_matkul', $validated['kode_matkul'])->firstOrFail();
        $semester = $matakuliah->semester;

        // Tentukan id_periode
        $id_periode = $semester % 2 === 1 ? 24251 : 24252;

        // Ambil data ruangan
        $ruangan = DB::table('ruangan')->where('id_ruang', $validated['id_ruang'])->firstOrFail();

        // Insert ke tabel jadwal_kuliah
        DB::table('jadwal_kuliah')->insert([
            'kode_matkul' => $validated['kode_matkul'],
            'kuota' => $ruangan->kuota,
            'id_dosen' => $validated['id_dosen'],
            'id_ruang' => $validated['id_ruang'],
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'kelas' => $validated['kelas'],
            'semester' => $semester,
            'id_periode' => $id_periode,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

            return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function setMatkul()
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
        
        $mataKuliah = DB::table('matakuliah')
                        -> select(
                            'kode_matkul',
                            'nama_matkul',
                            'sks',
                            'semester'
                        )
                        -> get();
        return view('kaprodi_SetMatkul', compact('kaprodi', 'mataKuliah'));
    }

    public function UpdateDeleteMatkul()
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
        
        $mataKuliah = DB::table('matakuliah')
                        -> select(
                            'kode_matkul',
                            'nama_matkul',
                            'sks',
                            'semester'
                        )
                        -> get();
        return view('kaprodi_UpdateDeleteMatkul', compact('kaprodi', 'mataKuliah'));
    }

    public function indexCreateMatkul()
    {
        $kaprodi = DB::table('matakuliah')
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
        return view('kaprodi_CreateMatkul', compact('kaprodi'));
    }

    public function createMatkul(Request $request)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|string|max:50',
            'nama_matkul' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:8',
        ]);
    
        $cekMatkul = DB::table('matakuliah')->where('kode_matkul', $validated['kode_matkul'])->first();
    
        if ($cekMatkul) {
            return redirect()->back()->with('error', 'Kode mata kuliah sudah ada.');
        }
    
        DB::table('matakuliah')->insert([
            'kode_matkul' => $validated['kode_matkul'],
            'nama_matkul' => $validated['nama_matkul'],
            'sks' => $validated['sks'],
            'created_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Mata kuliah baru berhasil ditambahkan.');
    }    

    public function batalkanJadwal(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_jadwal' => 'required|integer|exists:kaprodi_JadwalKuliah,id_jadwal', // Validasi id_jadwal pada tabel kaprodi_JadwalKuliah
        ]);
    
        // Hapus jadwal berdasarkan id_jadwal
        JadwalKuliah::where('id_jadwal', $request->id_jadwal)->delete();
    
        // Redirect atau respon sukses
        return redirect()->back()->with('success', 'Jadwal kuliah berhasil dibatalkan.');
    }   

} 
