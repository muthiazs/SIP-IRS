<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IRSController extends Controller
{
    public function index()
    {
        return view('layouts.dosen_irsMahasiswa'); // Sesuaikan dengan nama view yang kamu buat

    }
}
