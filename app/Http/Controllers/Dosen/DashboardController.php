<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen; 

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';
        $role = 'dosen';
        $name = Dosen::query()
            ->where('id_user', auth()->user()->id)
            ->value('name');

        $headerTitle = 'Welcome Back, ' . $name . ' 👋';
        $headerDesc = 'This is your dashboard, where you can manage all the data related to the application.';

        return view('dosen.dashboard', [
            'activeMenu' => $activeMenu,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
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
