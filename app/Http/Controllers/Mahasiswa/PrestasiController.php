<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $activeMenu = 'prestasi';
        $breadcrumbs = [
            [
                'label' => 'Daftar Prestasi',
                'url' => route('prestasi')
            ]
        ];

        $headerTitle = 'Daftar Prestasi';
        $headerDesc = 'Berikut adalah daftar prestasi yang telah Anda capai.';

        return view('mahasiswa.prestasi.index', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc
        ]);
    }

    public function create()
    {
        $activeMenu = 'prestasi-tambah';
        $breadcrumbs = [
            [
                'label' => 'Tambah Prestasi',
                'url' => route('prestasi')
            ]
        ];

        $headerTitle = 'Tambah Prestasi';
        $headerDesc = 'Silakan isi form berikut untuk menambahkan prestasi baru.';

        return view('mahasiswa.prestasi.tambah', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc
        ]);
    }
}
