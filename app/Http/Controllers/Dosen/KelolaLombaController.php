<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaLombaController extends Controller
{
    public function daftar()
    {
        // Logic to display the list of competitions
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('dosen.daftar-lomba')
            ],
        ];
        $headerTitle = 'Kelola Lomba';
        $headerDesc = 'Pantau dan atur daftar lomba dengan mudah. Jelajahi katalog lomba dan tambahkan lomba baru hanya dalam beberapa klik.';

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
        $headerTitle = 'Kelola Lomba';
        $headerDesc = 'Pantau dan atur daftar lomba dengan mudah. Jelajahi katalog lomba dan tambahkan lomba baru hanya dalam beberapa klik.';
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
        $headerTitle = 'Kelola Lomba';
        $headerDesc = 'Pantau dan atur daftar lomba dengan mudah. Jelajahi katalog lomba dan tambahkan lomba baru hanya dalam beberapa klik.';
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
                'url' => route('dosen.histori-lomba')
            ],
        ];
        $headerTitle = 'Kelola Lomba';
        $headerDesc = 'Pantau dan atur daftar lomba dengan mudah. Jelajahi katalog lomba dan tambahkan lomba baru hanya dalam beberapa klik.';
        return view('dosen.histori-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}