<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan DB di-import
use App\Models\IRS; // Model untuk tabel IRS
use App\Models\JadwalKuliah; // Model untuk tabel jadwal kuliah
use App\Models\PeriodeAkademik;  // Add this line to import the PeriodeAkademik model
use App\Models\Mahasiswa;  // Add this line to import the PeriodeAkademik model
use App\Models\Matakuliah;
use App\Models\ProgressMahasiswa;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\Cast\Double;

class Mhs_PengisianIRSController extends Controller
{
    //VERSI YANG ADA TOTALSKS DLL 
    // public function indexPilihJadwal(Request $request)
    // {
    //     // Mengambil data periode akademik yang sedang berlangsung
    //     $Periode_sekarang = DB::table('periode_akademik')
    //         ->orderByDesc('id_periode')
    //         ->select('jenis')
    //         ->first();

    //     // Cek apakah periode akademik ditemukan
    //     if (!$Periode_sekarang) {
    //         return redirect()->back()->with('error', 'Periode akademik tidak ditemukan.');
    //     }

    //     // Fetch jadwal kuliah berdasarkan periode
    //     $jadwalKuliah = DB::table('jadwal_kuliah')
    //     ->join('matakuliah', 'matakuliah.kode_matkul', '=', 'jadwal_kuliah.kode_matkul')
    //     ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
    //     ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'jadwal_kuliah.id_periode')
    //     ->when($Periode_sekarang->jenis == 'ganjil', function($query) {
    //         return $query->whereRaw('matakuliah.semester % 2 != 0');
    //     })
    //     ->when($Periode_sekarang->jenis == 'genap', function($query) {
    //         return $query->whereRaw('matakuliah.semester % 2 = 0');
    //     })
    //     ->orderBy('matakuliah.semester')
    //     ->orderBy('matakuliah.nama_matkul')
    //     ->select(
    //         'jadwal_kuliah.id_jadwal',
    //         'matakuliah.kode_matkul as kode_matkul',
    //         'matakuliah.nama_matkul',
    //         'jadwal_kuliah.kelas',
    //         'matakuliah.semester',
    //         'matakuliah.sks',
    //         'ruangan.nama as namaruang',
    //         'jadwal_kuliah.hari',
    //         'jadwal_kuliah.jam_mulai',
    //         'jadwal_kuliah.jam_selesai',
    //         'jadwal_kuliah.kuota',
    //         DB::raw('(SELECT COUNT(*) FROM irs WHERE irs.id_jadwal = jadwal_kuliah.id_jadwal) as kuota_terisi')
    //     )
    //     ->get();

        // // Ambil SKS mata kuliah yang akan dipilih
        // $sksMatkul = JadwalKuliah::join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        //     ->where('jadwal_kuliah.id_jadwal', $request->id_jadwal)
        //     ->value('matakuliah.sks');
        // // Mengambil data mahasiswa yang sedang login
        // $mahasiswa = DB::table('mahasiswa')
        //     ->join('users', 'mahasiswa.id_user', '=', 'users.id')
        //     ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
        //     ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
        //     ->join('progress_mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'progress_mahasiswa.id_mahasiswa')
        //     ->crossJoin('periode_akademik')
        //     ->where('mahasiswa.id_user', auth()->id())
        //     ->select(
        //         'mahasiswa.nim',
        //         'mahasiswa.nama as nama_mhs',
        //         'program_studi.nama as prodi_nama',
        //         'dosen.nama as nama_doswal',
        //         'dosen.nip',
        //         'users.username',
        //         'periode_akademik.nama_periode',
        //         'progress_mahasiswa.semester_studi',
        //         'progress_mahasiswa.IPs_lalu'
        //     )
        //     ->first();

        // // Cek apakah data mahasiswa ditemukan
        // if (!$mahasiswa) {
        //     return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        // }

        // // Hitung maksimal SKS berdasarkan ips
        // $maksimalSKS = $this->hitungMaksimalSKS(
        //     $mahasiswa->semester_studi, 
        //     $mahasiswa->IPs_lalu
        // );

