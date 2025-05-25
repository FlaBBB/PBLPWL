<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $activeMenu = 'prestasi';
        $activeSubmenu = 'daftarPrestasi';

        return view('prestasi.index', [
            'activeMenu' => $activeMenu,
            'activeSubmenu' => $activeSubmenu
        ]);
    }
public function tambah()
{
    $activeMenu = 'prestasi';
    $activeSubmenu = 'tambah'; // ubah dari 'tambahPrestasi' ke 'tambah'

    return view('prestasi.tambah', [
        'activeMenu' => $activeMenu,
        'activeSubmenu' => $activeSubmenu
    ]);
}
}
