<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRSDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'irs_id',
        'jadwal_kuliah_id'
    ];

    public function irs()
    {
        return $this->belongsTo(Irs::class, 'irs_id');
    }

    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadwal_kuliah_id');
    }
}