        // // Hitung total SKS yang sudah dipilih
        // $totalSKSTerpilih = DB::table('irs')
        // ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
        // ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        // ->where('irs.nim', $mahasiswa->nim)
        // ->where('irs.status', 'draft')
        // ->sum('matakuliah.sks');

        // // Menambahkan pengecekan status untuk setiap jadwal kuliah
        // $jadwalStatus = [];
        // foreach ($jadwalKuliah as $jadwal) {
        //     // Cek apakah jadwal ini sudah diambil dengan status draft
        //     $sudahDiambilJadwal = $this->cekStatusPengambilan($jadwal->id_jadwal);

        // // Cek apakah mata kuliah ini sudah ada di IRS dengan status draft
        // $sudahDiambilMatkul = DB::table('irs')
        //     ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
        //     ->where('irs.nim', $mahasiswa->nim)
        //     ->where('jadwal_kuliah.kode_matkul', $jadwal->kode_matkul)
        //     ->where('irs.status', 'draft')
        //     ->exists();


        //     // Simpan status
        //     $jadwalStatus[$jadwal->id_jadwal] = [
        //         'sudah_diambil_jadwal' => $sudahDiambilJadwal,
        //         'sudah_diambil_matkul' => $sudahDiambilMatkul,
        //     ];
        // }



        // return view('mhs_pengisianIRS', compact('Periode_sekarang', 'jadwalKuliah', 'mahasiswa', 'jadwalStatus','maksimalSKS','totalSKSTerpilih','sksMatkul'));
    // }


    //VERSI SEMENTARA BUAT NYELESEIN FITUR DI DOSEN 
    public function indexPilihJadwal(Request $request)
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

    // Ambil SKS mata kuliah yang akan dipilih
    $sksMatkul = JadwalKuliah::join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        ->where('jadwal_kuliah.id_jadwal', $request->id_jadwal)
        ->value('matakuliah.sks');

