<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function daftar()
    {
        
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('dosen.daftar-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';

        return view('dosen.daftar-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function tambah()
    {
        // Logic to display the form for adding a new competition
        $activeMenu = 'tambah-lomba';
        $breadcrumbs = [
            [
                'label' => 'Tambah Lomba',
                'url' => route('dosen.tambah-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('dosen.tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
    public function detail()
    {
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('dosen.daftar-lomba')
            ],
            [
                'label' => 'Detail Lomba',
                'url' => route('dosen.detail-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('dosen.detail-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
    public function histori()
    {
        $activeMenu = 'tambah-lomba';
        $breadcrumbs = [
            [
                'label' => 'Riwayat Tambah Lomba',
                'url' => route('dosen.histori-tambah-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('dosen.histori-tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
