<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlokasiRuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruangan_id',
        'prodi_id',
        'semester',
        'tahun_ajaran',
        'status'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }
}