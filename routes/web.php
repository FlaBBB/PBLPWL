<?php

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

Route::get('/dashboard', function () {
    return view('layout.template');
});

Route::get('/overviewAdmin', function () {
    return view('admin.overview');
});

Route::get('/overviewDosen', function () {
    return view('dosen.overview');
});

Route::get('/overviewMahasiswa', function () {
    return view('mahasiswa.overview');
});
Route::get('/lombaMahasiswa', function () {
    return view('mahasiswa.lomba');
});
Route::get('/laporanMahasiswa', function () {
    return view('mahasiswa.laporan');
});
Route::get('/dapresMahasiswa', function () {
    return view('mahasiswa.dapres');
});
Route::get('/newpresMahasiswa', function () {
    return view('mahasiswa.newpres');
});