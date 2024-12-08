<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\SidebarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BAK_PembagianruangController;
use App\Http\Controllers\Kaprodi_JadwalKuliahControler;
use App\Http\Controllers\KaprodiControler;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\DosenController;
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
        Route::post('/ambilJadwal', [Mhs_PengisianIRSController::class, 'ambilJadwal'])->name('ambilJadwal');
    });

    // Hasil Pengisian IRS oleh Mahasiswa
    Route::prefix('rencanaStudi')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'indexRencanaStudi'])->name('mhs_rencanaStudi');
    });


    // Pembuatan Rencana Studi oleh Mahasiswa
    Route::prefix('rrencanaStudi')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'rrencanaStudi'])->name('mhs_rrencanaStudi');
        Route::get('/cetak_pdf', [Mhs_PengisianIRSController::class, 'cetak_pdf'])->name('cetak_pdf');
    });

    // Halaman kalo periode isi irs Habis
    Route::prefix('periodeIRSHabis')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'periodeHabis'])->name('mhs_habisPeriodeIRS');
    });
    // Halaman pengisian IRS baru kayak jembatan buat pilih matkul gitu
    Route::prefix('newIRS')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'newIRS'])->name('mhs_newIRS');
    });
    // Halaman pengisian IRS kalo udah pernah ambil aka draft irs
    Route::prefix('draftIRS')->group(function () {
        Route::get('/', [Mhs_PengisianIRSController::class, 'draftIRS'])->name('mhs_draftIRS');
        Route::post('/batalkanJadwal', [Mhs_PengisianIRSController::class, 'batalkanJadwal'])->name('batalkanJadwal');
    });
    
    // Pengambilan Matkul oleh Mahasiswa
    // Route::prefix('pengambilanMatkul')->group(function () {
    //     Route::get('/', [Mhs_PengisianIRSController::class, 'indexAmbilMatkul'])->name('pengambilanMatkul');
    // });
});

// Role Selection Page for Dosen
// Route::post('/roleSelection', [AuthController::class, 'roleSelection'])->name('roleSelection');
// Route::get('/not-page', [AuthController::class, 'notPage'])->name('notPage');
// Route::post('/handleRoleSelection', [AuthController::class, 'handleRoleSelection'])->name('handleRoleSelection');
// Route::post('/submit-role-selection', [AuthController::class, 'submitRoleSelection'])->name('submitRoleSelection');

// Route to display the role selection page
Route::get('/roleSelection', [AuthController::class, 'roleSelection'])->name('roleSelection');

// Route for handling the form submission of role selection
Route::post('/handleRoleSelection', [AuthController::class, 'handleRoleSelection'])->name('handleRoleSelection');

// Route for a "not page" (optional)
Route::get('/not-page', [AuthController::class, 'notPage'])->name('notPage');

