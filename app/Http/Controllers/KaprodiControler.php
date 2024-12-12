<?php

namespace App\Http\Controllers;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalKuliah;
use App\Models\Dosen;
use App\Models\PeriodeAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


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
                        ->where('dosen.id_user', '=', Auth::id())
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
            //     // Format tanggal menggunakan Carbon
            // if ($kaprodi) {
            //     $kaprodi->tanggal_mulai = \Carbon\Carbon::parse($kaprodi->tanggal_mulai)->format('Y-m-d');
            //     $kaprodi->tanggal_selesai = \Carbon\Carbon::parse($kaprodi->tanggal_selesai)->format('Y-m-d');
            // }

            // Ambil periode akademik terbaru berdasarkan id_periode
            $periodeTerbaru = DB::table('periode_akademik')
            ->orderBy('id_periode', 'DESC')
            ->first();

            // Pastikan periode akademik terbaru ditemukan
            if (!$periodeTerbaru) {
            return view('dashboardKaprodi', compact('kaprodi'));
            }

            // Mendapatkan tanggal saat ini
            $currentDate = now();

            // Ambil masa atur jadwal berdasarkan periode akademik terbaru dan rentang waktu
            $fetchPeriodeAturJadwal = DB::table('kalender_akademik')
                ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'kalender_akademik.id_periode')
                ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode) 
                ->where('kalender_akademik.kode_kegiatan', 'aturJadwal') 
                ->whereDate('kalender_akademik.tanggal_mulai', '<=', $currentDate->toDateString()) // Memastikan tanggal mulai tidak melebihi tanggal sekarang
                    ->whereDate('kalender_akademik.tanggal_selesai', '>=', $currentDate->toDateString()) // Memastikan tanggal selesai lebih besar dari atau sama dengan tanggal sekarang
                    ->select(
                        'kalender_akademik.tanggal_mulai', // Mengambil tanggal mulai
                        'kalender_akademik.tanggal_selesai', // Mengambil tanggal selesai
                        'kalender_akademik.nama_kegiatan' // Mengambil nama kegiatan
                    )
                    ->first(); // Mengambil hanya satu hasil yang sesuai dengan periode saat ini

            $masaAturJadwal = $fetchPeriodeAturJadwal ?? null;
                return view('dashboardKaprodi', compact('kaprodi','masaAturJadwal'));
    }

    public function JadwalKuliah()
    {
        // Ambil data kaprodi
        $kaprodi = DB::table('dosen')
            ->join('users', 'dosen.id_user', '=', 'users.id')
            ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
            ->crossJoin('periode_akademik')
            ->where('users.roles1', '=', 'dosen')
            ->where('users.roles2', '=', 'kaprodi')
            ->where('dosen.id_user', '=', Auth::id())
            ->orderBy('periode_akademik.created_at', 'desc')
            ->select(
                'dosen.nip',
                'dosen.nama as dosen_nama',
                'program_studi.nama as prodi_nama',
                'dosen.prodi_id',
                'users.username',
                'periode_akademik.nama_periode'
            )
            ->first();
        
        // Ambil mata kuliah berdasarkan prodi_id
        $namaMK = Matakuliah::where('id_prodi', $kaprodi->prodi_id)->get();
        
        // Ambil data ruangan yang sesuai dengan prodi kaprodi
        $ruangan = DB::table('alokasi_ruangan')
            ->join('ruangan', 'alokasi_ruangan.id_ruang', '=', 'ruangan.id_ruang')
            ->where('alokasi_ruangan.id_prodi', $kaprodi->prodi_id)
            ->select('alokasi_ruangan.id_ruang', 'ruangan.nama as nama_ruang')
            ->get();
        
        // Mengambil data periode akademik yang sedang berlangsung
        $Periode_sekarang = DB::table('periode_akademik')
            ->orderByDesc('id_periode')
            ->select('id_periode')
            ->first();
    
        // Cek apakah periode akademik ditemukan
        if (!$Periode_sekarang) {
            return redirect()->back()->with('error', 'Periode akademik tidak ditemukan.');
        }
    
        // Ambil jadwal kuliah
        $jadwal = DB::table('jadwal_kuliah')
            ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
            ->join('ruangan', 'jadwal_kuliah.id_ruang', '=', 'ruangan.id_ruang')
            ->join('periode_akademik', 'jadwal_kuliah.id_periode', '=', 'periode_akademik.id_periode')
            ->where('periode_akademik.id_periode', $Periode_sekarang->id_periode) // Menggunakan periode akademik yang sedang berlaku
            ->where('matakuliah.id_prodi', $kaprodi->prodi_id) // Filter berdasarkan prodi yang sedang login
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
    
        // Ambil nama dosen berdasarkan prodi_id
        $dosen = Dosen::where('prodi_id', $kaprodi->prodi_id)->get();
    
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
                        ->where('dosen.id_user', '=', Auth::id())
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

    // Fungsi untuk mengupdate jadwal kuliah

    public function updateMatakuliah(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'id_matkul' => 'required|exists:matakuliah,id_matkul',  // Validasi ID
                'kode_matkul' => 'required|string|max:255',  // Validasi kode mata kuliah
                'nama_matkul' => 'required|string|max:255',  // Validasi nama mata kuliah
                'sks' => 'required|integer|min:1',  // Validasi SKS
                'semester' => 'required|integer|min:1',  // Validasi semester
            ]);

            // $matakuliah = Matakuliah::find($request->id_matkul);
            // dd($matakuliah);

            // Update data di tabel 'matakuliah' menggunakan model
            DB::table('matakuliah')->where('id_matkul', $request->id_matkul)
                ->update([
                    'kode_matkul' => $request->kode_matkul,
                    'nama_matkul' => $request->nama_matkul,
                    'sks' => $request->sks,
                    'semester' => $request->semester,
                    'created_at' => now(),  // Update timestamp
                ]);
            
            // Redirect ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Berhasil!',
                'text' => 'Matkul berhasil diperbarui.',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui mata kuliah.');
        }
    }

    public function hapusMatkul(Request $request)
    {
        try {
            $request->validate([
                'id_matkul' => 'required|exists:matakuliah,id_matkul', // Validasi ID
            ]);

            DB::table('matakuliah')->where('id_matkul', $request->id_matkul)->delete();

            return redirect()->back()->with('sweetAlert', [
                'title' => 'Berhasil!',
                'text' => 'Matkul berhasil dihapus.',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus mata kuliah.');
        }
    }

        public function UpdateDeleteMatkul()
    {
        $kaprodi = DB::table('dosen')
                        ->join('users', 'dosen.id_user', '=', 'users.id')
                        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
                        ->crossJoin('periode_akademik')
                        ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
                        ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
                        ->where('dosen.id_user', '=', Auth::id())
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
                            'id_matkul',
                            'kode_matkul',
                            'nama_matkul',
                            'sks',
                            'semester',
                            'id_prodi'
                        )
                        ->where('mataKuliah.id_prodi','=',$kaprodi->prodi_id)
                        -> get();
                        // ->map(function($mk) {
                        //     // Cek constraint untuk setiap ruangan
                        //     $hasConstraint = DB::table('jadwal_kuliah')
                        //         ->where('id_ruang', $mk->id_matkul)
                        //         ->exists();
                            
                        //     $mk->hasConstraint = $hasConstraint;
                        //     return $mk;
                        // });

        // dd($mataKuliah);
        return view('kaprodi_UpdateDeleteMatkul', compact('kaprodi', 'mataKuliah'));
    }

    public function indexCreateMatkul()
    {
        $kaprodi = DB::table('dosen')
            ->join('users', 'dosen.id_user', '=', 'users.id')
            ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
            ->crossJoin('periode_akademik')
            ->where('users.roles1', '=', 'dosen') // Sesuaikan jika peran berbeda
            ->where('users.roles2', '=', 'kaprodi') // Sesuaikan jika peran berbeda
            ->where('dosen.id_user', '=', Auth::id())
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
    

    // public function createMatkul(Request $request)
    // {
    //     // Ambil id_prodi dari dosen yang sedang login
    //     $id_prodi = DB::table('dosen')
    //         ->where('id_user', Auth::id())
    //         ->value('prodi_id');
    
    //     // Jika id_prodi tidak ditemukan
    //     if (!$id_prodi) {
    //         return redirect()->back()->with('error', 'Prodi tidak ditemukan untuk dosen yang login.');
    //     }
    //     // Validasi input
    //     $request->validate([
    //         'kode_matkul' => 'required|string|max:50',
    //         'nama_matkul' => 'required|string|max:50',
    //         'sks' => 'required|integer|min:1|max:8',
    //         'semester' => 'required|integer|min:1|max:7',
    //     ]);
    
    //     // Cek jika kode mata kuliah sudah ada
    //     $cekMatkul = DB::table('matakuliah')
    //                 // ->where('id_prodi','=', $id_prodi)
    //                 ->where('kode_matkul', $request->kode_matkul)->first();
    
    //     if ($cekMatkul) {
    //         return redirect()->back()->with('error', 'Kode mata kuliah sudah ada.');
    //     }
    
    //     // Buat data mata kuliah
    //     Matakuliah::create([
    //         'kode_matkul' => $request->kode_matkul,
    //         'nama_matkul' => $request->nama_matkul,
    //         'sks' => $request->sks,
    //         'semester' => $request->semester,
    //         'id_prodi' => $id_prodi,
    //         'created_at' => now(),
    //     ]);
    
    //     // Redirect dengan SweetAlert
    //     return redirect()->back()->with('sweetAlert', [
    //         'title' => 'Berhasil!',
    //         'text' => 'Mata kuliah berhasil dibuat.',
    //         'icon' => 'success',
    //     ]);
    // }
     

    public function createMatkul(Request $request)
{
    // Ambil id_prodi dari dosen yang sedang login
    $id_prodi = DB::table('dosen')
        ->where('id_user', Auth::id())  // Mengambil id_user dari session login
        ->value('prodi_id');  // Mengambil prodi_id dari tabel dosen

    // Jika id_prodi tidak ditemukan, return error
    if (!$id_prodi) {
        return redirect()->back()->with('error', 'Prodi tidak ditemukan untuk dosen yang login.');
    }

    // Validasi input
    $request->validate([
        'kode_matkul' => 'required|string|max:50|unique:matakuliah,kode_matkul',  // Validasi agar kode_matkul unik
        'nama_matkul' => 'required|string|max:255',
        'sks' => 'required|integer|min:1|max:8',
        'semester' => 'nullable|integer|min:1|max:7',  // Semester bisa kosong
    ]);

    // Buat data mata kuliah dan simpan ke dalam tabel matakuliah
    Matakuliah::create([
        'kode_matkul' => $request->kode_matkul,
        'nama_matkul' => $request->nama_matkul,
        'sks' => $request->sks,
        'semester' => $request->semester,
        'id_prodi' => $id_prodi,
        'created_at' => now(),
        'updated_at' => now(), // Manually set updated_at
    ]);

    // Redirect dengan SweetAlert
    return redirect()->back()->with('sweetAlert', [
        'title' => 'Berhasil!',
        'text' => 'Mata kuliah berhasil dibuat.',
        'icon' => 'success',
    ]);
}


    public function indexCreateJadwal()
    {
        $kaprodi = DB::table('dosen')
            ->join('users', 'dosen.id_user', '=', 'users.id')
            ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
            ->crossJoin('periode_akademik')
            ->where('users.roles1', '=', 'dosen') // Pastikan ini sesuai dengan peran yang tepat
            ->where('users.roles2', '=', 'kaprodi') // Pastikan ini juga sesuai
            ->where('dosen.id_user', '=', Auth::id())
            ->orderBy('periode_akademik.created_at', 'desc') // Mengurutkan berdasarkan timestamp terbaru
            ->select('dosen.id_dosen',
                'dosen.nip',
                'dosen.nama as dosen_nama',
                'program_studi.nama as prodi_nama',
                'dosen.prodi_id',
                'users.username',
                'periode_akademik.nama_periode'
            )
            ->first();
    
        // Ambil mata kuliah berdasarkan prodi_id
        $namaMK = Matakuliah::where('id_prodi', $kaprodi->prodi_id)->get();
    
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
        ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'jadwal_kuliah.id_periode')
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
        return view('kaprodi_CreateJadwal', compact('kaprodi', 'namaMK', 'ruangan', 'jadwal', 'dosen'));
    }

    
    // public function createJadwal(Request $request)
    // {
    //     $validated = $request->validate([
    //         'kode_matkul' => 'required|exists:matakuliah,kode_matkul', // Validasi kode_matkul
    //         'id_dosen' => 'required|exists:dosen,id_dosen', // Validasi dosen pengampu
    //         'id_ruang' => 'required|exists:ruangan,id_ruang', // Validasi ruangan
    //         'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat', // Validasi hari
    //         'jam_mulai' => 'required|date_format:H:i', // Validasi jam mulai
    //         'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Jam selesai harus setelah jam mulai
    //         'kelas' => 'required|in:A,B,C,D,E', // Validasi kelas
    //     ]);

        
    // try {
    //     // Ambil data mata kuliah
    //     $matakuliah = Matakuliah::where('kode_matkul', $validated['kode_matkul'])->firstOrFail();
    //     $semester = $matakuliah->semester;

    //     // Tentukan id_periode
    //     $id_periode = $semester % 2 === 1 ? 24251 : 24252;

    //     // Ambil data ruangan
    //     $ruangan = DB::table('ruangan')->where('id_ruang', $validated['id_ruang'])->firstOrFail();

    //     // Insert ke tabel jadwal_kuliah
    //     DB::table('jadwal_kuliah')->insert([
    //         'kode_matkul' => $validated['kode_matkul'],
    //         'kuota' => $ruangan->kuota,
    //         'id_dosen' => $validated['id_dosen'],
    //         'id_ruang' => $validated['id_ruang'],
    //         'hari' => $validated['hari'],
    //         'jam_mulai' => $validated['jam_mulai'],
    //         'jam_selesai' => $validated['jam_selesai'],
    //         'kelas' => $validated['kelas'],
    //         'semester' => $semester,
    //         'id_periode' => $id_periode,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //         return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }


    public function createJadwal(Request $request)
    {
        try {
            // Ambil periode akademik terbaru
            $periodeAkademik = PeriodeAkademik::latest('id_periode')->first();
            if (!$periodeAkademik) {
                return response()->json(['success' => false, 'message' => 'Periode akademik tidak ditemukan.'], 404);
            }

            // Validasi input
            $request->validate([
                'namaMatakuliah' => 'required|string|exists:matakuliah,nama_matkul',
                'kelas' => 'required|in:A,B,C,D,E',
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
                'namaDosen' => 'required|string|exists:dosen,nama',
                'namaRuang' => 'required|string',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
                'kuota' => 'required|int'
            ]);

            // Mengambil data periode akademik yang sedang berlangsung
            $Periode_sekarang = DB::table('periode_akademik')
            ->orderByDesc('id_periode')
            ->select('jenis')
            ->first();

            // Cek apakah periode akademik ditemukan
            if (!$Periode_sekarang) {
                return redirect()->back()->with('error', 'Periode akademik tidak ditemukan.');
}

            // Cari data terkait berdasarkan input
            $matakuliah = Matakuliah::where('nama_matkul', $request->namaMatakuliah)
                ->when($Periode_sekarang->jenis == 'ganjil', function($query) {
                    return $query->whereRaw('matakuliah.semester % 2 != 0');
                })
                ->when($Periode_sekarang->jenis == 'genap', function($query) {
                    return $query->whereRaw('matakuliah.semester % 2 = 0');
                })
                ->first();
            $dosen = Dosen::where('nama', $request->namaDosen)->first();
            $ruangan = DB::table('alokasi_ruangan')
                ->join('ruangan', 'alokasi_ruangan.id_ruang', '=', 'ruangan.id_ruang')
                ->where('ruangan.nama', $request->namaRuang)
                ->select('ruangan.id_ruang', 'ruangan.nama as nama_ruang' , 'ruangan.kapasitas')
                ->first();

            if (!$ruangan) {
                return response()->json(['success' => false, 'message' => 'Ruangan tidak ditemukan untuk prodi yang sesuai.'], 404);
            }

            // Cek kuota tidak melebihi kapasitas ruangan
            if ($request->kuota > $ruangan->kapasitas) {
                return response()->json(['success' => false, 'message' => 'Kuota tidak boleh melebihi kapasitas ruangan.'], 400);
            }

            // Cek jika jadwal bertabrakan
            $isConflict = DB::table('jadwal_kuliah')
                ->where('id_ruang', $ruangan->id_ruang)
                ->where('hari', $request->hari)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                        ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
                })
                ->exists();

            if ($isConflict) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal bertabrakan dengan jadwal lain pada ruangan yang sama.',
                ], 409);
            }

            // Cek apakah jadwal dengan mata kuliah, kode mata kuliah, dan kelas sudah ada pada periode yang sama
            $existingJadwal = JadwalKuliah::where('kode_matkul', $matakuliah->kode_matkul)
                ->where('kelas', $request->kelas)
                ->where('id_periode', $periodeAkademik->id_periode)
                ->exists();

            if ($existingJadwal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal dengan mata kuliah dan kelas yang sama sudah ada pada periode ini.',
                ], 409);
            }

            // Simpan jadwal ke database
            JadwalKuliah::create([
                'kode_matkul' => $matakuliah->kode_matkul,
                'kuota' => $request->kuota,
                'id_dosen' => $dosen->id_dosen,
                'id_ruang' => $ruangan->id_ruang,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'kelas' => $request->kelas,
                'semester' => $matakuliah->semester,
                'id_periode' => $periodeAkademik->id_periode,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dibuat.',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }



    
    // public function updateJadwal(Request $request)
    // {
    //     try {
    //         // Validate the incoming request data
    //         $validated = $request->validate([
    //             'id_jadwal' => 'required|exists:jadwal,id_jadwal', 
    //             'kode_matkul' => 'required|string|max:255', 
    //             'nama_matkul' => 'required|string|max:255', 
    //             'kelas' => 'required|string|max:10',
    //             'nama_ruang' => 'required|string|max:255',
    //             'hari' => 'required|string|max:50',
    //             'jam_mulai' => 'required|date_format:H:i',
    //             'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    //         ]);
            
    
    //         // Find the jadwal by id_jadwal
    //         $jadwal = Jadwal::findOrFail($request->id_jadwal); 
    
    //         // Update the jadwal record using Eloquent
    //         $jadwal->update([
    //             'kode_matkul' => $request->kode_matkul,
    //             'nama_matkul' => $request->nama_matkul,
    //             'kelas' => $request->kelas,
    //             'nama_ruang' => $request->nama_ruang,
    //             'hari' => $request->hari,
    //             'jam_mulai' => $request->jam_mulai,
    //             'jam_selesai' => $request->jam_selesai,
    //         ]);
    
    //         // Return back with a success message
    //         return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    //     } catch (\Exception $e) {
    //         // Log the error for debugging purposes
    //         Log::error("Error updating jadwal: " . $e->getMessage());
    
    //         // Return back with an error message
    //         return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui jadwal.');
    //     }
    // }


    // public function updateJadwal(Request $request)
    // {
    //     try {
    //         // Validate the incoming request data
    //         $validated = $request->validate([
    //             'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal', 
    //             'kode_matkul' => 'required|string|max:255', 
    //             'nama_matkul' => 'required|string|max:255', 
    //             'kelas' => 'required|string|max:10',
    //             'nama_ruang' => 'required|string|max:255',
    //             'hari' => 'required|string|max:50',
    //             'jam_mulai' => 'required|date_format:H:i',
    //             'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    //         ]);
    
    //         // Debug: log input data
    //         Log::info($request->all());
    
    //         // Find the jadwal by id_jadwal
    //         $jadwal = JadwalKuliah::findOrFail($request->id_jadwal);
    
    //         // Update the jadwal record using Eloquent
    //         $jadwal->update([
    //             'kode_matkul' => $request->kode_matkul,
    //             'nama_matkul' => $request->nama_matkul,
    //             'kelas' => $request->kelas,
    //             'nama_ruang' => $request->nama_ruang,
    //             'hari' => $request->hari,
    //             'jam_mulai' => $request->jam_mulai,
    //             'jam_selesai' => $request->jam_selesai,
    //         ]);
    
    //         // Return back with a success message
    //         return response()->json([
    //             'success'=>true,
    //             'message'=> 'jadwal berhasil diperbarui',
    //             'data'=>$jadwal
    //         ]);
    //     } catch (\Exception $e) {
    //         // Log error dan respons kesalahan
    //         Log::error('Error updating jadwal: ' . $e->getMessage());
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat memperbarui jadwal.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    

    private function normalizeTime($time)
    {
        // Ensure time is in H:i format, adding a leading zero if necessary
        return date('H:i', strtotime($time));
    }

    public function updateJadwal(Request $request)
    {
        try {
            // Normalize the time format to ensure it's in H:i format
            $request->merge([
                'jam_mulai' => $this->normalizeTime($request->jam_mulai),
                'jam_selesai' => $this->normalizeTime($request->jam_selesai),
            ]);
            // Validasi input
            $validated = $request->validate([
                'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal',
                'kelas' => 'required|string|max:10',
                'nama_ruang' => 'required|string|max:255',
                'hari' => 'required|string|max:50',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            ]);
    
            // Temukan jadwal berdasarkan id_jadwal
            $jadwal = JadwalKuliah::findOrFail($request->id_jadwal);
    
            // Format jam_mulai dan jam_selesai menggunakan Carbon
            $jam_mulai = Carbon::createFromFormat('H:i', $request->jam_mulai)->format('H:i');
            $jam_selesai = Carbon::createFromFormat('H:i', $request->jam_selesai)->format('H:i');
    
            // Perbarui data jadwal
            $jadwal->update([
                'kelas' => $request->kelas,
                'hari' => $request->hari,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'nama_ruang' => $request->nama_ruang,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'updated_at' => now(),  // Update timestamp
            ]);

        // Redirect with success message
        return redirect()->back()->with('sweetAlert', [
            'title' => 'Berhasil!',
            'text' => 'Jadwal berhasil diperbarui.',
            'icon' => 'success'
        ]);
    } catch (\Exception $e) {
        // Handle any errors
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui jadwal.');
    }
}



    public function batalkanJadwal(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal', // Validate ID exists in the jadwal_kuliah table
            ]);
    
            // Cancel the jadwal by deleting it
            JadwalKuliah::where('id_jadwal', $request->id_jadwal)->delete();
    
            // Return back with a success message
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Berhasil!',
                'text' => 'Jadwal kuliah berhasil dibatalkan.',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
          
    
            // Return back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membatalkan jadwal.');
        }
    }
    






}