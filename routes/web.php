<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PesertaAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PesertaDashboardController;
use App\Http\Controllers\DashboardPembimbingAsalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPembimbingController;
use App\Http\Controllers\DashboardPesertaController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PesertaMiddleware;
use App\Http\Middleware\CalonPesertaMiddleware;
use App\Http\Middleware\PesertaSelesaiMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [DashboardController::class, 'index']);

// login admin
Route::get('/login-petugas', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login-petugas', [AdminAuthController::class, 'login']);

// login peserta
Route::get('/login-peserta', [PesertaAuthController::class, 'showLogin'])->name('peserta.login');
Route::post('/login-peserta', [PesertaAuthController::class, 'login']);

// logout
Route::post('/logoutadmin', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::post('/logout-peserta', [PesertaAuthController::class, 'logout'])->name('peserta.logout');

// register
Route::get('/register-peserta', [PesertaAuthController::class, 'showRegister'])->name('peserta.register');
Route::post('/register-peserta', [PesertaAuthController::class, 'register'])->name('peserta.register');

// form input email
Route::get('/lupa-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');

// kirim email
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// form reset password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// simpan password baru
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard-pembimbing', [DashboardPembimbingController::class, 'index'])->name('pembimbing.dashboard');
    Route::get('/pembimbing/detail/{id}', [DashboardPembimbingController::class, 'detail'])->name('pembimbing.detail');
    Route::get('/pembimbing/logbook/{id}', [DashboardPembimbingController::class, 'logbook'])
    ->name('pembimbing.logbook');
     Route::get('/pembimbing/logbook/pdf/{id}',[DashboardPembimbingController::class, 'exportLogbookPembimbing'])
    ->name('pembimbing.logbook.pdf');

    Route::put('/admin/update-kuota', [DashboardAdminController::class, 'updateKuota'])->name('admin.update.kuota');

    // calon peserta
    Route::get('/admin/calon', [DashboardAdminController::class, 'calonPeserta'])->name('admin.calon');

    // detail
    Route::get('/admin/detail/{id}', [DashboardAdminController::class, 'detailPeserta'])->name('admin.detail');
    Route::get('/admin/detail-peserta/{id}', [DashboardAdminController::class, 'detailPesertaAktif'])->name('admin.detail.peserta');
    Route::get('/admin/detail-riwayat/{id}', [DashboardAdminController::class, 'detailPesertaSelesai'])->name('admin.detail.riwayat');

    Route::get('/admin/logbook/{id}', [DashboardAdminController::class, 'logbookPeserta'])
    ->name('admin.logbook');
    Route::get('/admin/logbook/pdf/{id}',
    [DashboardAdminController::class, 'exportLogbookAdmin'])
    ->name('admin.logbook.pdf');
    Route::get('/pembimbing/peserta/pdf',
    [DashboardPembimbingController::class, 'exportPesertaPdf'])
    ->name('pembimbing.peserta.pdf');

    // aksi
    Route::post('/admin/terima/{id}', [DashboardAdminController::class, 'terima'])->name('admin.terima');
    Route::post('/admin/tolak/{id}', [DashboardAdminController::class, 'tolak'])->name('admin.tolak');
    Route::post('/admin/selesai/{id}', [DashboardAdminController::class, 'selesai'])->name('admin.selesai');
    Route::post('/admin/assign-pembimbing/{id}', [DashboardAdminController::class, 'assignPembimbing'])->name('admin.assign.pembimbing');
    Route::post('/admin/upload-balasan/{id}',[DashboardAdminController::class, 'uploadBalasan'])->name('admin.upload.balasan');
    Route::get('/admin/pembimbing',[DashboardAdminController::class, 'pembimbing'])->name('admin.pembimbing');
    Route::post('/admin/pembimbing/store',[DashboardAdminController::class, 'storePembimbing'])->name('admin.pembimbing.store');
Route::post('/admin/presensi/buka',
    [PresensiController::class, 'bukaPresensi'])
    ->name('admin.presensi.buka');
Route::post('/admin/presensi/update-status',
    [PresensiController::class, 'updateStatus'])
    ->name('admin.presensi.updateStatus');
Route::post('/admin/presensi/{id}/tutup', [PresensiController::class, 'tutupPresensi'])
    ->name('admin.presensi.tutup');
    Route::get('/admin/presensi', [PresensiController::class, 'halamanPresensi'])->name('admin.presensi');
    Route::get('/admin/rekap-presensi', [PresensiController::class, 'rekapPresensi'])->name('admin.rekap.presensi');
    Route::get('/admin/rekap-surat', [PresensiController::class, 'rekapSurat'])->name('admin.rekap.surat');
Route::get('/admin/rekap-presensi/export', [PresensiController::class, 'exportRekapPresensi'])
    ->name('admin.rekap.presensi.export');
Route::get('/admin/detail-presensi/{id}', [PresensiController::class, 'detailPresensi'])
->name('admin.detail.presensi');
Route::get('/admin/detail-presensi/export/{id}', [PresensiController::class, 'exportDetailPresensi'])
->name('admin.detail.presensi.export');

    Route::put('/admin/pembimbing/update/{id}',
    [DashboardAdminController::class, 'updatePembimbing'])
    ->name('admin.pembimbing.update');

    Route::post(
    '/admin/pembimbing-asal/store',
    [DashboardAdminController::class, 'storePembimbingAsal']
)->name('admin.pembimbing-asal.store');

Route::post(
    '/admin/assign-pembimbing-asal/{id}',
    [DashboardAdminController::class, 'assignPembimbingAsal']
)->name('admin.assign.pembimbing.asal');

Route::put(
    '/admin/pembimbing-asal/update/{id}',
    [DashboardAdminController::class, 'updatePembimbingAsal']
)->name('admin.pembimbing-asal.update');

    Route::get('/admin/jurusan', [DashboardAdminController::class, 'jurusan'])
    ->name('admin.jurusan');

Route::post('/admin/jurusan', [DashboardAdminController::class, 'storeJurusan'])
    ->name('admin.jurusan.store');

Route::get('/admin/sekolah', [DashboardAdminController::class, 'sekolahKampus'])
    ->name('admin.sekolah');

Route::post('/admin/sekolah', [DashboardAdminController::class, 'storeSekolahKampus'])
    ->name('admin.sekolah.store');

Route::put('/admin/jurusan/update/{id}',
    [DashboardAdminController::class, 'updateJurusan'])
    ->name('admin.jurusan.update');

Route::put('/admin/sekolah/update/{id}',
    [DashboardAdminController::class, 'updateSekolahKampus'])
    ->name('admin.sekolah.update');

    Route::delete('/admin/jurusan/delete/{id}',
    [DashboardAdminController::class, 'deleteJurusan'])
    ->name('admin.jurusan.delete');
    Route::delete('/admin/sekolah/delete/{id}',
    [DashboardAdminController::class, 'deleteSekolahKampus'])
    ->name('admin.sekolah.delete');

    // 🔥 PENILAIAN PEMBIMBING
Route::get('/pembimbing/penilaian/{id}', [PenilaianController::class, 'form'])
    ->name('pembimbing.penilaian');

Route::post('/pembimbing/penilaian/{id}', [PenilaianController::class, 'simpan'])
    ->name('pembimbing.penilaian.simpan');

    Route::put('/pembimbing/kepala/update', [DashboardAdminController::class, 'updateKepalaPerpustakaan'])
    ->name('admin.kepala.update');

// 🔥 KRITERIA NILAI
Route::put('/pembimbing/kriteria/{id}/update', [PenilaianController::class, 'updateKriteria'])
    ->name('pembimbing.kriteria.update');

Route::post('/pembimbing/kriteria', [PenilaianController::class, 'storeKriteria'])
    ->name('pembimbing.kriteria.store');

Route::delete('/pembimbing/kriteria/{id}', [PenilaianController::class, 'deleteKriteria'])
    ->name('pembimbing.kriteria.delete');

Route::delete('/pembimbing/penilaian/{peserta}/{kriteria}', [PenilaianController::class, 'hapusNilai'])
    ->name('pembimbing.penilaian.delete');

    Route::post('/pembimbing/penilaian/assign/{id}', [PenilaianController::class, 'assignKriteria'])
    ->name('pembimbing.penilaian.assign');

    // peserta aktif
    Route::get('/admin/peserta', [DashboardAdminController::class, 'pesertaMagang'])->name('admin.peserta');

    // riwayat peserta
    Route::get('/admin/riwayat', [DashboardAdminController::class, 'riwayat'])->name('admin.riwayat');

    Route::get('/dashboard-pembimbing-asal',
    [DashboardPembimbingAsalController::class, 'index'])
    ->name('pembimbing_asal.dashboard');

Route::get('/pembimbing-asal/detail/{id}',
    [DashboardPembimbingAsalController::class, 'detail'])
    ->name('pembimbing_asal.detail');

Route::get('/pembimbing-asal/logbook/{id}',
    [DashboardPembimbingAsalController::class, 'logbook'])
    ->name('pembimbing_asal.logbook');

});

