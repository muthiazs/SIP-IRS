<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'semester',
        'tahun_ajaran',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function irsDetail()
    {
        return $this->hasMany(IrsDetail::class, 'irs_id');
    }
}