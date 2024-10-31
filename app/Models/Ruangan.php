<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kapasitas',
        'status'
    ];

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'ruangan_id');
    }

    public function alokasiRuangan()
    {
        return $this->hasMany(AlokasiRuangan::class, 'ruangan_id');
    }
}