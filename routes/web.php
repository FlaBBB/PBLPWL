<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\PrestasiController;
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


Route::get('/', function () {
    return view('landingpages.home');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('prestasi.dashboard');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/lomba', [LombaController::class, 'index'])->name('lomba');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

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