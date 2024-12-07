<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'id_user',
        'nim',
        'nama',
        'semester',
        'id_prodi',
        'id_dosen',
        'angkatan',
    ];
    protected $primaryKey = 'id_mahasiswa'; // Primary key
    public $timestamps = true; // Menyertakan created_at dan updated_at

    // Relasi dengan ProgressMahasiswa (1 mahasiswa memiliki banyak progress)
    public function progressMahasiswa()
    {
        return $this->hasMany(ProgressMahasiswa::class, 'id_mahasiswa');
    }
}
