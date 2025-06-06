<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Tag;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();
        $tags = Tag::all();

        $activeMenu = '';

        $role = 'dosen';

        $breadcrumbs = [
            [
                'label' => 'Edit Profil',
                'url' => route('dosen.edit-profile')
            ]
        ];

        $headerTitle = 'Edit Profil';
        $headerDesc = 'Edit profil dosen untuk memperbarui informasi pribadi dan kontak.';

        return view('dosen.edit-profile', [
            'activeMenu' => $activeMenu,
            'role' => $role,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'user' => $user,
            'dosen' => $dosen,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id)->first();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            if ($user->photo_profile) {
                Storage::disk('public')->delete($user->photo_profile);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->photo_profile = $path;
        }

        $user->save();

        if ($request->has('tags')) {
            $dosen->preferences()->sync($request->tags);
        } else {
            $dosen->preferences()->detach();
        }

        return redirect()->route('dosen.edit-profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function deleteProfilePicture()
    {
        $user = Auth::user();

        if ($user->photo_profile) {
            Storage::disk('public')->delete($user->photo_profile);
            $user->photo_profile = null;
            $user->save();
            return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada foto profil untuk dihapus.');
    }
}
