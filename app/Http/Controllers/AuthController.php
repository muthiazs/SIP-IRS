<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Session;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
                'email' => 'required|email',
                'password' => 'required',
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)){
                $user = Auth::user();  
            //mengarahkan ke role masing2 
            switch($user->role) {
                case 'mahasiswa':
                    return redirect()->route('dashboardMahasiswa')->with([
                        'semester' => 5,
                        'ipk' => '3.6/4.0',
                        'sksk' => 86
                    ]);
                case 'dosen':
                    return redirect()->route('dashboardDosen');
                // case 'dekan':
                //     return redirect()->route('dekan.dashboard');
                // case 'kaprodi':
                //     return redirect()->route('kaprodi.dashboard');
                // case 'akademik':
                //     return redirect()->route('akademik.dashboard');
                default:
                    return redirect()->route('login')
                        ->withErrors('tidak valid.');
                }
        }

        return redirect()->route('login')
            ->withErrors("Email atau password salah");
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('login')
            ->withSuccess('berhasil logout');
    }
}