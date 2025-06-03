<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Mahasiswa;
use App\Models\Tag;
use App\Models\MahasiswaAchievement;
use Illuminate\Support\Facades\Auth;
use App\Enums\CompetitionLevelEnum;
use App\Enums\AchievementStatusEnum;
use Yajra\DataTables\DataTables;

class PrestasiController extends Controller
{
    public function daftar(Request $request)
    {
        $activeMenu = 'daftar-prestasi';
        $breadcrumbs = [
            [
                'label' => 'Daftar Prestasi',
                'url' => route('mahasiswa.daftar-prestasi')
            ],
        ];
        $headerTitle = 'Prestasi';
        $headerDesc = 'Lihat dan pantau seluruh prestasi yang telah Anda unggah selama masa studi. Pastikan setiap prestasi disertai bukti sah seperti sertifikat atau surat keterangan resmi.';

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa data not found.');
        }

        $query = Achievement::query()
            ->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->where('mahasiswa_achievement.nim', $mahasiswa->nim)
            ->leftJoin('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->select('achievement.*', 'tag.name as tag_name')
            ->distinct();

        // Apply search filter
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('achievement.competition_name', 'like', '%' . $search . '%')
                  ->orWhere('achievement.competition_type', 'like', '%' . $search . '%');
            });
        }

        // Apply category filter (tag name)
        if ($request->has('kategori') && $request->input('kategori') != '') {
            $kategori = $request->input('kategori');
            $query->where('tag.name', $kategori);
        }

        // Apply level filter
        if ($request->has('tingkat') && $request->input('tingkat') != '') {
            $tingkat = $request->input('tingkat');
            $query->where('achievement.level', CompetitionLevelEnum::from($tingkat));
        }

        // Apply status filter
        if ($request->has('status') && $request->input('status') != '') {
            $status = $request->input('status');
            $query->where('achievement.status', AchievementStatusEnum::from($status));
        }

        // Order by latest upload
        $query->orderBy('achievement.upload_at', 'desc');

        // Select distinct achievements and tag name to avoid duplicates due to joins
        $achievements = $query->distinct()->paginate(10);

        $categories = Tag::all(); // Fetch all tags for the dropdown

        return view('mahasiswa.prestasi.daftar-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'achievements' => $achievements,
            'currentSearch' => $request->input('search', ''),
            'currentKategori' => $request->input('kategori', ''),
            'currentTingkat' => $request->input('tingkat', ''),
            'currentStatus' => $request->input('status', ''),
            'categories' => $categories, // Pass categories to the view
        ]);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();

        if (!$mahasiswa) {
            return response()->json(['data' => []]);
        }

        $query = Achievement::query()
            ->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->where('mahasiswa_achievement.nim', $mahasiswa->nim)
            ->leftJoin('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->select('achievement.*', 'tag.name as tag_name')
            ->distinct();

        // Apply filters from DataTables request
        if ($request->filled('search')) {
            $searchValue = $request->input('search');
            $query->where(function ($q) use ($searchValue) {
                $q->where('achievement.competition_name', 'like', '%' . $searchValue . '%')
                  ->orWhere('tag.name', 'like', '%' . $searchValue . '%')
                  ->orWhere('achievement.place', 'like', '%' . $searchValue . '%')
                  ->orWhere('achievement.level', 'like', '%' . $searchValue . '%')
                  ->orWhere('achievement.status', 'like', '%' . $searchValue . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('tag.name', $request->input('kategori'));
        }
        if ($request->filled('tingkat')) {
            $query->where('achievement.level', CompetitionLevelEnum::from($request->input('tingkat')));
        }
        if ($request->filled('status')) {
            $query->where('achievement.status', AchievementStatusEnum::from($request->input('status')));
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tag_name', function($achievement) {
                return $achievement->tag_name ?? $achievement->competition_type;
            })
            ->addColumn('level', function($achievement) {
                return $achievement->level->value;
            })
            ->addColumn('status', function($achievement) {
                $statusText = '';
                $statusClass = '';
                $statusDotClass = '';

                switch ($achievement->status->value) {
                    case 'ACCEPTED':
                        $statusText = 'Terverifikasi';
                        $statusClass = 'bg-green-100 text-green-700';
                        $statusDotClass = 'bg-green-500';
                        break;
                    case 'WAITING':
                        $statusText = 'Menunggu';
                        $statusClass = 'bg-yellow-100 text-yellow-700';
                        $statusDotClass = 'bg-yellow-500';
                        break;
                    case 'REJECTED':
                        $statusText = 'Ditolak';
                        $statusClass = 'bg-red-100 text-red-700';
                        $statusDotClass = 'bg-red-500';
                        break;
                    case 'REVISION':
                        $statusText = 'Revisi';
                        $statusClass = 'bg-blue-100 text-blue-700';
                        $statusDotClass = 'bg-blue-500';
                        break;
                    default:
                        $statusText = 'Unknown';
                        $statusClass = 'bg-gray-100 text-gray-700';
                        $statusDotClass = 'bg-gray-500';
                }
                return '<span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold ' . $statusClass . '"><span class="w-2 h-2 rounded-full ' . $statusDotClass . '"></span>' . $statusText . '</span>';
            })
            ->addColumn('action', function($achievement) {
                return '<div class="flex space-x-2"><button onclick="openDetailModal(' . $achievement->id . ')" class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white  px-2 py-2 rounded text-xs flex items-center gap-1" title="Lihat Detail"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>Lihat detail</button></div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function tambah()
    {
        // Logic to display the form for adding a new competition
        $activeMenu = 'tambah-prestasi';
        $breadcrumbs = [
            [
                'label' => 'Tambah Prestasi',
                'url' => route('mahasiswa.tambah-prestasi')
            ],
        ];
        $headerTitle = 'Prestasi';
        $headerDesc = 'Jelajahi daftar prestasi dan tambahkan prestasi baru dengan mudah.';
        return view('mahasiswa.prestasi.tambah-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
    public function detail($id)
    {
        $achievement = Achievement::find($id);

        if (!$achievement) {
            return response()->json(['message' => 'Achievement not found'], 404);
        }

        // Return achievement data as JSON
        return response()->json($achievement);
    }
}
