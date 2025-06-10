<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Enums\UserRoleEnum;
use App\Helpers\NotificationHelper;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
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
                    NotificationHelper::error('Invalid role.');
                    NotificationHelper::success('You have been logged out.');
                    return redirect('/login');
            }
        }
        return view('auth.login', [
            'activeMenu' => 'login',
            'breadcrumbs' => [],
            'headerTitle' => 'Login',
            'headerDesc' => 'Please log in to your account.',
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errorFields = array_keys($validator->errors()->messages());
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error, [], $errorFields);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            NotificationHelper::success('Login successful!');

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
                    NotificationHelper::error('Invalid role.');
                    NotificationHelper::success('You have been logged out.');
                    return redirect('/login');
            }
        }

        NotificationHelper::error('Login failed. Please check your username and password.');
        return back()->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
