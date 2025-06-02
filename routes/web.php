<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\LombaController;
use App\Http\Controllers\Mahasiswa\LaporanController;
use App\Http\Controllers\Mahasiswa\PrestasiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KelolaPenggunaController;
use App\Http\Controllers\Admin\KelolaPrestasiController;
use App\Http\Controllers\Admin\KelolaLombaController;
use App\Http\Controllers\Admin\KelolaAkademikController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\RekomendasiController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Dosen\VerifikasiPrestasiController;
use App\Http\Controllers\Dosen\ManajemenMahasiswaController;
use App\Http\Controllers\Admin\KelolaLombaController as DosenLombaController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\AuthController; // Import AuthController
use App\Enums\UserRoleEnum; // Import UserRoleEnum
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

// Route for landing page
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

Route::get('/aboutus', function () {
    return view('landingpages.about-us');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Mahasiswa Routes
    Route::middleware(['role:' . UserRoleEnum::MAHASISWA->value])->group(function () {
        Route::get('/mahasiswa/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');

        // Route Prestasi
        Route::prefix('prestasi')->group(function () {
            Route::get('/', [PrestasiController::class, 'index'])->name('prestasi');
            Route::get('/tambah', [PrestasiController::class, 'create'])->name('prestasi-tambah');
        });

        // Route Lomba
        Route::prefix('lomba')->group(function () {
            Route::get('/', [LombaController::class, 'index'])->name('lomba');
            Route::get('/tambah', [LombaController::class, 'create'])->name('lomba-tambah');
        });

        // Route Laporan
        Route::prefix('laporan')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('laporan');
        });

        // Route Profile
        Route::get('/profile', [MahasiswaProfileController::class, 'index'])->name('mahasiswa.profile');
    });

    // Admin Routes
    Route::middleware(['role:' . UserRoleEnum::ADMIN->value])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
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
                Route::get('/{id}/detail', [KelolaPrestasiController::class, 'detail'])->name('admin.detail-prestasi');
            });
            // Lomba
            Route::prefix('kelola-lomba')->group(function () {
                Route::get('/daftar', [KelolaLombaController::class, 'daftar'])->name('admin.daftar-lomba');
                Route::get('/tambah', [KelolaLombaController::class, 'tambah'])->name('admin.tambah-lomba');
                Route::get('/{id}/detail', [KelolaLombaController::class, 'detail'])->name('admin.lomba.detail');
            });
            // Akademik
            Route::prefix('kelola-akademik')->group(function () {
               Route::get('/program-studi', [KelolaAkademikController::class, 'prodi'])->name('admin.program-studi');
               Route::get('/periode', [KelolaAkademikController::class, 'periode'])->name('admin.periode');
            });
            // Laporan
            Route::prefix('laporan')->group(function () {
                Route::get('/', [AdminLaporanController::class, 'index'])->name('admin.laporan');
            });
        });
    });
    //Rekomendasi
    Route::prefix('rekomendasi')->group(function () {
        Route::get('/rekomendasi-vikor', [RekomendasiController::class, 'rekomendasiVikor'])->name('admin.rekomendasi-vikor');
        Route::get('/rekomendasi-smart', [RekomendasiController::class, 'rekomendasiSmart'])->name('admin.rekomendasi-smart');
    });
    

    // Dosen Routes
    Route::middleware(['role:' . UserRoleEnum::DOSEN->value])->group(function () {
        Route::get('/dosen/dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');
        Route::get('/dosen/verifikasi-prestasi', [VerifikasiPrestasiController::class, 'index'])->name('dosen.verifikasi-prestasi');
    });
});
// Route for Admin

Route::prefix('dosen')->group(function () {
    Route::get('/dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');
    Route::get('/manajemen-mahasiswa', [ManajemenMahasiswaController::class, 'index'])->name('dosen.manajemen-mahasiswa');
    
    Route::prefix('kelola-lomba')->group(function () {
        Route::get('/daftar', [DosenLombaController::class, 'daftar'])->name('dosen.daftar-lomba');
        Route::get('/tambah', [DosenLombaController::class, 'tambah'])->name('dosen.tambah-lomba');
    });
});