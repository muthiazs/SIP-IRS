<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function loginPost(Request $request)
    {
        // Logika untuk proses login
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerPost(Request $request){
        //logika registerpost
    }
}
