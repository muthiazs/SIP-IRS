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
            } elseif ($user->roles1 === 'akademik') {
                return redirect()->route('dashboardAkademik');
            } elseif ($user->roles1 === 'dosen' ) {
                if ($user->roles2 == '' || $user->roles2 == 'dosen_wali' ) {
                    return redirect()->route('dashboardDosen');
                }
                else{
                    return redirect()->route('roleSelection');
                }
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
        $roleSelected = $request->input('role'); // Role yang dipilih oleh pengguna
        $user = Auth::user(); // Ambil pengguna yang sedang login
    
    
        // Cek kondisi berdasarkan roles1 dan roles2
        if ($user->roles1 === 'dosen' && $user->roles2 === 'kaprodi') {
            // Jika user memilih 'dekan'
            if ($roleSelected === 'dekan') {
                return redirect()->route('notPage'); // Arahkan ke halaman notPage
            } elseif ($roleSelected === 'kaprodi') {
                return redirect()->route('dashboardKaprodi'); // Arahkan ke dashboard Kaprodi
            } elseif ($roleSelected === 'dosen_wali') {
                return redirect()->route('dashboardDosen'); // Arahkan ke dashboard Dosen Wali
            }
        }
    
        if ($user->roles1 === 'dosen' && $user->roles2 === 'dekan') {
            // Jika user memilih 'kaprodi'
            if ($roleSelected === 'kaprodi') {
                return redirect()->route('notPage'); // Arahkan ke halaman notPage
            } elseif ($roleSelected === 'dekan') {
                return redirect()->route('dashboardDekan'); // Arahkan ke dashboard Dekan
            } elseif ($roleSelected === 'dosen_wali') {
                return redirect()->route('dashboardDosen'); // Arahkan ke dashboard Dosen Wali
            }
        }
    
        // Tambahkan kondisi lain sesuai kebutuhan jika ada
    
        // Default redirect jika tidak ada kondisi yang terpenuhi
        return redirect()->route('roleSelection')->withErrors(['Role tidak valid']);
    }
    
    

    public function notPage()
    {
        return view('auth.notPage'); // Pastikan ini mengarah ke view yang benar
    }
    
    
        

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
