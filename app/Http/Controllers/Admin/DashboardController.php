<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';

        $name = Admin::query()
            ->where('id_user', auth()->user()->id)
            ->value('name');

        $headerTitle = 'Welcome Back, ' .  $name  . ' 👋';
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