    // Mengambil data mahasiswa yang sedang login
    $mahasiswa = DB::table('mahasiswa')
        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
        ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
        ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
        ->join('progress_mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'progress_mahasiswa.id_mahasiswa')
        ->crossJoin('periode_akademik')
        ->where('mahasiswa.id_user', auth()->id())
        ->select(
            'mahasiswa.id_mahasiswa', // Return the id_mahasiswa
            'mahasiswa.nim',
            'mahasiswa.nama as nama_mhs',
            'program_studi.nama as prodi_nama',
            'dosen.nama as nama_doswal',
            'dosen.nip',
            'users.username',
            'periode_akademik.nama_periode',
            'progress_mahasiswa.semester_studi',
            'progress_mahasiswa.IPs_lalu'
        )
        ->first();

    // Cek apakah data mahasiswa ditemukan
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    // Hitung maksimal SKS berdasarkan id_mahasiswa
    $maksimalSKS = $this->hitungMaksimalSKS($mahasiswa->id_mahasiswa); // Pass the id_mahasiswa

    // Hitung total SKS yang sudah dipilih
    $totalSKSTerpilih = DB::table('irs')
        ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
        ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        ->where('irs.nim', $mahasiswa->nim)
        ->where('irs.status', 'draft')
        ->sum('matakuliah.sks');

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

    return view('mhs_pengisianIRS', compact('Periode_sekarang', 'jadwalKuliah', 'mahasiswa', 'jadwalStatus','maksimalSKS','totalSKSTerpilih','sksMatkul'));
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



//VERSI ADA TOTAL DLL
// public function ambilJadwal(Request $request)
// {
//     try {
//         // 1. Dapatkan periode akademik terbaru
//         $periodeAkademik = PeriodeAkademik::latest('id_periode')->first();
//         if (!$periodeAkademik) {
//             return response()->json(['success' => false, 'message' => 'Periode akademik tidak ditemukan.'], 404);
//         }
//         dump($periodeAkademik);

//         // 2. Cari data mahasiswa berdasarkan ID pengguna yang login
//         $mahasiswa = Mahasiswa::where('id_user', auth()->id())->first();
//         if (!$mahasiswa) {
//             return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.'], 404);
//         }
//         dump($mahasiswa);

//         // 3. Validasi input request
//         $request->validate([
//             'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal',
//             'status' => 'required|string|max:255',
//         ]);

//         // 4. Periksa apakah jadwal bertabrakan dengan jadwal yang sudah diambil
//         if ($this->cekJadwalBertabrakan($mahasiswa->nim, $request->id_jadwal)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Jadwal yang Anda pilih bertabrakan dengan jadwal yang sudah diambil.',
//             ], 409);
//         }

//         // // 5. Hitung maksimal SKS berdasarkan IPS sebelumnya
//         // $maksimalSKS = $this->hitungMaksimalSKS($mahasiswa->semester_studi, $mahasiswa->IPs_lalu);

//         // // 6. Hitung total SKS yang sudah dipilih
//         // $totalSKSTerpilih = IRS::join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
//         //     ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
//         //     ->where('irs.nim', $mahasiswa->nim)
//         //     ->where('irs.status', 'draft')
//         //     ->sum('matakuliah.sks');

//         // 7. Fetch jadwal kuliah dan SKS-nya
//         $jadwalKuliah = JadwalKuliah::join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
//             ->where('jadwal_kuliah.id_jadwal', $request->id_jadwal)
//             ->select('jadwal_kuliah.*', 'matakuliah.sks')
//             ->first();

//         if (!$jadwalKuliah) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Jadwal kuliah tidak ditemukan atau data bermasalah.',
//             ], 404);
//         }

//         // // 8. Ambil jumlah SKS mata kuliah yang ingin diambil
//         // $sksMatkul = $jadwalKuliah->sks;



//         // Log::info('Debug SKS', [
//         //     'sksMatkul' => $sksMatkul,  // Tambahkan log untuk current_sks
//         // ]);

        

//         // // 9. Validasi apakah total SKS melebihi batas
//         // if ($totalSKSTerpilih + $sksMatkul > $maksimalSKS) {
//         //     return response()->json([
//         //         'success' => false,
//         //         'message' => "Anda hanya diperbolehkan mengambil maksimal {$maksimalSKS} SKS berdasarkan IPS Anda. Total SKS saat ini: {$totalSKSTerpilih}, SKS yang akan diambil: {$sksMatkul}",
//         //     ], 400);
//         // }

//         // 10. Masukkan jadwal ke IRS
//         IRS::create([
//             'nim' => $mahasiswa->nim,
//             'semester' => $mahasiswa->semester_studi,
//             'id_jadwal' => $request->id_jadwal,
//             'status' => $request->status,
//         ]);

//         // 11. Berikan respons berhasil
//         return response()->json([
//             'success' => true,
//             'message' => 'Jadwal berhasil diambil.',
//         ]);
//     } catch (\Exception $e) {
//         // 12. Log error untuk debugging
//         Log::error("Error in ambilJadwal: " . $e->getMessage());

//         // 13. Berikan respons kesalahan server
//         return response()->json([
//             'success' => false,
//             'message' => 'Terjadi kesalahan pada server. Silakan coba lagi.',
//         ], 500);
//     }

//         // Mengambil data dari form atau request
//         // $maksimalSKS = $request->input('maksimalSKS');
//         // $totalSKSTerpilih = $request->input('totalSKSTerpilih');
//         // $sksMatkul = $request->input('sksMatkul');

//         // Lakukan logika lain jika perlu

//         // Mengirimkan data ke view setelah form diproses
//         // return view('mhs_pengisianIRS', [
//         //     'maksimalSKS' => $maksimalSKS,
//         //     'totalSKSTerpilih' => $totalSKSTerpilih,
//         //     'sksMatkul' => $sksMatkul
//         // ]);
// }

public function ambilJadwal(Request $request)
{
    try {
        $periodeAkademik = PeriodeAkademik::latest('id_periode')->first();
        if (!$periodeAkademik) {
            return response()->json(['success' => false, 'message' => 'Periode akademik tidak ditemukan.'], 404);
        }

        $mahasiswa = Mahasiswa::where('id_user', auth()->id())->first();
        Log::debug('Mahasiswa ID:', ['id_mahasiswa' => $mahasiswa->id_mahasiswa]);
        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.'], 404);
        }

        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal',
            'status' => 'required|string|max:255',
        ]);

