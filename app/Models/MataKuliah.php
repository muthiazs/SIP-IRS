<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_mata_kuliah',
        'nama_mata_kuliah',
        'sks',
        'prodi_id',
        'status'
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'mata_kuliah_id');
    }
}