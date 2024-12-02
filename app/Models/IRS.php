<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    protected $table = 'irs';
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

}

