<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IRS; 
use Barryvdh\DomPDF\Facade\Pdf;

class DosenController extends Controller
{
    public function index(Request $request)
{
    $searchTerm = $request->input('search', '');
    $statusFilter = $request->input('status', 'all');

    // Fetch students based on search term and status filter
    $usulanIRS = IRS::query()
        ->when($searchTerm, function ($query) use ($searchTerm) {
            return $query->where('nama_mahasiswa', 'like', '%' . $searchTerm . '%');
        })
        ->when($statusFilter !== 'all', function ($query) use ($statusFilter) {
            return $query->where('status_terakhir', $statusFilter);
        })
        ->get();

    return view('dosen.index', compact('usulanIRS'));
}
public function usulanIRSMahasiswa()
{
    // Ambil data dosen yang sedang login
    $dosen = DB::table('dosen')
        ->join('users', 'dosen.id_user', '=', 'users.id')
        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
        ->crossJoin('periode_akademik')
        ->orderBy('periode_akademik.created_at', 'desc')
        ->where('dosen.id_user', auth()->id())
        ->select(
            'dosen.nip',
            'dosen.nama as dosen_nama',
            'program_studi.nama as prodi_nama',
            'dosen.prodi_id',
            'periode_akademik.nama_periode'
        )
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

    // Ambil list mahasiswa dengan usulan IRS yang bukan draft dan semester aktif sesuai
    $usulanIRS = DB::table('irs')
        ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
        ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
        ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
        ->where('mahasiswa.id_dosen', auth()->user()->id) // Filter mahasiswa berdasarkan dosen wali
        ->where('irs.status', '!=', 'draft') // Pastikan status IRS bukan draft
        ->whereIn('irs.semester', function($query) {
            $query->select('semester')
                ->from('mahasiswa')
                ->whereColumn('mahasiswa.nim', 'irs.nim'); // Pastikan semester IRS sesuai dengan semester mahasiswa
        })
        ->select(
            'mahasiswa.nim',
            'mahasiswa.nama as nama_mahasiswa',
            'mahasiswa.angkatan',
            'program_studi.nama as prodi_nama',
            DB::raw('COUNT(irs.id_irs) as total_usulan'),
            DB::raw('MAX(irs.status) as status_terakhir')
        )
        ->groupBy(
            'mahasiswa.nim', 
            'mahasiswa.nama', 
            'mahasiswa.angkatan', 
            'program_studi.nama'
        )
        ->get();

    return view('dosen_irsMahasiswa', compact('dosen', 'usulanIRS','masaIRS', 'fetchPeriodeSetujuIRS'));
}


public function detailIRS($nim)
{
    // Ambil data dosen yang sedang login
    $dosen = DB::table('dosen')
        ->join('users', 'dosen.id_user', '=', 'users.id')
        ->join('program_studi', 'dosen.prodi_id', '=', 'program_studi.id_prodi')
        ->where('dosen.id_user', auth()->id())
        ->select(
            'dosen.nip',
            'dosen.nama as dosen_nama',
            'program_studi.nama as prodi_nama',
            'dosen.prodi_id'
        )
        ->first();

    // Ambil data mahasiswa berdasarkan NIM
    $mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();

    // Pastikan mahasiswa yang diambil adalah mahasiswa yang dibimbing oleh dosen yang sedang login
    if ($mahasiswa->id_dosen != auth()->user()->id) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke IRS mahasiswa ini.');
    }

    // Ambil IRS mahasiswa
    $irs = DB::table('irs')
        ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
        ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
        ->join('ruangan', 'jadwal_kuliah.id_ruang', '=', 'ruangan.id_ruang')
        ->where('irs.nim', $nim)
        ->where('irs.status', '!=', 'draft') // Pastikan status IRS bukan draft
        ->whereIn('irs.semester', function($query) {
            $query->select('semester')
                ->from('mahasiswa')
                ->whereColumn('mahasiswa.nim', 'irs.nim'); // Pastikan semester IRS sesuai dengan semester mahasiswa
        })
        ->select(
            'jadwal_kuliah.kode_matkul as kode',
            'matakuliah.nama_matkul as mata_kuliah',
            'jadwal_kuliah.kelas',
            'matakuliah.sks',
            'ruangan.nama as ruang',
            'irs.status'
        )
        ->get();

