<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class KalenderAkademikController extends Controller
{
    public function index()
    {
        // Ambil semua data kalender akademik
        $kalenderAkademik = DB::table('kalender_akademik')->get(); // Ganti first() dengan get()
        
        // Kirim data ke view
        return view('kalender_akademik', compact('kalenderAkademik'));
    }

}