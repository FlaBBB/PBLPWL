<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaLombaController extends Controller
{
    public function daftar()
    {
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('admin.daftar-lomba')
            ],
        ];

        $headerTitle = 'Kelola Lomba';
        $headerDesc = 'Kelola lomba yang ada di dalam sistem.';

        return view('admin.daftar-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function tambah()
    {
        $activeMenu = 'tambah-lomba';
        $breadcrumbs = [
            [
                'label' => 'Tambah Lomba',
                'url' => route('admin.tambah-lomba')
            ],
        ];

        $headerTitle = 'Tambah Lomba';
        $headerDesc = 'Tambah lomba baru ke dalam sistem.';

        return view('admin.tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function detail($id)
    {
        $activeMenu = 'daftar-lomba'; // Or a new menu item for detail
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('admin.daftar-lomba')
            ],
            [
                'label' => 'Detail Lomba',
                'url' => route('admin.lomba.detail', $id)
            ],
        ];

        $headerTitle = 'Detail Lomba';
        $headerDesc = 'Detail informasi mengenai lomba.';

        // In a real application, you would fetch the lomba data using the $id
        // For now, we'll just pass the ID to the view.
        $lomba = ['id' => $id, 'name' => 'Lomba ' . $id]; // Placeholder data

        return view('admin.detail-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'lomba' => $lomba,
        ]);
    }
}
