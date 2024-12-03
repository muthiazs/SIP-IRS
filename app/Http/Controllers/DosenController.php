<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IRS; 

class DosenController extends Controller
{
    public function usulanIRSMahasiswa()
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
    
        // Ambil list mahasiswa dengan usulan IRS yang bukan draft
        $usulanIRS = DB::table('irs')
            ->join('mahasiswa', 'irs.nim', '=', 'mahasiswa.nim')
            ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
            ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
            ->join('program_studi', 'mahasiswa.id_prodi', '=', 'program_studi.id_prodi')
            ->where('mahasiswa.id_dosen', auth()->user()->id) // Filter mahasiswa berdasarkan dosen wali
            ->where('irs.status', '!=', 'draft')
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
    
        return view('dosen_irsMahasiswa', compact('dosen', 'usulanIRS'));
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

        // Ambil IRS mahasiswa
        $irs = DB::table('irs')
            ->join('jadwal_kuliah', 'irs.id_jadwal', '=', 'jadwal_kuliah.id_jadwal')
            ->join('matakuliah', 'jadwal_kuliah.kode_matkul', '=', 'matakuliah.kode_matkul')
            ->join('ruangan' , 'jadwal_kuliah.id_ruang', '=' , 'ruangan.id_ruang')
            ->where('irs.nim', $nim)
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
        // Cari data mahasiswa berdasarkan NIM menggunakan query builder
        $mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();
    
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }
    
        // Cari IRS berdasarkan mahasiswa
        // Cari IRS berdasarkan mahasiswa menggunakan nim
        $irs = DB::table('irs')->where('nim', $mahasiswa->nim)->first();

    
        if (!$irs) {
            return redirect()->back()->with('error', 'Data IRS tidak ditemukan.');
        }
    
        // Update status IRS menjadi disetujui
        DB::table('irs')
            ->where('nim', $irs->nim)
            ->update(['status' => 'disetujui']);
    
        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Status IRS berhasil disetujui.');
    }
    
    //untuk batal persetujuian irs 
    public function cancelApprovalIRS($nim)
    {
        // Cari data mahasiswa berdasarkan NIM menggunakan query builder
        $mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();
    
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }
    
        // Cari IRS berdasarkan mahasiswa
        // Cari IRS berdasarkan mahasiswa menggunakan nim
        $irs = DB::table('irs')->where('nim', $mahasiswa->nim)->first();

    
        if (!$irs) {
            return redirect()->back()->with('error', 'Data IRS tidak ditemukan.');
        }
    
        // Batalkan persetujuan hanya jika status IRS adalah disetujui
        if ($irs->status == 'disetujui') {
            DB::table('irs')
                ->where('nim', $irs->nim)
                ->update(['status' => 'draft']);

    
            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Persetujuan IRS berhasil dibatalkan.');
        } else {
            return redirect()->back()->with('error', 'Status IRS belum disetujui.');
        }
    }
    


}
        

