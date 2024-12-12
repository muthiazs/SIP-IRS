<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan penamaan konvensional
    protected $table = 'ruangan';

    // Tentukan kolom yang boleh diisi (fillable)
    protected $fillable = [
        'nama', // Nama ruang
        'kapasitas', // Kapasitas ruang
        'status', // Status ruang
    ];

    // Tentukan kolom yang tidak boleh diisi (guarded)
    protected $guarded = ['id_ruang']; // id_ruang akan diisi otomatis oleh database

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_ruang', 'id_ruang');
    }

}
