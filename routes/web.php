<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\SidebarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BAK_PembagianruangController;
use App\Http\Controllers\Kaprodi_JadwalKuliahControler;
use App\Http\Controllers\KaprodiControler;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\Mhs_PengisianIRSController;


// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'postLogin')->name('login.post');
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
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
        Route::get('/', [KaprodiControler::class, 'DashboardKaprodi'])->name('dashboardKaprodi');
    });

    // Akademik Dashboard Routes
    Route::prefix('dashboardAkademik')->group(function () {
        Route::get('/', [DashboardController::class, 'indexAkademik'])->name('dashboardAkademik');
    });

    Route::prefix('dashboardDekan')->group(function () {
        Route::get('/', [DekanController::class, 'indexDekan'])->name('dashboardDekan');
    });

    // Pengisian IRS 
    Route::prefix('dosen_irsMahasiswa')->group(function () {
        Route::get('/', [IRSController::class, 'index'])->name('dosen_irsMahasiswa');
    });

    // Pengisian IRS oleh Mahasiswa
    Route::prefix('pengisianIRS')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'indexPilihJadwal'])->name('mhs_pengisianIRS');
    });

    // Hasil Pengisian IRS oleh Mahasiswa
    Route::prefix('rencanaStudi')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'indexRencanaStudi'])->name('mhs_rencanaStudi');
    });

    // Pemilihan Matkul oleh Mahasiswa
    Route::prefix('daftarMatkul')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'indexDaftarMatkul'])->name('daftarMatkul');
    });

    // Pengambilan Matkul oleh Mahasiswa
    // Route::prefix('pengambilanMatkul')->group(function () {
    //     Route::get('/', [Mhs_PengisianIRSController::class, 'indexAmbilMatkul'])->name('pengambilanMatkul');
    // });
});

// Role Selection Page for Dosen
Route::get('/roleSelection', [AuthController::class, 'roleSelection'])->name('roleSelection');
Route::get('/not-page', [AuthController::class, 'notPage'])->name('notPage');
Route::post('/handleRoleSelection', [AuthController::class, 'handleRoleSelection'])->name('handleRoleSelection');
Route::post('/submit-role-selection', [AuthController::class, 'submitRoleSelection'])->name('submitRoleSelection');

// Protected Routes with Authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboardMahasiswa', [DashboardController::class, 'indexMahasiswa'])->name('dashboardMahasiswa');
    Route::get('/dashboardAkademik', [DashboardController::class, 'indexAkademik'])->name('dashboardAkademik');
    Route::get('/dashboardDekan', [DekanController::class, 'indexDekan'])->name('dashboardDekan');
    Route::get('/dashboardKaprodi', [KaprodiControler::class, 'DashboardKaprodi'])->name('dashboardKaprodi');
    Route::get('/dashboardDosen', [DashboardController::class, 'index'])->name('dashboardDosen');
    Route::get('/pembagianruang', [BAK_PembagianruangController::class, 'index'])->name('pembagianruang');
    Route::get('/dosen_IRSMahasiswa', [IRSController::class, 'index'])->name('dosen_irsMahasiswa');
    Route::get('/rencanaStudi', [Mhs_PengisianIRSController::class, 'indexRencanaStudi'])->name('mhs_rencanaStudi');
    Route::get('/pengisianIRS', [Mhs_PengisianIRSController::class, 'indexPilihJadwal'])->name('mhs_pengisianIRS');
    Route::get('/daftarMatkul', [Mhs_PengisianIRSController::class, 'indexDaftarMatkul'])->name('mhs_daftarMatkul');
    // Route::get('/pengambilanMatkul', [Mhs_PengisianIRSController::class, 'indexAmbilMatkul'])->name('pengambilanMatkul');
    Route::get('/kaprodi_JadwalKuliah', [KaprodiControler::class, 'JadwalKuliah'])->name('kaprodi_JadwalKuliah');
    Route::get('/kaprodi_StatusMahasiswa', [KaprodiControler::class, 'StatusMahasiswa'])->name('kaprodi_StatusMahasiswa');
    Route::get('/dekan_PersetujuanRuang', [DekanController::class, 'PersetujuanRuang'])->name('dekan_PersetujuanRuang');
    Route::get('/dekan_PersetujuanJadwal', [DekanController::class, 'PersetujuanJadwal'])->name('dekan_PersetujuanJadwal');
    Route::get('/bak_PembagianRuang', [BAK_PembagianruangController::class, 'index'])->name('bak_PembagianRuang');
});

//Pembagian Ruang
// Route::get('/pembagianruang', [BAK_PembagianruangController::class, 'index'])->name('pembagianruang');

// // Pengisian IRS
// Route::get('/pengisianIRS', [Mhs_PengisianIRSController::class, 'index'])->name('pengisianIRS');

// Route::get('/dashboardAkademik', [DashboardController::class, 'indexAkademik'])->name('dashboardAkademik');