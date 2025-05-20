<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $activeMenu = 'laporan';

        return view('layout.template', [
            'activeMenu' => $activeMenu
        ]);
    }
}
