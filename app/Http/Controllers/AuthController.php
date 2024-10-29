<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Check credentials
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Role-based redirection
            if ($user->roles1 === 'mahasiswa') {
                return redirect()->route('dashboardMahasiswa');
            } elseif ($user->roles1 === 'bagian akademik') {
                return redirect()->route('dashboardAkademik');
            } elseif ($user->roles1 === 'dosen') {
                return redirect()->route('roleSelection');
            } else {
                return redirect()->route('login')->withErrors(['role' => 'Role tidak valid.']);
            }
        }

        // If login fails
        return redirect()->route('login')->withErrors(['email' => 'Email atau password salah.']);
    }

    // Display role selection page for Dosen
    public function roleSelection()
    {
        return view('auth.roleSelection');
    }

    // Handle role selection and redirect to the appropriate dashboard
    public function handleRoleSelection(Request $request)
    {
        $request->validate([
            'roles2' => 'required|string|in:Dosen Wali,Kepala Prodi,Dekan, ',
        ]);
    
        $role = $request->input('roles2');
    
        // Redirect berdasarkan role yang dipilih
        switch ($role) {
            case 'Dosen Wali':
                return redirect()->route('dashboardDosen');
            case 'Kepala Prodi':
                return redirect()->route('dashboardKaprodi');
            case 'Dekan':
                return redirect()->route('dashboardDekan');
            default:
                return redirect()->back()->withErrors('Role tidak valid.');
        }
    }
    
    
        

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
