<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $activeMenu = 'profile';
        $role = 'mahasiswa';

        return view('mahasiswa.edit-profile', [
            'activeMenu' => $activeMenu,
            'role' => $role,
            'mahasiswa' => Auth::user()->mahasiswa,
            'tags' => Tag::all(),
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $request->validate([
            'email' => 'required|string|email|max:255|unique:user,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tag,id',
        ]);

        // Update User data (for email)
        $user->email = $request->input('email');
        $user->save();

        // Update profile picture
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists and is not the default
            if ($user->photo_profile && $user->photo_profile !== 'user-avatar.jpg') {
                Storage::disk('public')->delete('profile_pictures/' . $user->photo_profile);
            }

            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('public/profile_pictures', $imageName);
            $user->photo_profile = $imageName;
            $user->save();
        }

        // Update tags
        if ($request->has('tags')) {
            $mahasiswa->preferences()->sync($request->input('tags'));
        } else {
            $mahasiswa->preferences()->detach(); // Remove all preferences if none are selected
        }

        return redirect()->route('mahasiswa.edit-profile')->with('success', 'Profile updated successfully!');
    }
}
