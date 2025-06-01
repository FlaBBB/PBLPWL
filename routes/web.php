<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\LombaController;
use App\Http\Controllers\Mahasiswa\LaporanController;
use App\Http\Controllers\Mahasiswa\PrestasiController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KelolaPenggunaController;
use App\Http\Controllers\Admin\KelolaPrestasiController;
use App\Http\Controllers\Admin\KelolaLombaController;
use App\Http\Controllers\Admin\KelolaAkademikController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\RekomendasiController;
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

// <!-- Route for landing page -->

Route::get('/', function () {
    return view('landingpages.home');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('prestasi.dashboard');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/lomba', [LombaController::class, 'index'])->name('lomba');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

// Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
// Route::get('/profile/edit', [MahasiswaController::class, 'edit_profile'])->name('edit_profile');

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
    });

    // Admin Routes
    Route::middleware(['role:' . UserRoleEnum::ADMIN->value])->group(function () {
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
    });
    //Rekomendasi
    Route::prefix('rekomendasi')->group(function () {
        Route::get('/rekomendasi-vikor', [RekomendasiController::class, 'rekomendasiVikor'])->name('admin.rekomendasi-vikor');
        Route::get('/rekomendasi-smart', [RekomendasiController::class, 'rekomendasiSmart'])->name('admin.rekomendasi-smart');
    });
    

    // Dosen Routes (assuming a Dosen role exists and needs a dashboard)
    Route::middleware(['role:' . UserRoleEnum::DOSEN->value])->group(function () {
        Route::get('/dosen/dashboard', function () {
            return view('dosen.dashboard'); // Assuming a dosen dashboard view
        })->name('dosen.dashboard');
        Route::get('/dosen/verifikasi-prestasi', function () {
            return view('dosen.verifikasi-prestasi'); // Assuming a dosen verification view
        })->name('dosen.verifikasi-prestasi');
    });
});
