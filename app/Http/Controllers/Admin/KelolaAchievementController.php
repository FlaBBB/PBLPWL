<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AchievementStatusEnum;
use App\Enums\MahasiswaAchievementRoleEnum;
use App\Enums\CompetitionLevelEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement; // Corrected model name
use App\Models\Notification;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Competition;
use App\Models\Tag;
use App\Models\AchievementDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KelolaAchievementController extends Controller
{
    public function verifikasi(Request $request)
    {
        $activeMenu = 'verifikasi-achievement';
        $breadcrumbs = [
            [
                'label' => 'Verifikasi Achievement',
                'url' => route('admin.verifikasi-achievement')
            ],
        ];

        $headerTitle = 'Kelola Prestasi';
        $headerDesc = 'Kelola dan verifikasi prestasi yang diajukan oleh mahasiswa.';

        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');
        // $bidang = $request->input('bidang'); // Removed as per user request
        $tingkat = $request->input('tingkat');

        $query = Achievement::with(['mahasiswa', 'tags'])
            ->where('status', AchievementStatusEnum::WAITING->value);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('competition_name', 'like', '%' . $search . '%')
                    ->orWhereHas('mahasiswa', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $status = $request->input('status');
        if ($status) {
            $query->where('status', $status);
        }


        if ($tingkat) {
            $query->where('level', $tingkat);
        }

        $prestasi = $query->paginate($perPage);

        // dd($prestasi);

        return view('admin.verifikasi-achievement', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'prestasi' => $prestasi,
            'perPage' => $perPage,
            'search' => $search,
            // 'bidang' => $bidang, // Removed as per user request
            'tingkat' => $tingkat,
            'status' => $status,
            'competitionLevels' => CompetitionLevelEnum::cases(),
        ]);
    }

    public function daftar(Request $request)
    {
        $activeMenu = 'daftar-achievement';
        $breadcrumbs = [
            [
                'label' => 'Daftar Prestasi',
                'url' => route('admin.daftar-achievement')
            ],
        ];

        $headerTitle = 'Kelola Prestasi';
        $headerDesc = 'Kelola dan verifikasi prestasi yang diajukan oleh mahasiswa.';

        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');
        $bidang = $request->input('bidang');
        $tingkat = $request->input('tingkat');

        $query = Achievement::with(['mahasiswa', 'tags']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('competition_name', 'like', '%' . $search . '%')
                    ->orWhereHas('mahasiswa', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($bidang) {
            $query->whereHas('tags', function ($q) use ($bidang) {
                $q->where('name', $bidang);
            });
        }

        if ($tingkat) {
            $query->where('level', $tingkat);
        }

        $prestasi = $query->paginate($perPage);

        return view('admin.daftar-achievement', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'prestasi' => $prestasi,
            'perPage' => $perPage,
            'search' => $search,
            'bidang' => $bidang,
            'tingkat' => $tingkat,
        ]);
    }
    public function show($id)
    {
        $prestasi = Achievement::with([
            'mahasiswa',
            'tags',
            'dosen' // Use dosen relationship for supervisor details
        ])->findOrFail($id);

        // No filtering for mahasiswa in detail view, all members should be di  splayed.
        // The logic for displaying the primary student name in the table view will be handled in the Achievement model.

        return response()->json($prestasi);
    }

    public function approve($id)
    {
        $prestasi = Achievement::findOrFail($id);
        $prestasi->status = 'ACCEPTED';
        $prestasi->save();

        $leader = $prestasi->mahasiswa->firstWhere('pivot.role', MahasiswaAchievementRoleEnum::LEADER->value);
        if ($leader && $leader->user) {
            Notification::create([
                'id_user' => $leader->user->id,
                'content' => 'Prestasi Anda "' . $prestasi->competition_name . '" telah disetujui.',
                'type' => 'success',
            ]);
        } else {
            Log::warning("No leader or user found for achievement ID: " . $prestasi->id . " when attempting to send approval notification.");
        }

        return response()->json(['message' => 'Achievement berhasil diverifikasi.']);
    }

    public function reject(Request $request, $id)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:255',
            ]);

            $prestasi = Achievement::findOrFail($id);
            $prestasi->status = 'REJECTED';
            $prestasi->note = $request->input('message');
            $prestasi->save();

            $leader = $prestasi->mahasiswa->firstWhere('pivot.role', MahasiswaAchievementRoleEnum::LEADER->value);
            if ($leader && $leader->user) {
                Notification::create([
                    'id_user' => $leader->user->id,
                    'content' => 'Prestasi Anda "' . $prestasi->competition_name . '" telah ditolak. Alasan: ' . $prestasi->note,
                    'type' => 'danger',
                ]);
            } else {
                Log::warning("No leader or user found for achievement ID: " . $prestasi->id . " when attempting to send rejection notification.");
            }

            return response()->json(['message' => 'Achievement berhasil ditolak.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error("Error rejecting achievement: " . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menolak achievement.'], 500);
        }
    }

    public function revision(Request $request, $id)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:255',
            ]);

            $prestasi = Achievement::findOrFail($id);
            $prestasi->status = 'REVISION';
            $prestasi->note = $request->input('message');
            $prestasi->save();

            $leader = $prestasi->mahasiswa->firstWhere('pivot.role', MahasiswaAchievementRoleEnum::LEADER->value);
            if ($leader && $leader->user) {
                Notification::create([
                    'id_user' => $leader->user->id,
                    'content' => 'Prestasi Anda "' . $prestasi->competition_name . '" membutuhkan revisi. Alasan: ' . $prestasi->note,
                    'type' => 'warning',
                ]);
            } else {
                Log::warning("No leader or user found for achievement ID: " . $prestasi->id . " when attempting to send revision notification.");
            }

            return response()->json(['message' => 'Achievement berhasil diminta revisi.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error("Error requesting revision for achievement: " . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat meminta revisi achievement.'], 500);
        }
    }
}
