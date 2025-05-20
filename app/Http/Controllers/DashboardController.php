<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';

        return view('prestasi.mainContent', [
            'activeMenu' => $activeMenu
        ]);
    }
}
