<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaAchievement;
use App\Models\MahasiswaPreferences;
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
        $name = Mahasiswa::query()
            ->where('id_user', Auth::user()->id)
            ->value('name');

        $headerTitle = 'Welcome Back, ' . $name . ' 👋';
        $headerDesc = 'This is your dashboard, where you can manage all the data related to your achievements.';

        $mahasiswa = Mahasiswa::query()
            ->where('id_user', Auth::user()->id)
            ->firstOrFail();
        $hasPreferences = MahasiswaPreferences::where('nim', $mahasiswa->nim)->exists();

        $rekomendasiLomba = collect(); // Initialize as an empty collection
        if ($hasPreferences) {
            $rekomendasiLomba = Competition::getRecomendedCompetition($mahasiswa);
        }

        return view('mahasiswa.dashboard', [
            'activeMenu' => $activeMenu,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'role' => $role,
            'rekomendasiLomba' => $rekomendasiLomba,
            'hasPreferences' => $hasPreferences,
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
            ->limit(7)
            ->get();

        $totalPrestasi = MahasiswaAchievement::query()
            ->where('nim', $mahasiswa->nim)
            ->count();
        
        $totalWaitedPrestasi = MahasiswaAchievement::query()
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->where('mahasiswa_achievement.nim', $mahasiswa->nim)
            ->where('achievement.status', AchievementStatusEnum::WAITING->value)
            ->count();

        $totalRevisedPrestasi = MahasiswaAchievement::query()
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->where('mahasiswa_achievement.nim', $mahasiswa->nim)
            ->where('achievement.status', AchievementStatusEnum::REVISION->value)
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
            'totalRevisedPrestasi' => $totalRevisedPrestasi,
            'totalActiveCompetition' => $activeCompetition->count(),
            'acceptedAchievementsByTag' => $acceptedAchievementsByTag
        ];
    }
}
