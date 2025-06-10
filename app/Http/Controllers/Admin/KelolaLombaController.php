<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Notification;
use App\Models\CompetitionTag;
use App\Models\Tag;
use App\Enums\CompetitionLevelEnum;

class KelolaLombaController extends Controller
{
    public function daftar()
    {
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('admin.daftar-lomba')
            ],
        ];

        $headerTitle = 'Kelola Lomba';
        $headerDesc = 'Kelola lomba yang ada di dalam sistem.';

        $perPage = request('perPage', 9);
        $search = request('search');
        $bidang = request('bidang');
        $tingkat = request('tingkat');

        $query = Competition::with('tags');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) like ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(organizer) like ?', ['%' . strtolower($search) . '%']);
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

        $competition = $query->paginate($perPage);

        return view('admin.daftar-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'competition' => $competition,
            'search' => $search,
            'bidang' => $bidang,
            'tingkat' => $tingkat,
            'perPage' => $perPage,
            'bidangOptions' => Tag::all(),
            'tingkatOptions' => CompetitionLevelEnum::cases(),
        ]);
    }

    public function tambah()
    {
        $activeMenu = 'tambah-lomba';
        $breadcrumbs = [
            [
                'label' => 'Tambah Lomba',
                'url' => route('admin.tambah-lomba')
            ],
        ];

        $headerTitle = 'Tambah Lomba';
        $headerDesc = 'Tambah lomba baru ke dalam sistem.';

        return view('admin.tambah-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function verifikasi(Request $request)
    {
        $activeMenu = 'verifikasi-lomba';
        $breadcrumbs = [
            [
                'label' => 'Verifikasi Lomba',
                'url' => route('admin.verifikasi-lomba')
            ],
        ];

        $headerTitle = 'Kelola Lomba';
        $headerDesc = 'Kelola dan verifikasi lomba yang diajukan.';

        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');
        $bidang = $request->input('bidang');
        $tingkat = $request->input('tingkat');
        $status = $request->input('status', 'WAITING');

        $query = Competition::with(['tags'])
            ->where('status', $status);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) like ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(organizer) like ?', ['%' . strtolower($search) . '%']);
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

        $lomba = $query->paginate($perPage);

        return view('admin.verifikasi-lomba', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'lomba' => $lomba,
            'perPage' => $perPage,
            'search' => $search,
            'bidang' => $bidang,
            'tingkat' => $tingkat,
            'status' => $status,
            'bidangOptions' => Tag::all(),
            'tingkatOptions' => CompetitionLevelEnum::cases(),
        ]);
    }

    public function show($id)
    {
        $lomba = Competition::with(['tags'])->findOrFail($id);
        return response()->json($lomba);
    }

    public function approve($id)
    {
        $lomba = Competition::findOrFail($id);
        $lomba->status = 'ACCEPTED';
        $lomba->save();

        Notification::create([
            'user_id' => $lomba->creator,
            'title' => 'Lomba Disetujui',
            'message' => 'Entri lomba Anda "' . $lomba->name . '" telah disetujui.',
            'type' => 'success',
        ]);

        return response()->json(['message' => 'Lomba berhasil diverifikasi.']);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $lomba = Competition::findOrFail($id);
        $lomba->status = 'REJECTED';
        $lomba->rejection_note = $request->input('message');
        $lomba->save();

        Notification::create([
            'user_id' => $lomba->creator,
            'title' => 'Lomba Ditolak',
            'message' => 'Entri lomba Anda "' . $lomba->name . '" telah ditolak. Alasan: ' . $lomba->rejection_note,
            'type' => 'danger',
        ]);

        return response()->json(['message' => 'Lomba berhasil ditolak.']);
    }


    public function detail($id)
    {
        $activeMenu = 'daftar-lomba';
        $breadcrumbs = [
            [
                'label' => 'Daftar Lomba',
                'url' => route('admin.daftar-lomba')
            ],
            [
                'label' => 'Detail Lomba',
                'url' => route('admin.lomba.detail', $id)
            ],
        ];

        $headerTitle = 'Detail Lomba';
        $headerDesc = 'Detail informasi mengenai lomba.';

        $competition = Competition::with('tags')->findOrFail($id);
        $lomba = ['id' => $id, 'name' => 'Lomba ' . $id];

        return view('admin.detail-lomba', compact('competition'), [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'lomba' => $lomba,
        ]);
    }
}
