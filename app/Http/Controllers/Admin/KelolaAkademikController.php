<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaAkademikController extends Controller
{
    public function prodi()
    {
        $activeMenu = 'program-studi';
        $breadcrumbs = [
            [
                'label' => 'Kelola Program Studi',
                'url' => route('admin.program-studi')
            ],
        ];

        $headerTitle = 'Kelola Akademik';
        $headerDesc = 'Kelola data Program Studi yang ada di dalam sistem.';

        return view('admin.kelola-program-studi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function periode()
    {
        $activeMenu = 'periode';
        $breadcrumbs = [
            [
                'label' => 'Kelola Periode',
                'url' => route('admin.periode')
            ],
        ];

        $headerTitle = 'Kelola Periode';
        $headerDesc = 'Kelola data Periode yang ada di dalam sistem.';

        return view('admin.kelola-periode', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
