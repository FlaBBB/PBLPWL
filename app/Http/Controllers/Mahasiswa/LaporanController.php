<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $activeMenu = 'laporan';
        $breadcrumbs = [
            [
                'label' => 'Laporan',
                'url' => route('laporan')
            ]
        ];

        $headerTitle = 'Laporan';
        $headerDesc = 'Berikut adalah laporan yang telah Anda buat.';

        return view('mahasiswa.laporan.index', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc
        ]);
    }
}
