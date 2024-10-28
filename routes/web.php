<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Role Selection Page for Dosen
Route::get('/roleSelection', [AuthController::class, 'roleSelection'])->name('roleSelection');
Route::post('/handleRoleSelection', [AuthController::class, 'handleRoleSelection'])->name('handleRoleSelection');
Route::post('/submit-role-selection', [AuthController::class, 'submitRoleSelection'])->name('submitRoleSelection');


// Protected Routes with Authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboardMahasiswa', [DashboardController::class, 'dashboardMahasiswa'])->name('dashboardMahasiswa');
    Route::get('/dashboardAkademik', [DashboardController::class, 'dashboardAkademik'])->name('dashboardAkademik');
    Route::get('/dashboardDekan', [DashboardController::class, 'indexDekan'])->name('dashboardDekan');
    Route::get('/dashboardKaprodi', [DashboardController::class, 'indexKaprodi'])->name('dashboardKaprodi');
    Route::get('/dashboardDosen', [DashboardController::class, 'dashboardDosen'])->name('dashboardDosenl');
});
