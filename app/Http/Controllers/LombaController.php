<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function index()
    {
        $activeMenu = 'lomba';
        $activeSubmenu = 'daftarLomba';

        return view('mahasiswa.lomba.daftarLomba', [
            'activeMenu' => $activeMenu,
            'activeSubmenu' => $activeSubmenu
        ]);
    }
    public function create()
    {
        $activeMenu = 'lomba';
        $activeSubmenu = 'createLomba';

        return view('mahasiswa.lomba.createLomba', [
            'activeMenu' => $activeMenu,
            'activeSubmenu' => $activeSubmenu
        ]);
    }

    public function detail()
    {
        $activeMenu = 'lomba';
        $activeSubmenu = 'daftarLomba';

        return view('mahasiswa.lomba.detailLomba', [
            'activeMenu' => $activeMenu,
            'activeSubmenu' => $activeSubmenu
        ]);
    }
}
