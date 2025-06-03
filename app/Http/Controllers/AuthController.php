<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Enums\UserRoleEnum;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            switch ($user->role->value) {
                case UserRoleEnum::ADMIN->value:
                    return redirect()->intended('/admin/dashboard');
                case UserRoleEnum::DOSEN->value:
                    return redirect()->intended('/dosen/dashboard');
                case UserRoleEnum::MAHASISWA->value:
                    return redirect()->intended('/dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['email' => 'Invalid role.']);
            }
        }


        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
            'error' => 'Login failed. Please check your username and password.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
