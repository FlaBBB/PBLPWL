<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifikasiAchievementController extends Controller
{
    public function index()
    {
        $activeMenu = 'verifikasi-achievement';
        $role = 'dosen';

        return view('dosen.verifikasi-achievement', [
            'activeMenu' => $activeMenu,
            'role' => $role,
        ]);
    }
}