    return view('dosen_detailIRSMahasiswa', compact('dosen', 'mahasiswa', 'irs'));
}

    //untuk setujui irs 
    public function approveIRS($nim)
{
    // Cari data mahasiswa berdasarkan NIM
    $mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
    }

    // Pastikan mahasiswa yang diambil adalah yang dibimbing oleh dosen yang sedang login
    if ($mahasiswa->id_dosen != auth()->user()->id) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menyetujui IRS mahasiswa ini.');
    }

    // Cari IRS berdasarkan mahasiswa dan pastikan semester IRS sesuai dengan semester mahasiswa
    $irs = DB::table('irs')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'irs.nim')
        ->where('irs.nim', $mahasiswa->nim)
        ->where('irs.status', '!=', 'draft')  // Pastikan status IRS bukan draft
        ->whereIn('irs.semester', function($query) use ($mahasiswa) {
            $query->select('semester')
                ->from('mahasiswa')
                ->where('mahasiswa.nim', $mahasiswa->nim);  // Pastikan semester IRS sesuai dengan semester mahasiswa
        })
        ->first();

    if (!$irs) {
        return redirect()->back()->with('error', 'Data IRS tidak ditemukan atau semester IRS tidak sesuai dengan semester mahasiswa.');
    }

    // Update status IRS menjadi disetujui
    DB::table('irs')
        ->where('nim', $irs->nim)
        ->where('semester', $irs->semester)  // Pastikan semester sesuai
        ->update(['status' => 'disetujui']);

    return redirect()->back()->with('success', 'Status IRS berhasil disetujui.');
}

    
    //untuk batal persetujuian irs 
    public function cancelApprovalIRS($nim)
    {
        // Cari data mahasiswa berdasarkan NIM
        $mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();
    
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }
    
        // Pastikan mahasiswa yang diambil adalah yang dibimbing oleh dosen yang sedang login
        if ($mahasiswa->id_dosen != auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membatalkan persetujuan IRS mahasiswa ini.');
        }
    
        // Cari IRS berdasarkan mahasiswa dan pastikan semester IRS sesuai dengan semester mahasiswa
        $irs = DB::table('irs')
            ->join('mahasiswa', 'mahasiswa.nim', '=', 'irs.nim')
            ->where('irs.nim', $mahasiswa->nim)
            ->where('irs.status', 'disetujui')  // Pastikan IRS yang dipilih sudah disetujui
            ->whereIn('irs.semester', function($query) use ($mahasiswa) {
                $query->select('semester')
                    ->from('mahasiswa')
                    ->where('mahasiswa.nim', $mahasiswa->nim);  // Pastikan semester IRS sesuai dengan semester mahasiswa
            })
            ->first();
    
        if (!$irs) {
            return redirect()->back()->with('error', 'Data IRS tidak ditemukan atau semester IRS tidak sesuai dengan semester mahasiswa.');
        }
    
        // Batalkan persetujuan IRS dengan mengubah status menjadi draft
        DB::table('irs')
            ->where('nim', $irs->nim)
            ->where('semester', $irs->semester)  // Pastikan semester sesuai
            ->update(['status' => 'draft']);
    
        return redirect()->back()->with('success', 'Persetujuan IRS berhasil dibatalkan.');
    }
    
    // Method untuk mencetak IRS mahasiswa dalam format PDF
    public function printIRSPDF($nim)
{
    // Cari data mahasiswa berdasarkan NIM
    $mahasiswa = DB::table('mahasiswa')
        ->join('program_studi as prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
        ->where('nim', $nim)
        ->select(
            'prodi.nama as nama_prodi',
            'mahasiswa.nim',
            'mahasiswa.nama as nama',
            'mahasiswa.id_dosen'  // Pastikan kolom id_dosen juga dipilih
        )
        ->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
    }

    // Ambil data dosen yang sedang login
    $dosen = auth()->user(); // Pastikan ini adalah dosen yang sedang login



   // Ambil data IRS mahasiswa untuk semester tertentu
   $irs = DB::table('irs')
   ->join('jadwal_kuliah', 'jadwal_kuliah.id_jadwal', '=', 'irs.id_jadwal')
   ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
   ->join('ruangan', 'ruangan.id_ruang', '=', 'jadwal_kuliah.id_ruang')
   ->join('mahasiswa as mhs', 'irs.nim', '=', 'mhs.nim')
   ->join('dosen', 'dosen.id_dosen' , '=' , 'jadwal_kuliah.id_dosen')
   ->where('irs.nim', $mahasiswa->nim)
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

    if ($irs->isEmpty()) {
        return redirect()->back()->with('error', 'Data IRS mahasiswa ini tidak ditemukan.');
    }

    // Ambil data pembimbing
    $pembimbing = DB::table('dosen')
        ->where('id_dosen', $mahasiswa->id_dosen)  // Gunakan id_dosen untuk mencocokkan dengan dosen
        ->select('dosen.nama as nama_pembimbing', 'dosen.nip as nip')
        ->first();

    // Generate PDF dari view IRSFullPDF.blade.php
    $pdf = PDF::loadView('IRSFullPDF', compact('mahasiswa', 'irs', 'pembimbing'));

    // Unduh PDF
    return $pdf->download('irs_mahasiswa_' . $nim . '.pdf');
}


public function approveSelectedIRS(Request $request)
{
    // Validasi input
    $request->validate([
        'nim' => 'required|array|min:1',  // Pastikan ada NIM yang dipilih
        'nim.*' => 'exists:mahasiswa,nim', // Pastikan NIM valid
    ]);

    $nimList = $request->nim;

    // Proses update status IRS menjadi 'disetujui' untuk setiap NIM
    foreach ($nimList as $nim) {
        $mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();

        if (!$mahasiswa || $mahasiswa->id_dosen != auth()->user()->id) {
            return response()->json(['error' => 'Akses tidak sah atau data mahasiswa tidak ditemukan'], 403);
        }

        // Perbarui status IRS menjadi 'disetujui'
        DB::table('irs')
            ->where('nim', $nim)
            ->where('status', '!=', 'disetujui')  // Pastikan hanya IRS yang belum disetujui yang diubah
            ->update(['status' => 'disetujui']);
    }

    return response()->json(['success' => 'IRS yang dipilih berhasil disetujui']);
}


}
        

