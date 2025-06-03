<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function daftar()
    {
        
        $activeMenu = 'daftar-prestasi';
        $breadcrumbs = [
            [
                'label' => 'Daftar Prestasi',
                'url' => route('mahasiswa.daftar-prestasi')
            ],
        ];
        $headerTitle = 'Prestasi';
        $headerDesc = 'Jelajahi katalog prestasi dan tambahkan prestasi baru dengan mudah.';

        return view('mahasiswa.prestasi.daftar-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function tambah()
    {
        // Logic to display the form for adding a new competition
        $activeMenu = 'tambah-prestasi';
        $breadcrumbs = [
            [
                'label' => 'Tambah Prestasi',
                'url' => route('mahasiswa.tambah-prestasi')
            ],
        ];
        $headerTitle = 'Prestasi';
        $headerDesc = 'Jelajahi daftar prestasi dan tambahkan prestasi baru dengan mudah.';
        return view('mahasiswa.prestasi.tambah-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
    public function detail()
    {
        $activeMenu = 'daftar-prestasi';
        $breadcrumbs = [
            [
                'label' => 'Daftar prestasi',
                'url' => route('mahasiswa.daftar-prestasi')
            ],
            [
                'label' => 'Detail Prestasi',
                'url' => route('mahasiswa.detail-prestasi')
            ],
        ];
        $headerTitle = 'Prestasi';
        $headerDesc = 'Jelajahi katalog prestasi dan tambahkan prestasi baru dengan mudah.';
        return view('mahasiswa.prestasi.detail-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
