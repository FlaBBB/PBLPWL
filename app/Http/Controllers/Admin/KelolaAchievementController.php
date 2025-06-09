<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MahasiswaAchievementRoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement; // Corrected model name
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Competition;
use App\Models\Tag;
use App\Models\AchievementDocument;
use Illuminate\Support\Facades\DB;

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

        $headerTitle = 'Kelola Achievement';
        $headerDesc = 'Kelola dan verifikasi achievement yang diajukan oleh mahasiswa.';

        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');
        $bidang = $request->input('bidang');
        $tingkat = $request->input('tingkat');
        $status = $request->input('status', 'WAITING'); // Default to WAITING

        $query = Achievement::with(['mahasiswa', 'tags'])
            ->where('status', $status);

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
            $query->whereHas('competition', function ($q) use ($tingkat) {
                $q->where('tingkat', $tingkat);
            });
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
            'bidang' => $bidang,
            'tingkat' => $tingkat,
            'status' => $status,
        ]);
    }

    public function daftar(Request $request)
    {
        $activeMenu = 'daftar-achievement';
        $breadcrumbs = [
            [
                'label' => 'Daftar Achievement',
                'url' => route('admin.daftar-achievement')
            ],
        ];

        $headerTitle = 'Daftar Achievement';
        $headerDesc = 'Daftar achievement yang telah diverifikasi atau menunggu verifikasi.';

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

        return response()->json(['message' => 'Achievement berhasil diverifikasi.']);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $prestasi = Achievement::findOrFail($id);
        $prestasi->status = 'REJECTED';
        $prestasi->note = $request->input('message');
        $prestasi->save();

        return response()->json(['message' => 'Achievement berhasil ditolak.']);
    }

    public function revision(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $prestasi = Achievement::findOrFail($id);
        $prestasi->status = 'REVISION';
        $prestasi->note = $request->input('message');
        $prestasi->save();

        return response()->json(['message' => 'Achievement berhasil diminta revisi.']);
    }
}
