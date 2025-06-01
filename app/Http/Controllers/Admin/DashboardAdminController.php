<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';

        $headerTitle = 'Welcome Back, Admin 👋';
        $headerDesc = 'This is your dashboard, where you can manage all the data related to the application.';
        $role = 'admin';

        return view('admin.mainContent', [
            'activeMenu' => $activeMenu,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'role' => $role,
        ]);
    }
}
