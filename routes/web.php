<?php

use Illuminate\Support\Facades\Route;

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
    return view('template.template');
});
