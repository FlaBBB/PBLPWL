<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function index()
    {
        $activeMenu = '';

        $role = 'dosen';

         $breadcrumbs = [
            [
                'label' => 'Edit Profil',
                'url' => route('dosen.profil-dosen')
            ]
        ];

        $headerTitle = 'Edit Profil';
        $headerDesc = 'Edit profil dosen untuk memperbarui informasi pribadi dan kontak.';

        return view('dosen.profil-dosen', [
            'activeMenu' => $activeMenu,
            'role' => $role,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }
}
