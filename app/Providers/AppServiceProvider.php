<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRoleEnum; // Add this line
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $userName = '';

                // Determine the user's role and get the appropriate name
                if ($user->role === UserRoleEnum::ADMIN) {
                    $admin = Admin::where('id_user', $user->id)->first();
                    $userName = $admin ? $admin->name : 'Admin';
                } elseif ($user->role === UserRoleEnum::DOSEN) {
                    $dosen = Dosen::where('id_user', $user->id)->first();
                    $userName = $dosen ? $dosen->name : 'Dosen';
                } elseif ($user->role === UserRoleEnum::MAHASISWA) {
                    $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
                    $userName = $mahasiswa ? $mahasiswa->name : 'Mahasiswa';
                } else {
                    $userName = $user->username ?? 'Guest'; // Fallback for other user types or if name is null
                }

                $view->with('userName', $userName);
            } else {
                $view->with('userName', 'Guest');
            }
        });
    }
}
