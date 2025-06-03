<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaBimbinganController extends Controller
{
    public function index()
    {
        $activeMenu = 'mahasiswa-bimbingan';
        $breadcrumbs = [
            [
                'label' => 'Mahasiswa Bimbingan',
                'url' => route('dosen.mahasiswa-bimbingan')
            ]
        ];
        $headerTitle = 'Mahasiswa Bimbingan';
        $headerDesc = 'Lihat daftar mahasiswa bimbingan dan riwayat bimbingan yang pernah dilakukan.';

        return view('dosen.mahasiswa-bimbingan', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
