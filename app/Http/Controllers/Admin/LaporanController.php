<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Competition;
use App\Models\Mahasiswa;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function index()
    {
        // Total Prestasi
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;

        $totalAchievementsCurrentYear = Achievement::whereYear('upload_at', $currentYear)->count();
        $totalAchievementsPreviousYear = Achievement::whereYear('upload_at', $previousYear)->count();

        $percentageChange = 0;
        $isIncrease = true;

        if ($totalAchievementsPreviousYear > 0) {
            $percentageChange = (($totalAchievementsCurrentYear - $totalAchievementsPreviousYear) / $totalAchievementsPreviousYear) * 100;
            $isIncrease = $percentageChange >= 0;
            $percentageChange = abs($percentageChange);
        }

        // Total Prestasi (overall)
        $totalAchievements = Achievement::count();

        // Prestasi per Tahun
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

        $achievementsPerYear = Achievement::select(
                DB::raw("$yearFunction as year"),
                DB::raw('count(*) as total')
            )
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        // Prestasi per Program Studi
        $achievementsPerProdi = Mahasiswa::select(
                'prodi',
                DB::raw('count(DISTINCT mahasiswa_achievement.nim) as total_students'),
                DB::raw('count(achievement.id) as total_achievements')
            )
            ->join('mahasiswa_achievement', 'mahasiswa.nim', '=', 'mahasiswa_achievement.nim')
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->groupBy('prodi')
            ->orderBy('prodi', 'asc')
            ->get();

        // Tingkat Lomba
        $achievementsPerLevel = Competition::select(
                'level',
                DB::raw('count(*) as total')
            )
            ->groupBy('level')
            ->orderBy('level', 'asc')
            ->get();

        // Distribusi Capaian
        $achievementsPerCapaian = Achievement::select(
                DB::raw("CASE
                    WHEN place = 1 THEN 'Juara 1'
                    WHEN place = 2 THEN 'Juara 2'
                    WHEN place = 3 THEN 'Juara 3'
                    ELSE 'Lainnya'
                END as capaian"),
                DB::raw('count(*) as total')
            )
            ->groupBy('capaian')
            ->orderBy('capaian', 'asc')
            ->get();

        // Kategori Lomba
        $achievementsPerCategory = Achievement::select(
                'tag.name as category',
                DB::raw('count(achievement.id) as total')
            )
            ->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        $threshold = $totalAchievements * 0.02; // 2% threshold
        $filteredCategories = collect();
        $otherCategoriesTotal = 0;

        foreach ($achievementsPerCategory as $category) {
            if ($category->total >= $threshold) {
                $filteredCategories->push($category);
            } else {
                $otherCategoriesTotal += $category->total;
            }
        }

        if ($otherCategoriesTotal > 0) {
            $filteredCategories->push((object)[
                'category' => 'Lainnya',
                'total' => $otherCategoriesTotal
            ]);
        }

        $achievementsPerCategory = $filteredCategories;

        return view('admin.laporan', compact(
            'totalAchievements',
            'achievementsPerYear',
            'achievementsPerProdi',
            'achievementsPerLevel',
            'achievementsPerCapaian',
            'achievementsPerCategory',
            'percentageChange',
            'isIncrease'
        ));
    }
    
    
}