// ✅ dashboard PESERTA (diterima)
Route::middleware(PesertaMiddleware::class)->group(function () {
    Route::get('/dashboard-peserta', [DashboardPesertaController::class, 'peserta']);
    Route::post('/peserta/presensi', [DashboardPesertaController::class, 'kirimPresensi'])->name('peserta.presensi');
    Route::get('/logbook', [LogbookController::class, 'index'])->name('peserta.logbook');
    Route::post('/logbook/store', [LogbookController::class, 'store'])->name('peserta.logbook.store');
    Route::put('/logbook/update/{id}', [LogbookController::class, 'update'])->name('peserta.logbook.update');
});

// ✅ dashboard CALON
Route::middleware(CalonPesertaMiddleware::class)->group(function () {
    Route::get('/dashboard-calon', [DashboardPesertaController::class, 'calon']);
});

Route::middleware(PesertaSelesaiMiddleware::class)->group(function () {
    Route::get('/dashboard-selesai', function () {
        $peserta = auth()->guard('peserta')->user();
        return view('peserta.selesai', compact('peserta'));
    });
});

Route::get('/peserta/nilai/pdf/{id}', [PenilaianController::class, 'exportNilai'])->name('peserta.nilai.pdf');
Route::middleware(['web'])->group(function () {
    Route::get('/logbook/export-pdf', [LogbookController::class, 'exportPdf'])
        ->name('peserta.logbook.export.pdf');
});

