<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\LombaController;
use App\Http\Controllers\Mahasiswa\LaporanController;
use App\Http\Controllers\Mahasiswa\AchievementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KelolaUserController;
use App\Http\Controllers\Admin\KelolaAchievementController;
use App\Http\Controllers\Admin\KelolaLombaController;
use App\Http\Controllers\Admin\KelolaAkademikController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\RekomendasiController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Dosen\VerifikasiAchievementController;
use App\Http\Controllers\Dosen\ManajemenMahasiswaController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Dosen\ProfileController as DosenProfileController;
use App\Http\Controllers\AuthController; // Import AuthController
use App\Enums\UserRoleEnum; // Import UserRoleEnum
use App\Http\Controllers\Dosen\MahasiswaBimbinganController;
use App\Http\Controllers\Dosen\LombaController as DosenLombaController;
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

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');

        // Route Achievement
        Route::prefix('achievement')->group(function () {
            Route::get('/daftar-achievement', [AchievementController::class, 'daftar'])->name('mahasiswa.daftar-achievement');
            Route::get('/tambah-achievement', [AchievementController::class, 'tambah'])->name('mahasiswa.tambah-achievement');
            Route::post('/store', [AchievementController::class, 'store'])->name('mahasiswa.store-achievement');
            Route::get('/detail/{id}', [AchievementController::class, 'detail'])->name('mahasiswa.detail-achievement');
            Route::get('/{id}/edit', [AchievementController::class, 'edit'])->name('mahasiswa.edit-achievement');
            Route::put('/{id}', [AchievementController::class, 'update'])->name('mahasiswa.update-achievement');
            Route::get('/data', [AchievementController::class, 'getData'])->name('mahasiswa.achievement.data');
        });
        // Route Lomba
        Route::prefix('lomba')->group(function () {
            Route::get('/daftar-lomba', [LombaController::class, 'daftar'])->name('mahasiswa.daftar-lomba');
            Route::get('/tambah-lomba', [LombaController::class, 'tambah'])->name('mahasiswa.tambah-lomba');
            Route::get('/{id}/detail-lomba', [LombaController::class, 'detail'])->name('mahasiswa.detail-lomba');
            Route::get('/histori-tambah-lomba', [LombaController::class, 'histori'])->name('mahasiswa.histori-tambah-lomba');
        });
        // Route Laporan
        Route::prefix('laporan')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('laporan');
        });
        // Route Profile
        Route::get('/profile', [MahasiswaProfileController::class, 'index'])->name('mahasiswa.edit-profile');
        Route::post('/profile', [MahasiswaProfileController::class, 'update'])->name('mahasiswa.update-profile');
        Route::delete('/profile/delete-picture', [MahasiswaProfileController::class, 'deleteProfilePicture'])->name('mahasiswa.delete-profile-picture');

            
       
    });

    // Admin Routes
    Route::middleware(['role:' . UserRoleEnum::ADMIN->value])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
            // Pengguna
            Route::prefix('kelola-pengguna')->group(function () {
                Route::get('/mahasiswa', [KelolaUserController::class, 'index'])->name('admin.kelola-mahasiswa');
                Route::get('/mahasiswa/create', [KelolaUserController::class, 'createMahasiswa'])->name('admin.kelola-mahasiswa.create');
                Route::post('/mahasiswa', [KelolaUserController::class, 'storeMahasiswa'])->name('admin.kelola-mahasiswa.store');
                Route::get('/mahasiswa/{nim}/edit', [KelolaUserController::class, 'editMahasiswa'])->name('admin.kelola-mahasiswa.edit');
                Route::put('/mahasiswa/{nim}', [KelolaUserController::class, 'updateMahasiswa'])->name('admin.kelola-mahasiswa.update');
                Route::delete('/mahasiswa/{nim}', [KelolaUserController::class, 'destroyMahasiswa'])->name('admin.kelola-mahasiswa.destroy');

                Route::get('/dosen', [KelolaUserController::class, 'dosen'])->name('admin.kelola-dosen');
                Route::get('/dosen/create', [KelolaUserController::class, 'createDosen'])->name('admin.kelola-dosen.create');
                Route::post('/dosen', [KelolaUserController::class, 'storeDosen'])->name('admin.kelola-dosen.store');
                Route::get('/dosen/{nidn}/edit', [KelolaUserController::class, 'editDosen'])->name('admin.kelola-dosen.edit');
                Route::put('/dosen/{nidn}', [KelolaUserController::class, 'updateDosen'])->name('admin.kelola-dosen.update');
                Route::delete('/dosen/{nidn}', [KelolaUserController::class, 'destroyDosen'])->name('admin.kelola-dosen.destroy');

                Route::get('/admin', [KelolaUserController::class, 'admin'])->name('admin.kelola-admin');
                Route::get('/admin/create', [KelolaUserController::class, 'createAdmin'])->name('admin.kelola-admin.create');
                Route::post('/admin', [KelolaUserController::class, 'storeAdmin'])->name('admin.kelola-admin.store');
                Route::get('/admin/{id}/edit', [KelolaUserController::class, 'editAdmin'])->name('admin.kelola-admin.edit');
                Route::put('/admin/{id}', [KelolaUserController::class, 'updateAdmin'])->name('admin.kelola-admin.update');
                Route::delete('/admin/{id}', [KelolaUserController::class, 'destroyAdmin'])->name('admin.kelola-admin.destroy');
            });
            // Achievement
            Route::prefix('kelola-achievement')->group(function () {
                Route::get('/verifikasi', [KelolaAchievementController::class, 'verifikasi'])->name('admin.verifikasi-achievement');
                Route::get('/daftar', [KelolaAchievementController::class, 'daftar'])->name('admin.daftar-achievement');
                Route::get('/{id}/show', [KelolaAchievementController::class, 'show'])->name('admin.achievement.show');
                Route::post('/{id}/approve', [KelolaAchievementController::class, 'approve'])->name('admin.achievement.approve');
                Route::post('/{id}/reject', [KelolaAchievementController::class, 'reject'])->name('admin.achievement.reject');
                Route::post('/{id}/revision', [KelolaAchievementController::class, 'revision'])->name('admin.achievement.revision');
            });
            // Lomba
            Route::prefix('kelola-lomba')->group(function () {
                Route::get('/daftar', [KelolaLombaController::class, 'daftar'])->name('admin.daftar-lomba');
                Route::get('/verifikasi', [KelolaLombaController::class, 'verifikasi'])->name('admin.verifikasi-lomba');
                Route::get('/{id}/show', [KelolaLombaController::class, 'show'])->name('admin.lomba.show');
                Route::post('/{id}/approve', [KelolaLombaController::class, 'approve'])->name('admin.lomba.approve');
                Route::post('/{id}/reject', [KelolaLombaController::class, 'reject'])->name('admin.lomba.reject');
                Route::post('/{id}/revision', [KelolaLombaController::class, 'revision'])->name('admin.lomba.revision');
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
        Route::prefix('dosen')->group(function () {

            Route::get('/dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');
            Route::get('/profile', [DosenProfileController::class, 'index'])->name('dosen.edit-profile');
            Route::post('/profile', [DosenProfileController::class, 'update'])->name('dosen.update-profile');
            Route::delete('/profile/delete-picture', [DosenProfileController::class, 'deleteProfilePicture'])->name('dosen.delete-profile-picture');
            Route::get('/verifikasi-achievement', [VerifikasiAchievementController::class, 'index'])->name('dosen.verifikasi-achievement');
            Route::get('/mahasiswa-bimbingan', [MahasiswaBimbinganController::class, 'index'])->name('dosen.mahasiswa-bimbingan');
            Route::get('/mahasiswa-bimbingan/{id}/details', [MahasiswaBimbinganController::class, 'getAchievementDetails'])->name('dosen.mahasiswa-bimbingan.details');

            Route::get('/histori-tambah-lomba', [DosenLombaController::class, 'histori'])->name('dosen.histori-tambah-lomba');
            
            Route::prefix('kelola-lomba')->group(function () {
                Route::get('/daftar', [DosenLombaController::class, 'daftar'])->name('dosen.daftar-lomba');
                Route::get('/tambah', [DosenLombaController::class, 'tambah'])->name('dosen.tambah-lomba');
                Route::get('/{id}/detail', [DosenLombaController::class, 'detail'])->name('dosen.detail-lomba');
            });
        });
        });
});
