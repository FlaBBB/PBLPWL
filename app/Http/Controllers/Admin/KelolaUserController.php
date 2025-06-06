<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Tag; // Import Tag model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KelolaUserController extends Controller
{
    public function index(Request $request)
    {
        $activeMenu = 'kelola-mahasiswa';
        $breadcrumbs = [
            [
                'label' => 'Kelola Mahasiswa',
                'url' => route('admin.kelola-mahasiswa')
            ],
        ];

        $headerTitle = 'Kelola Mahasiswa';
        $headerDesc = 'Kelola mahasiswa yang ada di dalam sistem.';

        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);
        $programStudi = $request->input('program_studi');
        $tingkat = $request->input('tingkat');

        $mahasiswa = Mahasiswa::with('preferences') // Load preferences relationship
            ->when($search, function ($query, $search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%');
            })
            ->when($programStudi, function ($query, $programStudi) {
                $query->where('program_studi', $programStudi);
            })
            ->when($tingkat, function ($query, $tingkat) {
                $query->where('tingkat', $tingkat);
            })
            ->paginate($perPage);

        return view('admin.kelola-mahasiswa', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'mahasiswa' => $mahasiswa,
            'search' => $search,
            'programStudi' => $programStudi,
            'tingkat' => $tingkat,
        ]);
    }

    public function dosen(Request $request)
    {
        $activeMenu = 'kelola-dosen';
        $breadcrumbs = [
            [
                'label' => 'Kelola Dosen',
                'url' => route('admin.kelola-dosen')
            ],
        ];
        $headerTitle = 'Kelola Dosen';
        $headerDesc = 'Kelola dosen yang ada di dalam sistem.';

        $search = $request->input('search');
        $dosen = Dosen::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('admin.kelola-dosen', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'dosen' => $dosen,
            'search' => $search,
        ]);
    }

    public function admin(Request $request)
    {
        $activeMenu = 'kelola-admin';
        $breadcrumbs = [
            [
                'label' => 'Kelola Admin',
                'url' => route('admin.kelola-admin')
            ],
        ];

        $headerTitle = 'Kelola Admin';
        $headerDesc = 'Kelola admin yang ada di dalam sistem.';

        $search = $request->input('search');
        $admin = Admin::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('admin.kelola-admin', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'admin' => $admin,
            'search' => $search,
        ]);
    }

    public function createMahasiswa()
    {
        $activeMenu = 'kelola-mahasiswa';
        $breadcrumbs = [
            [
                'label' => 'Kelola Mahasiswa',
                'url' => route('admin.kelola-mahasiswa')
            ],
            [
                'label' => 'Tambah Mahasiswa',
                'url' => route('admin.kelola-mahasiswa.create')
            ],
        ];

        $headerTitle = 'Tambah Mahasiswa';
        $headerDesc = 'Tambah mahasiswa baru ke dalam sistem.';

        return view('admin.tambah-mahasiswa', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function storeMahasiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|max:255|unique:mahasiswa,nim',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect()->route('admin.kelola-mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function editMahasiswa($nim)
    {
        $activeMenu = 'kelola-mahasiswa';
        $breadcrumbs = [
            [
                'label' => 'Kelola Mahasiswa',
                'url' => route('admin.kelola-mahasiswa')
            ],
            [
                'label' => 'Edit Mahasiswa',
                'url' => route('admin.kelola-mahasiswa.edit', $nim)
            ],
        ];

        $headerTitle = 'Edit Mahasiswa';
        $headerDesc = 'Edit data mahasiswa yang ada di dalam sistem.';

        $mahasiswa = Mahasiswa::with('preferences')->findOrFail($nim); // Eager load preferences
        $tags = Tag::all(); // Fetch all tags

        return view('admin.edit-mahasiswa', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'mahasiswa' => $mahasiswa,
            'tags' => $tags, // Pass tags to the view
        ]);
    }

    public function updateMahasiswa(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $user = $mahasiswa->user;

        $validator = Validator::make($request->all(), [
            'nim' => [
                'required',
                'string',
                'max:255',
                Rule::unique('mahasiswa')->ignore($mahasiswa->nim, 'nim'),
            ],
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'subdistrict' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'prodi' => 'required|string|max:255',
            'grade' => 'required|integer|min:1|max:4',
            'preferences' => 'nullable|array', // Add validation for preferences
            'preferences.*' => 'exists:tag,id', // Validate each preference ID exists in the tags table
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'district' => $request->district,
            'subdistrict' => $request->subdistrict,
            'address' => $request->address,
            'prodi' => $request->prodi,
            'grade' => $request->grade,
        ]);

        // Sync preferences
        $mahasiswa->preferences()->sync($request->input('preferences', []));

        return redirect()->route('admin.kelola-mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui.');
    }


    public function destroyMahasiswa($nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $user = $mahasiswa->user;

        $mahasiswa->delete();
        
        return redirect()->route('admin.kelola-mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    public function createDosen()
    {
        $activeMenu = 'kelola-dosen';
        $breadcrumbs = [
            [
                'label' => 'Kelola Dosen',
                'url' => route('admin.kelola-dosen')
            ],
            [
                'label' => 'Tambah Dosen',
                'url' => route('admin.kelola-dosen.create')
            ],
        ];

        $headerTitle = 'Tambah Dosen';
        $headerDesc = 'Tambah dosen baru ke dalam sistem.';

        return view('admin.tambah-dosen', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function storeDosen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:255|unique:dosen,nip',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect()->route('admin.kelola-dosen')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function editDosen($id)
    {
        $activeMenu = 'kelola-dosen';
        $breadcrumbs = [
            [
                'label' => 'Kelola Dosen',
                'url' => route('admin.kelola-dosen')
            ],
            [
                'label' => 'Edit Dosen',
                'url' => route('admin.kelola-dosen.edit', $id)
            ],
        ];

        $headerTitle = 'Edit Dosen';
        $headerDesc = 'Edit data dosen yang ada di dalam sistem.';

        $dosen = Dosen::findOrFail($id);

        return view('admin.edit-dosen', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'dosen' => $dosen,
        ]);
    }

    public function updateDosen(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = $dosen->user;

        $validator = Validator::make($request->all(), [
            'nip' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dosen')->ignore($dosen->id),
            ],
            'nama_lengkap' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $dosen->update([
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect()->route('admin.kelola-dosen')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroyDosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = $dosen->user;

        $dosen->delete();
        
        return redirect()->route('admin.kelola-dosen')->with('success', 'Dosen berhasil dihapus.');
    }

    public function createAdmin()
    {
        $activeMenu = 'kelola-admin';
        $breadcrumbs = [
            [
                'label' => 'Kelola Admin',
                'url' => route('admin.kelola-admin')
            ],
            [
                'label' => 'Tambah Admin',
                'url' => route('admin.kelola-admin.create')
            ],
        ];

        $headerTitle = 'Tambah Admin';
        $headerDesc = 'Tambah admin baru ke dalam sistem.';

        return view('admin.tambah-admin', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
        ]);
    }

    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:255|unique:admin,nip',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect()->route('admin.kelola-admin')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function editAdmin($id)
    {
        $activeMenu = 'kelola-admin';
        $breadcrumbs = [
            [
                'label' => 'Kelola Admin',
                'url' => route('admin.kelola-admin')
            ],
            [
                'label' => 'Edit Admin',
                'url' => route('admin.kelola-admin.edit', $id)
            ],
        ];

        $headerTitle = 'Edit Admin';
        $headerDesc = 'Edit data admin yang ada di dalam sistem.';

        $admin = Admin::findOrFail($id);

        return view('admin.edit-admin', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'admin' => $admin,
        ]);
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $user = $admin->user;

        $validator = Validator::make($request->all(), [
            'nip' => [
                'required',
                'string',
                'max:255',
                Rule::unique('admin')->ignore($admin->id),
            ],
            'nama_lengkap' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $admin->update([
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect()->route('admin.kelola-admin')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroyAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $user = $admin->user;

        $admin->delete();
        
        return redirect()->route('admin.kelola-admin')->with('success', 'Admin berhasil dihapus.');
    }
}
