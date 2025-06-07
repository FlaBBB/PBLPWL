<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag; 
use App\Models\Competition;

class LombaController extends Controller
{
    public function daftar(Request $request)
    {
        
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('dosen.daftar-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';

        $kategoriList = Tag::pluck('name'); // Fetch all categories (tags) for the competition
        $tingkatList = Competition::select('level')->distinct()->get()->pluck('level'); // Fetch all distinct levels for the competition
        $partisipasi = Competition::select('max_participation_amount')->distinct()->get()->pluck('max_participation_amount'); // Fetch all distinct max participation amounts for the competition

        $query = Competition::with('tags');

        // Filter search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter kategori (by tag)
        if ($request->filled('kategori')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->kategori);
            });
        }

        // Filter tingkat
        if ($request->filled('tingkat')) {
            $query->where('level', $request->tingkat);
        }

        // Filter partisipan
        if ($request->filled('partisipan')) {
            if ($request->partisipan === 'Tim') {
                $query->where('max_participation_amount', '>', 1);
            } elseif ($request->partisipan === 'Individu') {
                $query->where('max_participation_amount', '=', 1);
            }
        }

        // Paginate hasil
        $competition = $query->paginate(9)->appends($request->query());

        return view('dosen.daftar-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'competition' => $competition,
            'kategoriList' => $kategoriList,
            'tingkatList' => $tingkatList,
            'partisipasi' => $partisipasi,
        ]);
    }

    public function tambah()
    {
        // Logic to display the form for adding a new competition
        $activeMenu = 'tambah-lomba';
        $breadcrumbs = [
            [
                'label' => 'Tambah Lomba',
                'url' => route('dosen.tambah-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('dosen.tambah-lomba', [
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
                'url' => route('dosen.daftar-lomba')
            ],
            [
                'label' => 'Detail Lomba',
                'url' => route('dosen.detail-lomba', $id)
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';

        $competition = Competition::with('tags')->findOrFail($id); // Fetch the competition by ID

        return view('dosen.detail-lomba', [
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
                'url' => route('dosen.histori-tambah-lomba')
            ],
        ];
        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('dosen.histori-tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
