<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';
        $role = 'dosen';

        return view('dosen.dashboard', [
            'activeMenu' => $activeMenu,
            'role' => $role,
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
