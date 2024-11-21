<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'id_user',
        'nim',
        'nama',
        'semester',
        'id_prodi',
        'id_dosen',
        'angkatan',
    ];
}