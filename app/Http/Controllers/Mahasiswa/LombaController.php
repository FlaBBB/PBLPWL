<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function index()
    {
        $activeMenu = 'lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('lomba')
            ]
        ];
        
        $headerTitle = 'Daftar Lomba';
        $headerDesc = 'Berikut adalah daftar lomba yang Anda ikuti.';

        return view('mahasiswa.lomba.index', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc
        ]);
    }

    public function create()
    {
        $activeMenu = 'lomba-tambah';
        $breadcrumbs = [
            [
                'label' => 'Tambah Lomba',
                'url' => route('lomba')
            ]
        ];

        $headerTitle = 'Tambah Lomba';
        $headerDesc = 'Silakan isi form berikut untuk menambahkan lomba baru.';

        return view('mahasiswa.lomba.tambah', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc
        ]);
    }
}
