<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SupervisorAchievement;
use App\Models\MahasiswaAchievement;

class MahasiswaBimbinganController extends Controller
{
    public function index(Request $request)
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

        $nidn = Auth::user()->dosen->nidn;
        $perPage = $request->input('perPage', 10);

        $achievements = SupervisorAchievement::where('nidn', $nidn)
            ->join('achievement', 'supervisor_achievement.id_achievement', '=', 'achievement.id')
            ->join('role_supervisor', 'supervisor_achievement.role', '=', 'role_supervisor.id')
            ->select('achievement.*', 'supervisor_achievement.role', 'role_supervisor.description as supervisor_role_description')
            ->distinct('achievement.id')
            ->paginate($perPage);
            
        return view('dosen.mahasiswa-bimbingan', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'achievements' => $achievements,
        ]);
    }

    public function getAchievementDetails(Request $request, $id_achievement)
    {
        $achievement = SupervisorAchievement::where('id_achievement', $id_achievement)
            ->where('nidn', Auth::user()->dosen->nidn)
            ->with(['achievement', 'roleSupervisor']) // Eager load achievement and roleSupervisor
            ->first();

        if (!$achievement) {
            return response()->json(['error' => 'Achievement not found or not supervised by this dosen.'], 404);
        }

        $mahasiswaList = MahasiswaAchievement::where('id_achievement', $id_achievement)
            ->join('mahasiswa', 'mahasiswa_achievement.nim', '=', 'mahasiswa.nim')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->select('mahasiswa.name', 'tag.name as mahasiswa_tag')
            ->get();

        return response()->json([
            'nama_lomba' => $achievement->achievement->competition_name,
            'bidang_lomba' => $achievement->achievement->competition_type,
            'tanggal_mulai' => \Carbon\Carbon::parse($achievement->achievement->start_at)->format('Y-m-d'),
            'tanggal_berakhir' => \Carbon\Carbon::parse($achievement->achievement->end_at)->format('Y-m-d'),
            'supervisor_role' => $achievement->roleSupervisor->description,
            'mahasiswa_list' => $mahasiswaList,
        ]);
    }
}
