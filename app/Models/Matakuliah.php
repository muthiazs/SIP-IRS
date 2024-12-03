<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';

    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'sks',
        'semester',
    ];

    // Relasi ke JadwalKuliah
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'kode_matkul', 'kode_matkul');
    }
}
