<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaAchievement;
use App\Enums\AchievementStatusEnum;
use App\Models\Competition;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';
        $role = 'mahasiswa';

        return view('mahasiswa.dashboard', [
            'activeMenu' => $activeMenu,
            'role' => $role,
            'data' => $this->data()
        ]);
    }

    public function data(): array
    {
        $mahasiswa = Mahasiswa::query()
            ->where('id_user', Auth::user()->id)
            ->firstOrFail();

        $listPrestasi = MahasiswaAchievement::query()
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->where('mahasiswa_achievement.nim', $mahasiswa->nim)
            ->select(
                'mahasiswa_achievement.*',
                'achievement.competition_name',
                'achievement.place', // Changed alias to avoid conflict with PostgreSQL's rank() function
                'achievement.level',
                'achievement.status',
                'tag.name as tag_name'
            )
            ->orderBy('achievement.upload_at', 'desc')
            ->get();

        $totalPrestasi = $listPrestasi->count();
        
        $totalWaitedPrestasi = MahasiswaAchievement::query()
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->where('mahasiswa_achievement.nim', $mahasiswa->nim)
            ->where('achievement.status', AchievementStatusEnum::WAITING->value)
            ->count();

        $acceptedAchievementsByTag = MahasiswaAchievement::query()
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->where('mahasiswa_achievement.nim', $mahasiswa->nim)
            ->where('achievement.status', AchievementStatusEnum::ACCEPTED->value)
            ->select('tag.name')
            ->selectRaw('count(*) as total')
            ->groupBy('tag.name')
            ->get();

        $activeCompetition = Competition::getActiveCompetition();

        return [
            'listPrestasi' => $listPrestasi,
            'totalPrestasi' => $totalPrestasi,
            'totalWaitedPrestasi' => $totalWaitedPrestasi,
            'totalActiveCompetition' => $activeCompetition->count(),
            'acceptedAchievementsByTag' => $acceptedAchievementsByTag
        ];
    }
}
