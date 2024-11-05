<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'roles1', // Pastikan ini sesuai dengan nama kolom di database
        'roles2', // Pastikan ini sesuai dengan nama kolom di database
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];
}