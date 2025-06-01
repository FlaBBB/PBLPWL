<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanAdminController extends Controller
{
    public function index()
    {
        $activeMenu = 'laporan';
        $breadcrumbs = [
            [
                'label' => 'Laporan',
                'url' => route('admin.laporan')
            ],
        ];

        $headerTitle = 'Laporan';
        $headerDesc = 'Kelola laporan yang ada di dalam sistem.';

        return view('admin.laporan', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
