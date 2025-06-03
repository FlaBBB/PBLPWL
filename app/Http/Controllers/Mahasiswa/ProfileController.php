<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $activeMenu = 'profile';
        $role = 'mahasiswa';

        return view('mahasiswa.edit-profile', [
            'activeMenu' => $activeMenu,
            'role' => $role,
        ]);
    }
}
