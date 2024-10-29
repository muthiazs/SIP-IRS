<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMahasiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'postLogin')->name('login.post');
    Route::get('logout', 'logout')->name('logout');
});

// Protected Routes (should be wrapped in middleware later)
Route::group([], function () {
    // Dosen Dashboard Routes
    Route::prefix('dashboardDosen')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboardDosen');
    });

    // Mahasiswa Dashboard Routes
    Route::prefix('dashboardMahasiswa')->group(function () {
        Route::get('/', [DashboardController::class, 'indexMahasiswa'])->name('dashboardMahasiswa');
    });

    // Kaprodi Dashboard Routes
    Route::prefix('dashboardKaprodi')->group(function () {
        Route::get('/', [DashboardController::class, 'indexKaprodi'])->name('dashboardKaprodi');
    });
});

// When you're ready to add authentication middleware, you can modify the protected routes like this:
/*
Route::middleware(['auth'])->group(function () {
    // Dosen Dashboard Routes
    Route::prefix('dashboardDosen')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboardDosen');
    });

    // Mahasiswa Dashboard Routes
    Route::prefix('dashboardMahasiswa')->group(function () {
        Route::get('/', [DashboardMahasiswaController::class, 'indexMahasiswa'])->name('dashboardMahasiswa');
    });

    // Kaprodi Dashboard Routes
    Route::prefix('dashboardKaprodi')->group(function () {
        Route::get('/', [DashboardController::class, 'indexKaprodi'])->name('dashboardKaprodi');
    });
});
*/