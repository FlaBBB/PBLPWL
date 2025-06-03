<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajemenMahasiswaController extends Controller
{
    public function index()
    {
        // Logic to display the list of students
        $activeMenu = 'manajemen-mahasiswa';
        $breadcrumbs = [
            [
                'label' => 'Manajemen Mahasiswa',
                'url' => route('dosen.manajemen-mahasiswa')
            ],
        ];
        $headerTitle = 'Manajemen Mahasiswa';
        $headerDesc = 'Kelola data mahasiswa yang ada di dalam sistem.';
        return view('dosen.manajemen-mahasiswa', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);

    }
}
