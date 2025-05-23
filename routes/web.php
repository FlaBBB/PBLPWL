<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\LombaController;
use App\Http\Controllers\Mahasiswa\LaporanController;
use App\Http\Controllers\Mahasiswa\PrestasiController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controlle
=======
>>>>>>> f7ed2d99cafe0514b21365ae177e10ea8b7803c2rs\Admin\KelolaPenggunaController;
use App\Http\Controllers\Admin\KelolaPrestasiController;
use App\Http\Controllers\Admin\KelolaLombaController;
use App\Http\Controllers\Admin\KelolaAkademikController;
use App\Http\Controllers\Admin\LaporanAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// <!-- Route for landing page -->

Route::get('/', function () {
    return view('landingpages.home');
});


// Route for fitur page
Route::get('/fitur', function () {
    return view('landingpages.fitur');
});

// Route for product page
Route::get('/product', function () {
    return view('landingpages.product');
});

// Route for pricing page
Route::get('/aboutus', function () {
    return view('landingpages.about-us');
});

Route::get('/login', function () {
    return view('auth.login');
});

// <!-- Route for Mahasiswa -->

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route Prestasi
Route::prefix('prestasi')->group(function () {
    Route::get('/', [PrestasiController::class, 'index'])->name('prestasi');
    Route::get('/tambah', [PrestasiController::class, 'create'])->name('prestasi.create');
});

// Route Lomba
Route::prefix('lomba')->group(function () {
    Route::get('/', [LombaController::class, 'index'])->name('lomba');
    Route::get('/tambah', [LombaController::class, 'create'])->name('lomba.create');
});

// Route Laporan
Route::prefix('laporan')->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('laporan');
});


// <!-- Route for Admin -->

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    // Pengguna
    Route::prefix('kelola-pengguna')->group(function () {
        Route::get('/', [KelolaPenggunaController::class, 'index'])->name('admin.kelola-pengguna');
        Route::get('/dosen', [KelolaPenggunaController::class, 'dosen'])->name('admin.kelola-dosen');
        Route::get('/admin', [KelolaPenggunaController::class, 'admin'])->name('admin.kelola-admin');
    });
    // Prestasi
    Route::prefix('kelola-prestasi')->group(function () {
        Route::get('/verifikasi', [KelolaPrestasiController::class, 'verifikasi'])->name('admin.verifikasi-prestasi');
        Route::get('/daftar', [KelolaPrestasiController::class, 'daftar'])->name('admin.daftar-prestasi');
    });
    // Lomba
    Route::prefix('kelola-lomba')->group(function () {
        Route::get('/daftar', [KelolaLombaController::class, 'daftar'])->name('admin.daftar-lomba');
        Route::get('/tambah', [KelolaLombaController::class, 'tambah'])->name('admin.tambah-lomba');
    });
    // Akademik
    Route::prefix('kelola-akademik')->group(function () {
       Route::get('/program-studi', [KelolaAkademikController::class, 'prodi'])->name('admin.program-studi');
       Route::get('/periode', [KelolaAkademikController::class, 'periode'])->name('admin.periode');
    });
    // Laporan
    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanAdminController::class, 'index'])->name('admin.laporan');
    });
    

});
