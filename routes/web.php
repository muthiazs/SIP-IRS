<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMahasiswaController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboardDosen', function(){
    return view('dashboardDosen');
});
Route::get('/dashboardDosen', [DashboardController::class, 'index'])->name('dashboardDosen');

Route::get('/dashboardMahasiswa', function(){
    return view('dashboardMahasiswa');
});
Route::get('/dashboardMahasiswa', [DashboardMahasiswaController::class, 'index'])->name('dashboardMahasiswa');

Route::get('/dashboardKaprodi', function(){
    return view('dashboardKaprodi');
});
Route::get('/dashboardKaprodi', [DashboardController::class, 'indexKaprodi'])->name('dashboardKaprodi');



// Protected Routes
Route::middleware('auth')->group(function () {
    // // Mahasiswa Routes
    // Route::middleware(['role:mahasiswa'])->group(function () {
    //     Route::get('/mahasiswa/dashboard', function () {
    //         return view('mahasiswa.dashboard');
    //     })->name('mahasiswa.dashboard');
    // });

    // Dosen Routes
    // Route::middleware(['role:dosen'])->group(function () {
    //     Route::get('/dashboard', function () {
    //         return view('dashboard');
    //     })->name('dashboard');
    // });

    // // Dekan Routes
    // Route::middleware(['role:dekan'])->group(function () {
    //     Route::get('/dekan/dashboard', function () {
    //         return view('dekan.dashboard');
    //     })->name('dekan.dashboard');
    // });

    // // Kaprodi Routes
    // Route::middleware(['role:kaprodi'])->group(function () {
    //     Route::get('/kaprodi/dashboard', function () {
    //         return view('kaprodi.dashboard');
    //     })->name('kaprodi.dashboard');
    // });

    // // Akademik Routes
    // Route::middleware(['role:akademik'])->group(function () {
    //     Route::get('/akademik/dashboard', function () {
    //         return view('akademik.dashboard');
    //     })->name('akademik.dashboard');
    // });
});