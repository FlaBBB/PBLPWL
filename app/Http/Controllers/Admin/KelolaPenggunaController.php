<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaPenggunaController extends Controller
{
    public function index()
    {
        $activeMenu = 'kelola-pengguna';
        $breadcrumbs = [
            [
                'label' => 'Kelola Mahasiswa',
                'url' => route('admin.kelola-pengguna')
            ],
        ];

        $headerTitle = 'Kelola Mahasiswa';
        $headerDesc = 'Kelola mahasiswa yang ada di dalam sistem.';

        return view('admin.kelola-pengguna', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function dosen()
    {
        $activeMenu = 'kelola-dosen';
        $breadcrumbs = [
            [
                'label' => 'Kelola Dosen',
                'url' => route('admin.kelola-dosen')
            ],
        ];

        $headerTitle = 'Kelola Dosen';
        $headerDesc = 'Kelola dosen yang ada di dalam sistem.';

        return view('admin.kelola-dosen', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
    
    public function dosenTambah()
    {
    $activeMenu = 'kelola-dosen-tambah';
    $breadcrumbs = [
        [
            'label' => 'Kelola Dosen',
            'url' => route('admin.kelola-dosen')
        ],
        [
            'label' => 'Tambah Dosen',
            'url' => route('admin.kelola-dosen-tambah')
        ],
    ];

    $headerTitle = 'Tambah Dosen';
    $headerDesc = 'Tambah dosen baru ke dalam sistem.';

    return view('admin.kelola-dosen-tambah', [
        'activeMenu' => $activeMenu,
        'breadcrumbs' => $breadcrumbs,
        'headerTitle' => $headerTitle,
        'headerDesc' => $headerDesc,
        ]);
    }

    public function admin()
    {
        $activeMenu = 'kelola-admin';
        $breadcrumbs = [
            [
                'label' => 'Kelola Admin',
                'url' => route('admin.kelola-admin')
            ],
        ];

        $headerTitle = 'Kelola Admin';
        $headerDesc = 'Kelola admin yang ada di dalam sistem.';

        return view('admin.kelola-admin', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
