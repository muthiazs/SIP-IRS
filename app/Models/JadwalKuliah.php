<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kuliah';

    protected $primaryKey = 'id_jadwal';
    protected $keyType = 'int';
    public $incrementing = true;


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

    // Relasi ke Matakuliah
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matkul', 'kode_matkul');
    }
    public function irs()
    {
    return $this->hasMany(IRS::class, 'id_jadwal', 'id_jadwal');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruang', 'id_ruang');
    }


}

