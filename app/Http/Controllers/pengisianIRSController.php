<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pengisianIRSController extends Controller
{
        // Method untuk Dashboard Dosen
        public function indexIRS()
        {
            return view('pengisianIRS');
        }
}