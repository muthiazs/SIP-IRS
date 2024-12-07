<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressMahasiswa extends Model
{
    protected $table = 'progress_mahasiswa'; // Nama tabel progress_mahasiswa
    protected $primaryKey = 'id_mahasiswa'; // Primary key
    public $timestamps = true; // Menyertakan created_at dan updated_at
    protected $fillable = ['semester_studi', 'IPk', 'IPs_lalu', 'SKSk', 'status']; // Kolom yang dapat diisi

    // Relasi dengan Mahasiswa (progress milik 1 mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa'); // Hubungkan dengan id_mahasiswa
    }
}


