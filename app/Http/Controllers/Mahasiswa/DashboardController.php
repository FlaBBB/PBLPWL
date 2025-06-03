<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';
        $role = 'mahasiswa';

        return view('mahasiswa.dashboard', [
            'activeMenu' => $activeMenu,
            'role' => $role,
        ]);
    }
}
