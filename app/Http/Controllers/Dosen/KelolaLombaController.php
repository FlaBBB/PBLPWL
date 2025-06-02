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
        $headerTitle = 'Daftar Lomba';
        $headerDesc = 'Daftar data lomba yang ada di dalam sistem.';

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
        $headerTitle = 'Tambah Lomba';
        $headerDesc = 'Form untuk menambahkan lomba baru.';
        return view('dosen.tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}