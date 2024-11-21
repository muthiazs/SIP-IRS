<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeAkademik extends Model
{
    protected $table = 'periode_akademik';

    protected $fillable = [
        'id_periode',
        'nama_periode',
        'tahun_mulai',
        'tahun_selesai',
        'jenis',
    ];
}