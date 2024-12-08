<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    // use Notifiable;

    protected $table = 'dosen';

    protected $fillable = [
        'id_user',
        'nip',
        'nama',
        'prodi_id',
    ];
    protected $primaryKey = 'id_dosen'; // Primary key
    public $timestamps = true; // Menyertakan created_at dan updated_at
}
