<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    protected $table = 'jadwal_kuliah';

    protected $fillable = [
        'kode_matkul',
        'kuota',
        'id_dosen',
        'id_ruang',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kelas',
        'semester',
        'id_periode',
    ];
    protected $primaryKey = 'id_jadwal';
    protected $keyType = 'int';
    public $incrementing = true;


    // Relasi ke Matakuliah
    protected $with = ['matakuliah'];
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matkul', 'kode_matkul');
    }
    public function irs()
    {
    return $this->hasMany(IRS::class, 'id_jadwal', 'id_jadwal');
    }

}