// Submit role selection (if needed for another action)
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
    Route::get('/rrencanaStudi', [Mhs_PengisianIRSController::class, 'rencanaStudi'])->name('mhs_rrencanaStudi');
    Route::get('/periodeIRSHabis', [Mhs_PengisianIRSController::class, 'periodeHabis'])->name('mhs_habisPeriodeIRS');
    Route::get('/newIRS', [Mhs_PengisianIRSController::class, 'newIRS'])->name('mhs_newIRS');
    Route::get('/draftIRS', [Mhs_PengisianIRSController::class, 'draftIRS'])->name('mhs_draftIRS');
    // Route::get('/pengambilanMatkul', [Mhs_PengisianIRSController::class, 'indexAmbilMatkul'])->name('pengambilanMatkul');
    Route::get('/kaprodi_JadwalKuliah', [KaprodiControler::class, 'JadwalKuliah'])->name('kaprodi_JadwalKuliah');
    Route::get('/kaprodi_CreateMatkul', [KaprodiControler::class, 'indexCreateMatkul'])->name('kaprodi_CreateMatkul');
    Route::post('/matkul/create', [KaprodiControler::class, 'createMatkul'])->name('matkul.create');
    Route::post('/matkul/store', [KaprodiControler::class, 'store'])->name('matkul.store');
    Route::get('/kaprodi_StatusMahasiswa', [KaprodiControler::class, 'StatusMahasiswa'])->name('kaprodi_StatusMahasiswa');
    Route::get('/kaprodi_SetMatkul', [KaprodiControler::class, 'setMatkul'])->name('kaprodi_SetMatkul');
    Route::get('/kaprodi_UpdateDeleteMatkul', [KaprodiControler::class, 'UpdateDeleteMatkul'])->name('kaprodi_UpdateDeleteMatkul');
    Route::post('/matkul/update', [KaprodiControler::class, 'updateMatakuliah'])->name('update.matkul');
    Route::post('/matkul/delete', [KaprodiControler::class, 'deleteMatakuliah'])->name('delete.matkul');
    Route::get('/kaprodi_CreateJadwal', [KaprodiControler::class, 'indexCreateJadwal'])->name('kaprodi_CreateJadwal');
    Route::post('/jadwal/store', [KaprodiControler::class, 'createJadwal'])->name('jadwal.store');
    Route::get('/dekan_PersetujuanRuang', [DekanController::class, 'PersetujuanRuang'])->name('dekan_PersetujuanRuang');
    Route::post('/ruang/acc', [DekanController::class, 'setujuiRuang'])->name('ruang.acc');
    Route::get('/dekan_PersetujuanJadwal', [DekanController::class, 'PersetujuanJadwal'])->name('dekan_PersetujuanJadwal');
    Route::get('/pembagianruang', [BAK_PembagianruangController::class, 'index'])->name('pembagianruang');
    Route::get('/bak_PembagianRuang', [BAK_PembagianruangController::class, 'indexPembagianRuang'])->name('bak_PembagianRuang');
    Route::post('/ruang/cancel', [BAK_PembagianruangController::class, 'cancelAlokasiRuang'])->name('cancel.ruang');
    // Route untuk menangani pembatalan alokasi ruang yang dipilih
    Route::post('/cancel-selected-ruang', [BAK_PembagianruangController::class, 'cancelSelectedRuang'])->name('cancel.selected.ruang');
    Route::get('/bak_CekStatusRuang', [BAK_PembagianruangController::class, 'indexCekStatusRuang'])->name('bak_CekStatusRuang');
    Route::post('/ruang/store', [BAK_PembagianruangController::class, 'storeRuang'])->name('ruang.store');
    Route::get('/bak_CreateRuang', [BAK_PembagianruangController::class, 'indexCreateRuang'])->name('bak_CreateRuang');
    Route::post('/ruang/create', [BAK_PembagianruangController::class, 'createRuang'])->name('create.store');
    Route::get('/bak_UpdateDeleteRuang', [BAK_PembagianruangController::class, 'indexUpdateDeleteRuang'])->name('bak_UpdateDeleteRuang');
    Route::get('/bak_NextUpdateDeleteRuang', [BAK_PembagianruangController::class, 'indexNextUpdateDeleteRuang'])->name('bak_NextUpdateDeleteRuang');
    Route::post('/ruang/update', [BAK_PembagianruangController::class, 'updateRuang'])->name('update.ruang');
    Route::post('/ruang/delete', [BAK_PembagianruangController::class, 'deleteRuang'])->name('delete.ruang');
    Route::post('/konfirmasi-irs', [Mhs_PengisianIRSController::class, 'konfirmasiIRS'])->name('konfirmasi_irs');
    Route::get('/dosen_irsMahasiswa', [DosenController::class, 'usulanIRSMahasiswa'])->name('dosen_irsMahasiswa');
    // Rute untuk menampilkan detail IRS mahasiswa
    Route::get('/dosen/detail-irs/{nim}', [DosenController::class, 'detailIRS'])->name('dosen_detailIRSMahasiswa');
    //Buat filter etc
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    // Setujui IRS
    Route::get('/dosen/approve-irs/{nim}', [DosenController::class, 'approveIRS'])->name('dosen.approve.irs');

    // Batalkan Persetujuan IRS
    Route::get('/dosen/cancel-approval-irs/{nim}', [DosenController::class, 'cancelApprovalIRS'])->name('dosen.cancel.approval.irs');
    //route Cetak PDF 
    Route::get('/cetak-pdf/{semester}', [Mhs_PengisianIRSController::class, 'cetak_pdf'])->name('cetak.pdf');

    // Route untuk menampilkan halaman cetak IRS
    Route::get('dosen/print-irs/{nim}', [DosenController::class, 'printIRS'])->name('dosen.print_irs');

    // Route untuk mengunduh IRS dalam bentuk PDF
    // Route untuk mengunduh IRS dalam format PDF
    Route::get('dosen/print-irs-pdf/{nim}', [DosenController::class, 'printIRSPDF'])->name('dosen.print_irs_pdf');

    Route::post('/kaprodi/jadwal/store', [KaprodiControler::class, 'createJadwal'])->name('jadwal.store');


    Route::post('/approve-irs', [DosenController::class, 'approveSelectedIRS'])->name('approve.selected.irs');
    
    //controller kalender akademik
    Route::get('/kalender_akademik', [KalenderAkademikController::class, 'index'])->name('kalender_akademik');

    Route::delete('/jadwal/{id}', [KaprodiControler::class, 'destroy'])->name('jadwal.delete');

});

