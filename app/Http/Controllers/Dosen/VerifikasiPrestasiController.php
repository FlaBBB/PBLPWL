<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifikasiPrestasiController extends Controller
{
    public function index()
    {
        $activeMenu = 'verifikasi-prestasi';
        $role = 'dosen';

        return view('dosen.verifikasi-prestasi', [
            'activeMenu' => $activeMenu,
            'role' => $role,
        ]);
    }
}
