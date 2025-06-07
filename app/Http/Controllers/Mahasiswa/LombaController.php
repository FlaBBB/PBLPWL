<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Competition;

use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function daftar()
    {

        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('mahasiswa.daftar-lomba')
            ],
        ];

        $competition = Competition::with('tags')->paginate(request('perPage', 9)); // Fetch the competition by ID

        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';

        return view('mahasiswa.lomba.daftar-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'competition' => $competition,
        ]);
    }

    public function tambah()
    {
        // Logic to display the form for adding a new competition
        $activeMenu = 'tambah-lomba';
        $breadcrumbs = [
            [
                'label' => 'Tambah Lomba',
                'url' => route('mahasiswa.tambah-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('mahasiswa.lomba.tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
    public function detail($id)
    {
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('mahasiswa.daftar-lomba')
            ],
            [
                'label' => 'Detail Lomba',
                'url' => route('mahasiswa.detail-lomba', $id)
            ],
        ];

        $competition = Competition::with('tags')->findOrFail($id); // Fetch the competition by ID

        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('mahasiswa.lomba.detail-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'competition' => $competition,
        ]);
    }
    public function histori()
    {
        $activeMenu = 'tambah-lomba';
        $breadcrumbs = [
            [
                'label' => 'Riwayat Tambah Lomba',
                'url' => route('mahasiswa.histori-tambah-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('mahasiswa.lomba.histori-tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