        $isConflict = $this->cekJadwalBertabrakan($mahasiswa->nim, $request->id_jadwal);
        if ($isConflict) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal yang Anda pilih bertabrakan dengan jadwal yang sudah diambil.',
            ], 409);
        }

        $totalSKS = IRS::with('jadwalKuliah.matakuliah')
            ->where('nim', $mahasiswa->nim)
            ->where('semester', $mahasiswa->semester)
            ->get()
            ->sum(function ($irs) {
                return $irs->jadwalKuliah->matakuliah->sks ?? 0;
        });

        Log::info('Total SKS yang sudah diambil:', ['total_sks' => $totalSKS]);

        $jadwal = JadwalKuliah::with('matakuliah')->find($request->id_jadwal);
        $sksBaru = $jadwal->matakuliah->sks ?? 0;

        // Tangkap hasil dari hitungMaksimalSKS
        $maksimalSKS = $this->hitungMaksimalSKS($mahasiswa->id_mahasiswa);

        if (($totalSKS + $sksBaru) > $maksimalSKS) {
            return response()->json([
                'success' => false,
                'message' => 'Total SKS yang diambil melebihi batas maksimal SKS (' . $maksimalSKS . ').',
            ], 400);
        }

        IRS::create([
            'nim' => $mahasiswa->nim,
            'semester' => $mahasiswa->semester,
            'id_jadwal' => $request->id_jadwal,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diambil.',
            'total_sks' => $totalSKS + $sksBaru,
        ]);
    } catch (\Exception $e) {
        Log::error("Error in ambilJadwal: " . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}





// //VERSI SEMENTARA BUAT MUTHIA NGERJAIN FITUR LAIN
// public function ambilJadwal(Request $request)
// {
//     try {
//         // 1. Dapatkan periode akademik terbaru
//         $periodeAkademik = PeriodeAkademik::latest('id_periode')->first();
//         if (!$periodeAkademik) {
//             return response()->json(['success' => false, 'message' => 'Periode akademik tidak ditemukan.'], 404);
//         }

//         // 2. Cari data mahasiswa berdasarkan ID pengguna yang login
//         $mahasiswa = Mahasiswa::where('id_user', auth()->id())->first();
//         if (!$mahasiswa) {
//             return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.'], 404);
//         }

//         // 3. Validasi input request
//         $request->validate([
//             'id_jadwal' => 'required|exists:jadwal_kuliah,id_jadwal',
//             'status' => 'required|string|max:255',
//         ]);

//         // Check for scheduling conflicts
//         $isConflict = $this->cekJadwalBertabrakan($mahasiswa->nim, $request->id_jadwal);
//         if ($isConflict) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Jadwal yang Anda pilih bertabrakan dengan jadwal yang sudah diambil.',
//             ], 409); // Conflict status code
//         }

//         // Insert the schedule into IRS
//         IRS::create([
//             'nim' => $mahasiswa->nim,
//             'semester' => $mahasiswa->semester,
//             'id_jadwal' => $request->id_jadwal,
//             'status' => $request->status,
//         ]);

//         return response()->json([
//             'success' => true,
//             'message' => 'Jadwal berhasil diambil',
//         ]);
//     } catch (\Exception $e) {
//         // Log the exception for debugging purposes
//         Log::error("Error in ambilJadwal: " . $e->getMessage());

//         return response()->json([
//             'success' => false,
//             'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
//         ], 500);
//     }
// }





//Method to check if the student's schedule conflicts with an existing one
private function cekJadwalBertabrakan($nim, $id_jadwal)
{
    $selectedJadwal = DB::table('jadwal_kuliah')
        ->where('id_jadwal', $id_jadwal)
        ->first();

    if (!$selectedJadwal) {
        return false; // Jadwal tidak ditemukan
    }

    // Ambil semester mahasiswa saat ini berdasarkan NIM
    $semesterMahasiswa = DB::table('mahasiswa')
        ->where('nim', $nim)
        ->value('semester');

    if (!$semesterMahasiswa) {
        return false; // Mahasiswa tidak ditemukan
    }

    // Ambil jadwal IRS yang hanya semester sama dengan mahasiswa saat ini
    $existingJadwal = DB::table('irs')
        ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
        ->where('irs.nim', $nim)
        ->where('irs.semester', $semesterMahasiswa) // Hanya IRS semester saat ini
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



// public function hitungMaksimalSKS($semester_studi, $IPs_lalu)
// {
//     // Log untuk memeriksa nilai semester_studi dan IPs_lalu
//     Log::debug('Debugging hitungMaksimalSKS', [
//         'semester_studi' => $semester_studi,
//         'IPs_lalu' => $IPs_lalu,
//     ]);

//     if ($semester_studi == 1 || $semester_studi == 2) {
//         // Aturan untuk semester pertama dan kedua
//         if ($IPs_lalu < 2.00) {
//             Log::debug('Semester 1 or 2 with IPS < 2.00, returning 18 SKS');
//             return 18; // Jika IPS kurang dari 2, maksimal 18 SKS
//         } else {
//             Log::debug('Semester 1 or 2 with IPS >= 2.00, returning 20 SKS');
//             return 20; // Jika IPS >= 2.00, maksimal 20 SKS
//         }
//     } elseif ($semester_studi >= 3) {
//         // Aturan untuk semester ketiga dan seterusnya
//         if ($IPs_lalu < 2.00) {
//             Log::debug('Semester >= 3 with IPS < 2.00, returning 18 SKS');
//             return 18; // IPS < 2, maksimal 18 SKS
//         } elseif ($IPs_lalu >= 2.00 && $IPs_lalu <= 2.49) {
//             Log::debug('Semester >= 3 with IPS between 2.00 and 2.49, returning 20 SKS');
//             return 20; // IPS antara 2.00 - 2.49, maksimal 20 SKS
//         } elseif ($IPs_lalu >= 2.50 && $IPs_lalu <= 2.99) {
//             Log::debug('Semester >= 3 with IPS between 2.50 and 2.99, returning 22 SKS');
//             return 22; // IPS antara 2.50 - 2.99, maksimal 22 SKS
//         } else {
//             Log::debug('Semester >= 3 with IPS >= 3.00, returning 24 SKS');
//             return 24; // IPS >= 3.00, maksimal 24 SKS
//         }
//     }

//     // Default jika tidak ada aturan yang sesuai
//     Log::debug('No matching condition, returning 0 SKS');
//     return 0;
// }


public function hitungMaksimalSKS($id_mahasiswa)
{
    // Fetch the mahasiswa record with its progress
    $mahasiswa = Mahasiswa::with('progressMahasiswa')->find($id_mahasiswa);
    Log::debug('progress data found for mahasiswa with id: ' . $id_mahasiswa);

    if (!$mahasiswa || $mahasiswa->progressMahasiswa->isEmpty()) {
        Log::debug('No progress data found for mahasiswa with id: ' . $id_mahasiswa);
        return 0;  // Return a default value or handle error
    }

    // Get the first progress record
    $progress = $mahasiswa->progressMahasiswa->first(); 

    // Get semester_studi and IPs_lalu from the progress record
    $semester_studi = $progress->semester_studi;
    $IPs_lalu = $progress->IPs_lalu;

    // Debugging output
    Log::debug('Debugging hitungMaksimalSKS', [
        'semester_studi' => $semester_studi,  // Now using the correct variable
        'IPs_lalu' => $IPs_lalu,  // Now using the correct variable
    ]);

    // Logic for calculating the maximal SKS based on the semester and IPS
    if ($semester_studi == 1 || $semester_studi == 2) {
        // Aturan untuk semester pertama dan kedua
        if ($IPs_lalu < 2.00) {
            Log::debug('Semester 1 or 2 with IPS < 2.00, returning 18 SKS');
            return 18; // Jika IPS kurang dari 2, maksimal 18 SKS
        } else {
            Log::debug('Semester 1 or 2 with IPS >= 2.00, returning 20 SKS');
            return 20; // Jika IPS >= 2.00, maksimal 20 SKS
        }
    } elseif ($semester_studi >= 3) {
        // Aturan untuk semester ketiga dan seterusnya
        if ($IPs_lalu < 2.00) {
            Log::debug('Semester >= 3 with IPS < 2.00, returning 18 SKS');
            return 18; // IPS < 2, maksimal 18 SKS
        } elseif ($IPs_lalu >= 2.00 && $IPs_lalu <= 2.49) {
            Log::debug('Semester >= 3 with IPS between 2.00 and 2.49, returning 20 SKS');
            return 20; // IPS antara 2.00 - 2.49, maksimal 20 SKS
        } elseif ($IPs_lalu >= 2.50 && $IPs_lalu <= 2.99) {
            Log::debug('Semester >= 3 with IPS between 2.50 and 2.99, returning 22 SKS');
            return 22; // IPS antara 2.50 - 2.99, maksimal 22 SKS
        } else {
            Log::debug('Semester >= 3 with IPS >= 3.00, returning 24 SKS');
            return 24; // IPS >= 3.00, maksimal 24 SKS
        }
    }

    // Default jika tidak ada aturan yang sesuai
    Log::debug('No matching condition, returning 0 SKS');
    return 0;
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
            $mahasiswa = DB::table('mahasiswa')
                ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
                ->join('dosen', 'mahasiswa.id_dosen', '=', 'dosen.id_dosen')
                ->join('progress_mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'progress_mahasiswa.id_mahasiswa')
                ->crossJoin('periode_akademik')
                ->where('mahasiswa.id_user', auth()->id())
                ->select(
                    'mahasiswa.nim',
                    'mahasiswa.nama as nama_mhs',
                    'program_studi.nama as prodi_nama',
                    'dosen.nama as nama_doswal',
                    'dosen.nip',
                    'users.username',
                    'periode_akademik.nama_periode',
                    'progress_mahasiswa.semester_studi',
                    'progress_mahasiswa.IPs_lalu'
                )
                ->first();
        
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }
        
            // Hitung maksimal SKS berdasarkan IPS
            $maksimalSKS = $this->hitungMaksimalSKS($mahasiswa->semester_studi, $mahasiswa->IPs_lalu);
        
            // Hitung total SKS yang sudah dipilih
            $totalSKSTerpilih = DB::table('irs')
                ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
                ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
                ->where('irs.nim', $mahasiswa->nim)
                ->where('irs.status', 'draft')
                ->sum('matakuliah.sks');
        
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
                    'matakuliah.sks',
                    'ruangan.nama',
                    'jadwal_kuliah.hari',
                    'jadwal_kuliah.jam_mulai',
                    'jadwal_kuliah.jam_selesai',
                    'jadwal_kuliah.kuota',
                    'jadwal_kuliah.id_jadwal',
                    'irs.id_irs'
                )
                ->get();
        
            // Ambil masa IRS berdasarkan periode terbaru
            $periodeTerbaru = DB::table('periode_akademik')->orderBy('id_periode', 'DESC')->first();
            $fetchPeriodeISIIRS = DB::table('kalender_akademik')
                ->where('id_periode', $periodeTerbaru->id_periode)
                ->where('kode_kegiatan', 'isiIRS')
                ->select('tanggal_mulai', 'tanggal_selesai')
                ->first();
        
            // Tentukan apakah periode aktif
            $isPeriodeAktif = false;
            if ($fetchPeriodeISIIRS) {
                $tanggalSekarang = now();
                $isPeriodeAktif = $tanggalSekarang->between(
                    $fetchPeriodeISIIRS->tanggal_mulai,
                    $fetchPeriodeISIIRS->tanggal_selesai);
            }
        
            // Kirim data ke view
            return view('mhs_draftIRS', compact('mahasiswa', 'rancanganIRSSementara', 'maksimalSKS', 'totalSKSTerpilih', 'isPeriodeAktif'));
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