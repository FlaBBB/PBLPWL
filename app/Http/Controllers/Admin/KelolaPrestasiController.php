<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaPrestasiController extends Controller
{
    public function verifikasi()
    {
        $activeMenu = 'verifikasi-prestasi';
        $breadcrumbs = [
            [
                'label' => 'Verifikasi Prestasi',
                'url' => route('admin.verifikasi-prestasi')
            ],
        ];

        $headerTitle = 'Verifikasi Prestasi';
        $headerDesc = 'Verifikasi prestasi yang diajukan oleh mahasiswa.';

        return view('admin.verifikasi-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function daftar()
    {
        $activeMenu = 'daftar-prestasi';
        $breadcrumbs = [
            [
                'label' => 'Daftar Prestasi',
                'url' => route('admin.daftar-prestasi')
            ],
        ];

        $headerTitle = 'Daftar Prestasi';
        $headerDesc = 'Kelola daftar prestasi yang ada di dalam sistem.';

        return view('admin.daftar-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
   public function detail($id)
{
    $activeMenu = 'detail-prestasi';
    $breadcrumbs = [
        [
            'label' => 'Detail Prestasi',
            'url' => route('admin.detail-prestasi', ['id' => $id])
        ],
    ];
    $headerTitle = 'Detail Prestasi';
    $headerDesc = 'Lihat detail prestasi yang telah diajukan oleh mahasiswa.';
    // Logika untuk mengambil data berdasarkan $id
    // return view('admin.detail-prestasi', [
    //     'activeMenu' => $activeMenu,
    //     'breadcrumbs' => $breadcrumbs,
    //     'headerTitle' => $headerTitle,
    //     'headerDesc' => $headerDesc,
    //     'prestasi' => Prestasi::findOrFail($id), 
    // ]);
}
}
