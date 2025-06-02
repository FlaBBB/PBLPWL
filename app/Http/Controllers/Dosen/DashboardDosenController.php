<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDosenController extends Controller
{
    public function index()
    {
        // Logic to display the dashboard for Dosen
        $activeMenu = 'dashboard';
        $breadcrumbs = [
            [
                'label' => 'Dashboard Dosen',
                'url' => route('dosen.dashboard')
            ],
        ];
        $headerTitle = 'Dashboard Dosen';
        $headerDesc = 'Selamat datang di dashboard dosen.';

        return view('dosen.mainContent', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
