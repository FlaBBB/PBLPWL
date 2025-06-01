<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function rekomendasiVikor()
    {
        $activeMenu = 'rekomendasi-vikor';
        $breadcrumbs = [
            [
                'label' => 'Rekomendasi VIKOR',
                'url' => route('admin.rekomendasi-vikor')
            ],
        ];

        $headerTitle = 'Rekomendasi';
        $headerDesc = 'Rekomendasi peserta lomba berdasarkan data mahasiswa.';

        return view('admin.rekomendasi-vikor', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
    public function rekomendasiSmart()
    {
        $activeMenu = 'rekomendasi-smart';
        $breadcrumbs = [
            [
                'label' => 'Rekomendasi SMART',
                'url' => route('admin.rekomendasi-smart')
            ],
        ];

        $headerTitle = 'Rekomendasi';
        $headerDesc = 'Rekomendasi peserta lomba berdasarkan data mahasiswa.';

        return view('admin.rekomendasi-smart', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
