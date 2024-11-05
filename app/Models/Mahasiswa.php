<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Model
{
    use Notifiable;

    protected $table = 'mahasiswa';
}