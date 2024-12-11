<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'id_matkul';
    protected $keyType = 'int';
    public $incrementing = true;

    // Aktifkan timestamp untuk menggunakan created_at dan updated_at
    public $timestamps = true;

    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'sks',
        'semester',
        'id_prodi',
    ];

    // Relasi ke JadwalKuliah
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'kode_matkul', 'kode_matkul');
    }

    // Relasi ke ProgramStudi
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi', 'id_prodi');
    }
}
