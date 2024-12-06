<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan DB di-import
use App\Models\IRS; // Model untuk tabel IRS
use App\Models\JadwalKuliah; // Model untuk tabel jadwal kuliah
use App\Models\PeriodeAkademik;  // Add this line to import the PeriodeAkademik model
use App\Models\Mahasiswa;  // Add this line to import the PeriodeAkademik model
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;



class Mhs_PengisianIRSController extends Controller
{
    public function indexPilihJadwal()
    {
        // Mengambil data periode akademik yang sedang berlangsung
        $Periode_sekarang = DB::table('periode_akademik')
            ->orderByDesc('id_periode')
            ->select('jenis')
            ->first();

        // Cek apakah periode akademik ditemukan
        if (!$Periode_sekarang) {
            return redirect()->back()->with('error', 'Periode akademik tidak ditemukan.');
        }

        // Fetch jadwal kuliah berdasarkan periode
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
            'jadwal_kuliah.id_jadwal',
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
            DB::raw('(SELECT COUNT(*) FROM irs WHERE irs.id_jadwal = jadwal_kuliah.id_jadwal) as kuota_terisi')
        )
        ->get();

        // Mengambil data mahasiswa yang sedang login
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

        // Cek apakah data mahasiswa ditemukan
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Menambahkan pengecekan status untuk setiap jadwal kuliah
    $jadwalStatus = [];
    foreach ($jadwalKuliah as $jadwal) {
        // Cek apakah jadwal ini sudah diambil dengan status draft
        $sudahDiambilJadwal = $this->cekStatusPengambilan($jadwal->id_jadwal);

        // Cek apakah mata kuliah ini sudah ada di IRS dengan status draft
        $sudahDiambilMatkul = DB::table('irs')
            ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
            ->where('irs.nim', $mahasiswa->nim)
            ->where('jadwal_kuliah.kode_matkul', $jadwal->kode_matkul)
            ->where('irs.status', 'draft')
            ->exists();


            // Simpan status
            $jadwalStatus[$jadwal->id_jadwal] = [
                'sudah_diambil_jadwal' => $sudahDiambilJadwal,
                'sudah_diambil_matkul' => $sudahDiambilMatkul,
            ];
        }

