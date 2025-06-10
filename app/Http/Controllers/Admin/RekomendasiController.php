<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Dss\DecisionSupportHelper;
use App\Dss\Convertion;
use App\Models\Mahasiswa;
use App\Models\Achievement;
use App\Models\Dosen;
use App\Models\Tag;
use App\Models\User; // Added
use App\Models\Competition; // Added
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function rekomendasiVikor(Request $request)
    {
        $activeMenu = 'rekomendasi-vikor';
        $breadcrumbs = [
            [
                'label' => 'Rekomendasi VIKOR',
                'url' => route('admin.rekomendasi-vikor')
            ],
        ];

        $headerTitle = 'Rekomendasi';
        $headerDesc = 'Rekomendasi peserta lomba berdasarkan data mahasiswa.';

        $selectedCategory = $request->input('category');
        $alternatives = $this->prepareAlternatives($selectedCategory);
        $vikorResults = [];
        if (!empty($alternatives)) {
            $vikorResults = DecisionSupportHelper::calculateVikor($alternatives);
        }

        $categories = Tag::all();

        return view('admin.rekomendasi-vikor', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'vikorResults' => $vikorResults,
            'alternativesData' => $alternatives,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function rekomendasiSmart(Request $request)
    {
        $activeMenu = 'rekomendasi-smart';
        $breadcrumbs = [
            [
                'label' => 'Rekomendasi SMART',
                'url' => route('admin.rekomendasi-smart')
            ],
        ];

        $headerTitle = 'Rekomendasi';
        $headerDesc = 'Rekomendasi peserta lomba berdasarkan data mahasiswa.';

        $selectedCategory = $request->input('category');
        $alternatives = $this->prepareAlternatives($selectedCategory);
        $smartResults = [];
        if (!empty($alternatives)) {
            $smartResults = DecisionSupportHelper::calculateSmart($alternatives);
        }

        return view('admin.rekomendasi-smart', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'smartResults' => $smartResults,
            'alternativesData' => $alternatives,
            'recommendedDosen' => $this->getRecommendedDosen($request->input('category')),
            'categories' => Tag::all(),
            'selectedCategory' => $request->input('category'),
        ]);
    }

    private function prepareAlternatives(?string $category = null): array
    {
        $query = Mahasiswa::with(['mark', 'mahasiswaAchievements.achievement.mahasiswa']);

        if ($category) {
            $query->whereHas('mahasiswaAchievements', function ($q) use ($category) {
                $q->whereHas('tag', function ($q2) use ($category) {
                    $q2->where('name', $category);
                });
            });
        }

        $mahasiswas = $query->get();
        $alternatives = [];

        foreach ($mahasiswas as $mahasiswa) {
            $ipk = (float) ($mahasiswa->mark->ipk ?? 0); // Ensure IPK is a float

            $totalAchievementScore = 0;
            $achievementFrequency = 0;

            foreach ($mahasiswa->mahasiswaAchievements as $mahasiswaAchievement) {
                $achievement = $mahasiswaAchievement->achievement;

                if ($achievement) {
                    $placeScore = Convertion::placeToScore($achievement->place);
                    $levelScore = Convertion::levelCompetitionToScore($achievement->level);

                    // Calculate total members for this specific achievement
                    $totalMembers = $achievement->mahasiswa->count();
                    $teamScore = Convertion::totalMembersToScore($totalMembers);

                    $totalAchievementScore += ($placeScore + $levelScore + $teamScore);
                    $achievementFrequency++;
                }
            }

            $alternatives[] = [
                'name' => $mahasiswa->name,
                'IPK' => $ipk,
                'Achievement' => $totalAchievementScore,
                'Frequency' => $achievementFrequency,
            ];
        }

        return $alternatives;
    }

    private function getRecommendedDosen(?string $category = null): array
    {
        $query = Dosen::select('dosen.nidn', 'dosen.name', 'user.photo_profile', DB::raw('COUNT(DISTINCT supervisor_achievement.id_achievement) as supervision_count'))
            ->leftJoin('user', 'dosen.id_user', '=', 'user.id') // Join with user table
            ->leftJoin('supervisor_achievement', 'dosen.nidn', '=', 'supervisor_achievement.nidn')
            ->leftJoin('achievement', 'supervisor_achievement.id_achievement', '=', 'achievement.id');

        if ($category) {
            $query->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
                ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
                ->where('tag.name', $category);
        }

        $query->groupBy('dosen.nidn', 'dosen.name', 'user.photo_profile') // Add user.photo_profile to group by
            ->orderByDesc('supervision_count');

        return $query->get()->toArray();
    }
}
