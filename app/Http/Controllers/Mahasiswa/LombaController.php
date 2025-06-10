<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Tag;

use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function daftar(Request $request)
    {

        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('mahasiswa.daftar-lomba')
            ],
        ];

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

        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';

        return view('mahasiswa.lomba.daftar-lomba', [
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'level' => 'required|in:INTERNATIONAL,NATIONAL,PROVINCIAL,CITY',
            'category' => 'required|string|max:100',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'registration_deadline' => 'nullable|date',
            'max_participation_amount' => 'required|integer|min:1',
            'registration_link' => 'nullable|url',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'name',
            'organizer',
            'level',
            'category',
            'start_at',
            'end_at',
            'registration_deadline',
            'max_participation_amount',
            'registration_link',
            'description',
            'poster'
        ]);
        $data['creator'] = auth()->id();

        // Handle poster upload
        if ($request->hasFile('poster')) {
            $data['poster_url'] = $request->file('poster')->store('images', 'public');
        } else {
            $data['poster_url'] = 'images/poster.jpg'; // Default poster if none is uploaded
        }

        Competition::create($data);

        return redirect()->route('mahasiswa.histori-tambah-lomba')->with('success', 'Lomba berhasil ditambahkan!');
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

        $user = auth()->user();
        $achievements = Competition::where('creator', $user->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        $headerTitle = 'Lomba';
        $headerDesc = 'Jelajahi katalog lomba dan tambahkan lomba baru dengan mudah.';
        return view('mahasiswa.lomba.histori-tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'achievements' => $achievements,
        ]);
    }
}
