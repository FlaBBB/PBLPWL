<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaPenggunaController extends Controller
{
    public function index()
    {
        $activeMenu = 'kelola-mahasiswa';
        $breadcrumbs = [
            [
                'label' => 'Kelola Mahasiswa',
                'url' => route('admin.kelola-mahasiswa')
            ],
        ];

        $headerTitle = 'Kelola Pengguna';
        $headerDesc = 'Kelola pengguna yang ada di dalam sistem.';

        return view('admin.kelola-mahasiswa', [
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
        $headerTitle = 'Kelola Pengguna';
        $headerDesc = 'Kelola pengguna yang ada di dalam sistem.';

        return view('admin.kelola-dosen', [
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

        $headerTitle = 'Kelola Pengguna';
        $headerDesc = 'Kelola pengguna yang ada di dalam sistem.';

        return view('admin.kelola-admin', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
