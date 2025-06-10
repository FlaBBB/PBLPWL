<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use App\Enums\UserRoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show(Request $request, string $role, string $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        if ($user->role->value !== strtoupper($role)) {
            abort(404);
        }

        switch ($user->role) {
            case UserRoleEnum::MAHASISWA:
                $user->load(['mahasiswa.preferences']);
                break;
            case UserRoleEnum::DOSEN:
                $user->load(['dosen.preferences']);
                break;
            case UserRoleEnum::ADMIN:
                $user->load(['admin']);
                break;
            default:
                abort(404);
        }

        return view('profile.show', compact('user'));
    }

    public function sendRecommendation(Request $request, string $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = User::findOrFail($id);

        Notification::create([
            'id_user' => $user->id,
            'title' => 'Recommendation from Admin',
            'message' => $request->input('message'),
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Recommendation sent successfully!');
    }
}