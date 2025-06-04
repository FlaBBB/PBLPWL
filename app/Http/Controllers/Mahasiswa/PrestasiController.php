<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Mahasiswa;
use App\Models\Tag;
use App\Models\MahasiswaAchievement;
use App\Models\Dosen; // Import Dosen model
use App\Models\RoleSupervisor; // Import RoleSupervisor model
use App\Models\SupervisorAchievement; // Import SupervisorAchievement model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Support\Facades\Validator; // Import Validator facade
use App\Enums\CompetitionLevelEnum;
use App\Enums\AchievementStatusEnum;
use Yajra\DataTables\DataTables;
use App\Helpers\NotificationHelper; // Import NotificationHelper

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
            NotificationHelper::error('Mahasiswa data not found.');
            return redirect()->back();
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
                        $statusClass = 'bg-gray-100 text-gray-700';
                        $statusDotClass = 'bg-gray-500';
                        break;
                    case 'REVISION':
                        $statusText = 'Revisi';
                        $statusClass = 'bg-red-100 text-red-700';
                        $statusDotClass = 'bg-red-500';
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
        $tags = Tag::orderBy('name')->get(); // Fetch all tags ordered lexically by name
        $mahasiswaList = Mahasiswa::orderBy('name')->get(['nim', 'name']); // Fetch all mahasiswa
        $dosenList = Dosen::orderBy('name')->get(['nidn', 'name']); // Fetch all dosen
        $roleSupervisorList = RoleSupervisor::orderBy('description')->get(['id', 'description']); // Fetch all roles for supervisors

        return view('mahasiswa.prestasi.tambah-prestasi', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'tags' => $tags, // Pass tags to the view
            'mahasiswaList' => $mahasiswaList, // Pass mahasiswa list to the view
            'dosenList' => $dosenList, // Pass dosen list to the view
            'roleSupervisorList' => $roleSupervisorList, // Pass role supervisor list to the view
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();

        if (!$mahasiswa) {
            NotificationHelper::error('Mahasiswa data not found.');
            return redirect()->back();
        }

        // 1. Validate the incoming data
        $validator = Validator::make($request->all(), [
            'competition_name' => 'required|string|max:255',
            'competition_name_english' => 'nullable|string|max:255',
            'competition_location' => 'required|string|max:255',
            'competition_location_english' => 'nullable|string|max:255',
            'assignment_letter_number' => 'required|string|max:255',
            'assignment_letter_date' => 'required|date',
            'pt_partition_number' => 'required|integer',
            'partition_number' => 'required|integer',
            'place' => 'required|integer',
            'level' => 'required|in:' . implode(',', array_column(CompetitionLevelEnum::cases(), 'value')),
            'competition_type' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'competition_url' => 'nullable|url|max:255',
            'note' => 'nullable|string',
            'file_assignment_letter' => 'required|file|mimes:pdf|max:2048', // 2MB Max
            'file_certificate' => 'required|file|mimes:pdf|max:2048',
            'file_poster' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'file_activity_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'nim_mahasiswa.*' => 'required|string|max:255', // Changed from nama_mahasiswa to nim_mahasiswa
            'peran_mahasiswa.*' => 'required|in:LEADER,MEMBER,PERSONAL', // Updated roles based on MahasiswaAchievementRoleEnum
            'tags_mahasiswa.*' => 'nullable|exists:tag,id', // Validate against tag table IDs
            'nidn_dosen.*' => 'required|string|max:255', // Changed from nama_dosen to nidn_dosen
            'peran_dosen.*' => 'required|exists:role_supervisor,id', // Validate against role_supervisor table IDs
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error);
            }
            return redirect()->back()->withInput();
        }

        $validatedData = $validator->validated();

        // 2. Handle file uploads
        $filePaths = [];
        foreach (['file_assignment_letter', 'file_certificate', 'file_poster', 'file_activity_photo'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $fileName = time() . '_' . $request->file($fileField)->getClientOriginalName();
                $filePath = $request->file($fileField)->storeAs('uploads/achievements', $fileName, 'public');
                $filePaths[$fileField] = $filePath;
            }
        }

        // 3. Create a new Achievement record
        $achievement = Achievement::create([
            'upload_at' => now(),
            'competition_type' => $validatedData['competition_type'],
            'competition_name' => $validatedData['competition_name'],
            'competition_name_english' => $validatedData['competition_name_english'],
            'competition_location' => $validatedData['competition_location'],
            'competition_location_english' => $validatedData['competition_location_english'],
            'competition_url' => $validatedData['competition_url'],
            'start_at' => $validatedData['start_at'],
            'end_at' => $validatedData['end_at'],
            'pt_partition_number' => $validatedData['pt_partition_number'],
            'partition_number' => $validatedData['partition_number'],
            'assignment_letter_number' => $validatedData['assignment_letter_number'],
            'assignment_letter_date' => $validatedData['assignment_letter_date'],
            'file_assignment_letter' => $filePaths['file_assignment_letter'] ?? null,
            'file_certificate' => $filePaths['file_certificate'] ?? null,
            'file_activity_photo' => $filePaths['file_activity_photo'] ?? null,
            'file_poster' => $filePaths['file_poster'] ?? null,
            'level' => CompetitionLevelEnum::from($validatedData['level']),
            'place' => $validatedData['place'],
            'status' => AchievementStatusEnum::WAITING, // Default status
            'note' => $validatedData['note'],
            'verificator' => null, // Will be set by admin
            'verified_at' => null,
        ]);

        // 4. Associate the achievement with Mahasiswa
        if (isset($validatedData['nim_mahasiswa'])) {
            foreach ($validatedData['nim_mahasiswa'] as $key => $nim_mahasiswa) {
                $mahasiswaRecord = Mahasiswa::where('nim', $nim_mahasiswa)->first();
                if (!$mahasiswaRecord) {
                    // If mahasiswa not found, log a warning and skip or handle as appropriate
                    Log::warning("Mahasiswa with NIM '{$nim_mahasiswa}' not found when creating achievement.");
                    continue; // Skip this entry if student not found
                }

                MahasiswaAchievement::create([
                    'nim' => $mahasiswaRecord->nim,
                    'id_achievement' => $achievement->id,
                    'role' => $validatedData['peran_mahasiswa'][$key],
                    'id_tag' => $validatedData['tags_mahasiswa'][$key] ?? null,
                ]);
            }
        }

        // 5. Associate the achievement with Dosen (Supervisors)
        if (isset($validatedData['nidn_dosen'])) {
            foreach ($validatedData['nidn_dosen'] as $key => $nidn_dosen) {
                $dosenRecord = Dosen::where('nidn', $nidn_dosen)->first();
                if ($dosenRecord) {
                    SupervisorAchievement::create([
                        'nidn' => $dosenRecord->nidn,
                        'id_achievement' => $achievement->id,
                        'role' => $validatedData['peran_dosen'][$key],
                    ]);
                } else {
                    Log::warning("Dosen with NIDN '{$nidn_dosen}' not found when creating achievement.");
                }
            }
        }


        NotificationHelper::success('Prestasi berhasil ditambahkan!');
        return redirect()->route('mahasiswa.daftar-prestasi');
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
