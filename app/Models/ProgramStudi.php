<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'nama',
        'kaprodi_id',
        'id_fak',
        'created_at',
    ];

    // Relasi ke Matakuliah
    public function mataKuliah()
    {
        return $this->hasMany(Matakuliah::class, 'id_prodi', 'id_prodi');
    }
    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi', 'id_prodi');
    }

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'prodi_id', 'id_prodi');
    }

}
