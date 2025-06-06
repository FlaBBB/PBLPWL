<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Achievement;
use App\Models\Competition;
use App\Models\Mahasiswa;
use App\Enums\AchievementStatusEnum;
use App\Enums\CompetitionLevelEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';

        $name = Admin::query()
            ->where('id_user', auth()->user()->id)
            ->value('name');

        $headerTitle = 'Welcome Back, ' .  $name  . ' 👋';
        $headerDesc = 'This is your dashboard, where you can manage all the data related to the application.';
        $role = 'admin';

        $totalAchievements = Achievement::count();
        $pendingAchievements = Achievement::where('status', AchievementStatusEnum::WAITING)->count();
        $activeCompetitions = Competition::getActiveCompetition()->count();

        // Determine the database driver
        $driver = Config::get('database.default');
        $yearFunction = '';

        switch ($driver) {
            case 'pgsql':
                $yearFunction = 'EXTRACT(YEAR FROM achievement.upload_at)';
                break;
            case 'mysql':
                $yearFunction = 'YEAR(achievement.upload_at)';
                break;
            case 'sqlite':
                $yearFunction = 'strftime(\'%Y\', achievement.upload_at)';
                break;
            default:
                // Fallback for unknown drivers, or throw an exception
                $yearFunction = 'YEAR(achievement.upload_at)';
                break;
        }

        // Data for Prestasi per Tahun (Bar Chart)
        $achievementsPerYear = Achievement::select(DB::raw($yearFunction . ' as year'), DB::raw('count(*) as total'))
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        $yearLabels = $achievementsPerYear->pluck('year')->toArray();
        $yearData = $achievementsPerYear->pluck('total')->toArray();

        // Data for Prestasi per Program Studi (Pie Chart)
        $achievementsPerProdi = Achievement::join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->join('mahasiswa', 'mahasiswa_achievement.nim', '=', 'mahasiswa.nim')
            ->select('mahasiswa.prodi', DB::raw('count(*) as total'))
            ->groupBy('mahasiswa.prodi')
            ->get();

        $prodiLabels = $achievementsPerProdi->pluck('prodi')->toArray();
        $prodiData = $achievementsPerProdi->pluck('total')->toArray();

        // Data for Tingkat Lomba (Pie Chart)
        $achievementsPerLevel = Achievement::select('level', DB::raw('count(*) as total'))
            ->groupBy('level')
            ->get();

        $levelLabels = [];
        $levelData = [];
        foreach (CompetitionLevelEnum::cases() as $levelEnum) {
            $levelLabels[] = $levelEnum->value;
            $found = false;
            foreach ($achievementsPerLevel as $item) {
                if ($item->level->value === $levelEnum->value) {
                    $levelData[] = $item->total;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $levelData[] = 0;
            }
        }

        return view('admin.mainContent', [
            'activeMenu' => $activeMenu,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'role' => $role,
            'totalAchievements' => $totalAchievements,
            'pendingAchievements' => $pendingAchievements,
            'activeCompetitions' => $activeCompetitions,
            'yearLabels' => $yearLabels,
            'yearData' => $yearData,
            'prodiLabels' => $prodiLabels,
            'prodiData' => $prodiData,
            'levelLabels' => $levelLabels,
            'levelData' => $levelData,
        ]);
    }
}
