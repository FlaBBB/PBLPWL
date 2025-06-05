<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Achievement;
use App\Models\Competition;
use App\Models\Tag;
use App\Models\SupervisorAchievement;
use App\Enums\AchievementStatusEnum;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';
        $dosen = Auth::user()->dosen;
        $nidn = $dosen->nidn;

        // Total Mahasiswa Bimbingan
        $totalMahasiswaBimbingan = Mahasiswa::whereHas('mahasiswaAchievements.achievement.supervisor', function ($query) use ($nidn) {
            $query->where('supervisor_achievement.nidn', $nidn);
        })->distinct('nim')->count();

        // Prestasi menunggu verifikasi
        $prestasiMenungguVerifikasi = Achievement::where('status', AchievementStatusEnum::WAITING)
            ->whereHas('supervisor', function ($query) use ($nidn) {
                $query->where('supervisor_achievement.nidn', $nidn);
            })
            ->count();

        // Lomba aktif saat ini
        $lombaAktif = Competition::where('registration_deadline', '>', now())->count();

        // Prestasi Berdasarkan Kategori
        $achievementsByCategory = Achievement::select('tag.name as category_name', DB::raw('count(*) as total'))
            ->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->whereHas('supervisor', function ($query) use ($nidn) {
                $query->where('supervisor_achievement.nidn', $nidn);
            })
            ->groupBy('tag.name')
            ->get();

        $kategoriLabels = $achievementsByCategory->pluck('category_name')->toArray();
        $kategoriData = $achievementsByCategory->pluck('total')->toArray();

        // Jumlah Mahasiswa Bimbingan Berdasarkan Tahun
        $driver = DB::connection()->getDriverName();
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

        $mahasiswaByYear = Mahasiswa::select(DB::raw("{$yearFunction} as year"), DB::raw('count(distinct mahasiswa.nim) as total'))
            ->join('mahasiswa_achievement', 'mahasiswa_achievement.nim', '=', 'mahasiswa.nim')
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->whereHas('mahasiswaAchievements.achievement.supervisor', function ($query) use ($nidn) {
                $query->where('supervisor_achievement.nidn', $nidn);
            })
            ->groupBy(DB::raw($yearFunction))
            ->orderBy('year')
            ->get();

        $tahunLabels = $mahasiswaByYear->pluck('year')->toArray();
        $tahunData = $mahasiswaByYear->pluck('total')->toArray();

        $name = Dosen::query()
            ->where('id_user', auth()->user()->id)
            ->value('name');

        $headerTitle = 'Welcome Back, ' . $name . ' 👋';
        $headerDesc = 'This is your dashboard, where you can manage all the data related to the application.';

        return view('dosen.dashboard', [
            'activeMenu' => $activeMenu,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'totalMahasiswaBimbingan' => $totalMahasiswaBimbingan,
            'prestasiMenungguVerifikasi' => $prestasiMenungguVerifikasi,
            'lombaAktif' => $lombaAktif,
            'kategoriLabels' => json_encode($kategoriLabels),
            'kategoriData' => json_encode($kategoriData),
            'tahunLabels' => json_encode($tahunLabels),
            'tahunData' => json_encode($tahunData),
        ]);
    }

    public function showProfile()
    {
        $activeMenu = 'profile';
        $role = 'dosen';

        return view('dosen.profile', [
            'activeMenu' => $activeMenu,
            'role' => $role,
        ]);
    }
}
