<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $activeMenu = 'prestasi';

        return view('prestasi.index', [
            'activeMenu' => $activeMenu
        ]);
    }
}
