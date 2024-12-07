<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    protected $table = 'irs';
    protected $primaryKey = 'id_irs';
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable = [
        'nim',
        'semester',
        'id_jadwal',
        'status',
    ];



    public function jadwalKuliah()
    {
    return $this->belongsTo(JadwalKuliah::class, 'id_jadwal', 'id_jadwal');
    }

    // Relasi ke Matakuliah melalui JadwalKuliah
    public function matakuliah()
    {
        return $this->hasOneThrough(
            Matakuliah::class,
            JadwalKuliah::class,
            'id_jadwal',    // Foreign key di JadwalKuliah
            'kode_matkul',  // Foreign key di Matakuliah
            'id_jadwal',    // Local key di IRS
            'kode_matkul'   // Local key di JadwalKuliah
        );
    }
}