        return view('mhs_pengisianIRS', compact('Periode_sekarang', 'jadwalKuliah', 'mahasiswa', 'jadwalStatus'));
    }

    public function konfirmasiIRS(Request $request)
    {
        try {
            // Ambil data mahasiswa yang sedang login
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
    
            // Cek apakah data mahasiswa ditemukan
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }
    
            // Update semua IRS dengan status 'draft' milik mahasiswa tersebut
            $updatedRows = IRS::where('nim', $mahasiswa->nim)
                               ->where('status', 'draft')
                               ->update(['status' => 'belum disetujui']);
    
            // Cek apakah ada data yang diupdate
            if ($updatedRows > 0) {
                return redirect()->route('mhs_draftIRS')->with('success', 'Berhasil mengonfirmasi IRS. Menunggu persetujuan.');
            } else {
                return redirect()->route('mhs_draftIRS')->with('warning', 'Tidak ada IRS draft yang perlu dikonfirmasi.');
            }
        } catch (\Exception $e) {
            // Tangani error
            return redirect()->route('mhs_draftIRS')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    


    public function rencanaStudi()
    {
        // Ambil data mahasiswa yang sedang login
        $mahasiswa = DB::table('mahasiswa')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
            ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
            ->crossJoin('periode_akademik')
            ->where('mahasiswa.id_user', auth()->id())
            ->select(
                'mahasiswa.nim',
                'mahasiswa.nama as nama_mhs',
                'mahasiswa.semester',
                'program_studi.nama as prodi_nama',
                'dosen.nama as nama_doswal',
                'dosen.nip',
                'users.username',
                'periode_akademik.nama_periode'
            )
            ->first();
    
        // Cek apakah data mahasiswa ditemukan
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }
    
        // Ambil IRS mahasiswa
        $irsRiwayat = DB::table('irs')
            ->join('jadwal_kuliah', 'jadwal_kuliah.id_jadwal', '=', 'irs.id_jadwal')
            ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
            ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
            ->join('mahasiswa as mhs', 'irs.nim', '=', 'mhs.nim') // Gunakan alias `mhs`
            ->where('irs.nim', $mahasiswa->nim)
            ->whereIn('irs.status', ['belum disetujui', 'disetujui', 'draft', 'BARU'])
            ->select(
                'jadwal_kuliah.kode_matkul',
                'matakuliah.nama_matkul',
                'jadwal_kuliah.semester as semester',
                'irs.semester as smtIRS',
                'mhs.semester as smtMhs', // Gunakan alias untuk menghindari konflik
                'jadwal_kuliah.kelas',
                'matakuliah.sks',
                'ruangan.nama as ruang',
                'jadwal_kuliah.hari',
                'jadwal_kuliah.jam_mulai',
                'jadwal_kuliah.jam_selesai',
                'jadwal_kuliah.kuota',
                'jadwal_kuliah.id_jadwal',
                'irs.status'
            )
            ->get();
    
        // Kelompokkan data IRS berdasarkan semester IRS
        // $irsPerSemester = [];
        // foreach ($irsRiwayat as $irs) {
        //     $irsPerSemester[$irs->smtIRS][] = $irs;
        // }
        // $irsPerSemester = $irsRiwayat->groupBy('smtIRS');
    
        // Ambil semua semester mahasiswa untuk accordion flush
        $semesters = range(1, $mahasiswa->semester); // Buat range dari semester 1 hingga semester mahasiswa saat ini
    
        // Ambil status terakhir IRS jika ada
        // Kelompokkan data IRS berdasarkan semester IRS
        $irsPerSemester = [];
        $statusTerakhirPerSemester = []; // Tambahkan array untuk status per semester
        foreach ($irsRiwayat as $irs) {
            $irsPerSemester[$irs->smtIRS][] = $irs;

            // Cek status terakhir untuk setiap semester
            if (!isset($statusTerakhirPerSemester[$irs->smtIRS])) {
                $statusTerakhirPerSemester[$irs->smtIRS] = $irs->status;
            }
        }
    
        return view('mhs_rrencanaStudi', compact('mahasiswa', 'irsPerSemester', 'statusTerakhirPerSemester', 'semesters'));
    }
    public function cetak_pdf($semester)
    {
        // Debug semester untuk memastikan nilai semester yang diterima
        Log::info('Mencetak PDF untuk semester: ', ['semester' => $semester]);
    
        // Ambil data mahasiswa yang sedang login
        $mahasiswa = DB::table('mahasiswa')
            ->join('program_studi as prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
            ->where('mahasiswa.id_user', auth()->id())
            ->select('prodi.nama as nama_prodi', 'mahasiswa.nim', 'mahasiswa.nama as nama')
            ->first();
    
        // Cek apakah data mahasiswa ditemukan
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }
    
        Log::info('Data Mahasiswa:', ['nim' => $mahasiswa->nim, 'nama' => $mahasiswa->nama]);
    
        // Ambil data IRS mahasiswa untuk semester tertentu
        DB::enableQueryLog();
    
        $semester = (int)$semester; // Pastikan semester adalah integer
        $irsCetak = DB::table('irs')
            ->join('jadwal_kuliah', 'jadwal_kuliah.id_jadwal', '=', 'irs.id_jadwal')
            ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
            ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
            ->join('mahasiswa as mhs', 'irs.nim', '=', 'mhs.nim')
            ->join('dosen', 'dosen.id_dosen', '=', 'jadwal_kuliah.id_dosen')
            ->where('irs.nim', $mahasiswa->nim)
            ->where('irs.semester', $semester)
            ->whereIn('irs.status', ['belum disetujui', 'disetujui', 'draft', 'BARU'])
            ->select(
                'matakuliah.kode_matkul',
                'matakuliah.nama_matkul',
                'jadwal_kuliah.semester',
                'jadwal_kuliah.kelas',
                'matakuliah.sks',
                'ruangan.nama as ruang',
                'irs.status',
                'dosen.nama as nama_dosen'
            )
            ->get();
    
        Log::info('Query IRS untuk Semester ' . $semester . ':', ['query' => DB::getQueryLog(), 'irsCetak' => $irsCetak]);
    
        // Jika data IRS kosong, tampilkan pesan kesalahan
        if ($irsCetak->isEmpty()) {
            return redirect()->back()->with('error', 'Data IRS tidak ditemukan untuk semester ' . $semester);
        }
    
        // Ambil data pembimbing dosen
        $pembimbing = DB::table('dosen')
            ->join('mahasiswa', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
            ->select('dosen.nama as nama_pembimbing', 'dosen.nip as nip')
            ->first();
    
        // Membuat nama file PDF
        $fileName = 'irs-' . $mahasiswa->nim . '-semester-' . $semester . '.pdf';
    
        // Simpan file PDF ke direktori penyimpanan
        $filePath = storage_path('app/public/' . $fileName);
        $pdf = PDF::loadView('irs_pdf', [
            'irs' => $irsCetak,
            'mahasiswa' => $mahasiswa,
            'pembimbing' => $pembimbing,
            'semester' => $semester
        ]);
    
        // Simpan file PDF
        $pdf->save($filePath);
    
        // Cek apakah file berhasil disimpan
        if (!file_exists($filePath)) {
            Log::error('File PDF tidak ditemukan setelah penyimpanan.', ['file' => $filePath]);
            return redirect()->back()->with('error', 'Gagal menyimpan file PDF.');
        } else {
            Log::info('File PDF berhasil disimpan di: ', ['file' => $filePath]);
        }
    
        // Return PDF sebagai file download
        return response()->download($filePath);
    }
    
    

    // public function ambilJadwal(Request $request)
    // {
    //     $periodeAkademik = PeriodeAkademik::latest('id_periode')->first();
    
    //     if (!$periodeAkademik) {
    //         return redirect()->back()->with('error', 'Periode akademik tidak ditemukan.');
    //     }
    
    //     $mahasiswa = Mahasiswa::where('id_user', auth()->id())->first();
    //     if (!$mahasiswa) {
    //         return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    //     }
    
    //     $request->validate([
    //         'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal',
    //         'status' => 'required|string|max:255',
    //     ]);
    
    //     IRS::create([
    //         'nim' => $mahasiswa->nim,
    //         'semester' => $mahasiswa->semester,
    //         'id_jadwal' => $request->id_jadwal,
    //         'status' => $request->status,
    //     ]);
    
    //     return redirect()->route('mhs_pengisianIRS')->with('success', 'Jadwal berhasil diambil.');
    // }



    public function cekStatusPengambilan($id_jadwal)
{
    $mahasiswa = Mahasiswa::where('id_user', auth()->id())->first();

    if ($mahasiswa) {
        return IRS::where('nim', $mahasiswa->nim)
                  ->where('id_jadwal', $id_jadwal)
                  ->where('status', 'draft') // Pastikan hanya status draft yang dicek
                  ->exists();
    }

    return false;
}



    public function ambilJadwal(Request $request)
{
    try {
        $periodeAkademik = PeriodeAkademik::latest('id_periode')->first();
        if (!$periodeAkademik) {
            return response()->json(['success' => false, 'message' => 'Periode akademik tidak ditemukan.'], 404);
        }

        $mahasiswa = Mahasiswa::where('id_user', auth()->id())->first();
        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.'], 404);
        }

        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal',
            'status' => 'required|string|max:255',
        ]);

        // Check for scheduling conflicts
        $isConflict = $this->cekJadwalBertabrakan($mahasiswa->nim, $request->id_jadwal);
        if ($isConflict) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal yang Anda pilih bertabrakan dengan jadwal yang sudah diambil.',
            ], 409); // Conflict status code
        }

        // Insert the schedule into IRS
        IRS::create([
            'nim' => $mahasiswa->nim,
            'semester' => $mahasiswa->semester,
            'id_jadwal' => $request->id_jadwal,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diambil',
        ]);
    } catch (\Exception $e) {
        // Log the exception for debugging purposes
        Log::error("Error in ambilJadwal: " . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

// Method to check if the student's schedule conflicts with an existing one
private function cekJadwalBertabrakan($nim, $id_jadwal)
{
    $selectedJadwal = DB::table('jadwal_kuliah')
        ->where('id_jadwal', $id_jadwal)
        ->first();

    if (!$selectedJadwal) {
        return false; // Jadwal tidak ditemukan
    }

    // ... (other checks for capacity and quota)

    $existingJadwal = DB::table('irs')
        ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
        ->where('irs.nim', $nim)
        ->where('jadwal_kuliah.hari', $selectedJadwal->hari)
        ->select('jadwal_kuliah.jam_mulai', 'jadwal_kuliah.jam_selesai')
        ->get();

    foreach ($existingJadwal as $jadwal) {
        // Convert time strings to timestamps for comparison
        $selectedJadwalStart = strtotime($selectedJadwal->jam_mulai);
        $selectedJadwalEnd = strtotime($selectedJadwal->jam_selesai);
        $existingJadwalStart = strtotime($jadwal->jam_mulai);
        $existingJadwalEnd = strtotime($jadwal->jam_selesai);

        // Check for overlap
        if (
            ($selectedJadwalStart >= $existingJadwalStart && $selectedJadwalStart < $existingJadwalEnd) ||
            ($selectedJadwalEnd > $existingJadwalStart && $selectedJadwalEnd <= $existingJadwalEnd)
        ) {
            return true; // Jadwal bertabrakan
        }
    }

    return false; // Tidak ada konflik jadwal
}



private function hitungMaxSks($ipsLalu)
{
    if ($ipsLalu >= 0 && $ipsLalu <= 1) {
        return 15;  // Maksimal 15 SKS
    } elseif ($ipsLalu > 1 && $ipsLalu <= 2.5) {
        return 18;  // Maksimal 18 SKS
    } elseif ($ipsLalu > 2.5 && $ipsLalu <= 3.5) {
        return 21;  // Maksimal 21 SKS
    } elseif ($ipsLalu > 3.5 && $ipsLalu <= 4) {
        return 24;  // Maksimal 24 SKS
    } else {
        return 0;  // Tidak valid
    }
}

public function batalkanJadwal(Request $request)
{
    $mahasiswa = Mahasiswa::where('id_user', auth()->id())->first();
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }
    // Validasi input
    $request->validate([
        'id_irs' => 'required|integer|exists:irs,id_irs',
    ]);

    // Hapus record berdasarkan id_irs
    IRS::where('id_irs', $request->id_irs)
        ->where('nim', $mahasiswa->nim)
        ->where('id_jadwal', $request->id_jadwal)           
        ->delete();

    // Redirect atau respon sukses
    return redirect()->back()->with('success', 'Jadwal berhasil dibatalkan.');
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

        $rancanganIRSSementara = DB::table('irs')
        ->join('jadwal_kuliah', 'jadwal_kuliah.id_jadwal', '=', 'irs.id_jadwal')
        ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'irs.nim')
        ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
        ->where('mahasiswa.id_user', auth()->id())
        ->where('irs.status', 'draft')
        ->select(
            'jadwal_kuliah.kode_matkul',
            'matakuliah.nama_matkul',
            'jadwal_kuliah.semester',
            'jadwal_kuliah.kelas',
            'matakuliah.sks', // Hapus jika kolom ini tidak ada
            'ruangan.nama',
            'jadwal_kuliah.hari',
            'jadwal_kuliah.jam_mulai',
            'jadwal_kuliah.jam_selesai',
            'jadwal_kuliah.kuota',
            'jadwal_kuliah.id_jadwal',
            'irs.id_irs'
        )
        ->get();

    return view('mhs_draftIRS', compact('mahasiswa', 'rancanganIRSSementara'));
}
        public function newIRS()
        {
            // Ambil periode akademik terbaru berdasarkan id_periode
                $periodeTerbaru = DB::table('periode_akademik')
                ->orderBy('id_periode', 'DESC') // Mengambil periode akademik berdasarkan id_periode terbaru
                ->first();
            // dump($periodeTerbaru);

            // Pastikan periode akademik terbaru ditemukan
            if (!$periodeTerbaru) {
                return view('dashboardMahasiswa', compact('mahasiswa', 'masaIRS'));
            }

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

            // Pass both daftarMk and mahasiswa data to the view
            return view('mhs_newIRS', compact('mahasiswa','fetchPeriodeISIIRS'));
        }

        public function rrencanaStudi()
        {
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

            // Pass both daftarMk and mahasiswa data to the view
            return view('mhs_rrencanaStudi', compact('mahasiswa'));
        }        

}