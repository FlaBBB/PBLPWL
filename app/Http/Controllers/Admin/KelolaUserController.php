<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\UserRoleEnum;
use App\Enums\Prodi;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Tag; // Import Tag model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\NotificationHelper;

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
        $selectedPreference = $request->input('preference'); // New parameter for preference filter

        $mahasiswa = Mahasiswa::with('preferences') // Load preferences relationship
            ->when($search, function ($query, $search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(nim) LIKE ?', ['%' . strtolower($search) . '%']);
            })
            ->when($programStudi, function ($query, $programStudi) {
                $query->where('prodi', Prodi::from($programStudi));
            })
            ->when($tingkat, function ($query, $tingkat) {
                $query->where('grade', $tingkat);
            })
            ->when($selectedPreference, function ($query, $selectedPreference) { // New filter logic
                $query->whereHas('preferences', function ($q) use ($selectedPreference) {
                    $q->where('tag.id', $selectedPreference);
                });
            })
            ->paginate($perPage);

        $preferences = Tag::all(); // Fetch all preferences for the filter dropdown

        return view('admin.kelola-mahasiswa', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'mahasiswa' => $mahasiswa,
            'search' => $search,
            'programStudi' => $programStudi,
            'tingkat' => $tingkat,
            'prodiOptions' => Prodi::cases(),
            'selectedPreference' => $selectedPreference, // Pass to view
            'preferences' => $preferences, // Pass to view
        ]);
    }

    public function dosen(Request $request)
    {
        $search = $request->input('search');
        $selectedPreference = $request->input('preference'); // New parameter for preference filter
        $perPage = $request->input('perPage', 10);

        $query = Dosen::with('user', 'preferences');

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->with("user")
                  ->orWhereRaw('LOWER(nidn) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%']);
                  });
        }

        if ($selectedPreference) { // New filter logic
            $query->whereHas('preferences', function ($q) use ($selectedPreference) {
                $q->where('tag.id', $selectedPreference);
            });
        }

        $dosen = $query->paginate($perPage);
        $preferences = Tag::all(); // Fetch all preferences for the filter dropdown

        return view('admin.kelola-dosen', compact('dosen', 'search', 'selectedPreference', 'preferences'));
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
        $perPage = $request->input('perPage', 10);

        $query = Admin::with('user');

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(nip) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%']);
                  });
        }

        $admin = $query->paginate($perPage);

        return view('admin.kelola-admin', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'admin' => $admin,
            'search' => $search,
            'perPage' => $perPage,
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
            'prodiOptions' => Prodi::cases(),
        ]);
    }

    public function storeMahasiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|max:255|unique:mahasiswa,nim',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'address' => 'required|string',
            'prodi' => ['required', Rule::in(array_column(Prodi::cases(), 'value'))],
            'grade' => 'required|integer|min:1|max:4',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error);
            }
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::create([
            'username' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::MAHASISWA->value,
        ]);

        Mahasiswa::create([
            'id_user' => $user->id,
            'nim' => $request->nim,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'district' => $request->district,
            'subdistrict' => $request->subdistrict,
            'address' => $request->address,
            'prodi' => Prodi::from($request->prodi),
            'grade' => $request->grade,
        ]);

        NotificationHelper::success('Mahasiswa berhasil ditambahkan.');
        return redirect()->route('admin.kelola-mahasiswa');
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
            'prodiOptions' => Prodi::cases(),
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
            'prodi' => ['required', Rule::in(array_column(Prodi::cases(), 'value'))],
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
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error);
            }
            return redirect()->back()->withInput()->withErrors($validator);
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
            'prodi' => Prodi::from($request->prodi),
            'grade' => $request->grade,
        ]);

        // Sync preferences
        $mahasiswa->preferences()->sync($request->input('preferences', []));

        NotificationHelper::success('Mahasiswa berhasil diperbarui.');
        return redirect()->route('admin.kelola-mahasiswa');
    }


    public function destroyMahasiswa($nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $user = $mahasiswa->user;

        $mahasiswa->delete();

        NotificationHelper::success('Mahasiswa berhasil dihapus.');
        return redirect()->route('admin.kelola-mahasiswa');
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
            'nidn' => 'required|string|max:255|unique:dosen,nidn',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'preferences' => 'nullable|array',
            'preferences.*' => 'exists:tag,id',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error);
            }
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::create([
            'username' => $request->nidn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::DOSEN->value,
        ]);

        // dd($user->id);

        $dosen = Dosen::create([
            'id_user' => $user->id,
            'nidn' => $request->nidn,
            'name' => $request->name,
        ]);

        $dosen->preferences()->sync($request->input('preferences', []));

        NotificationHelper::success('Dosen berhasil ditambahkan.');
        return redirect()->route('admin.kelola-dosen');
    }

    public function editDosen($nidn)
    {
        $activeMenu = 'kelola-dosen';
        $breadcrumbs = [
            [
                'label' => 'Kelola Dosen',
                'url' => route('admin.kelola-dosen')
            ],
            [
                'label' => 'Edit Dosen',
                'url' => route('admin.kelola-dosen.edit', $nidn)
            ],
        ];

        $headerTitle = 'Edit Dosen';
        $headerDesc = 'Edit data dosen yang ada di dalam sistem.';

        $dosen = Dosen::findOrFail($nidn);

        return view('admin.edit-dosen', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'dosen' => $dosen,
        ]);
    }

    public function updateDosen(Request $request, $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        $user = $dosen->user;

        $validator = Validator::make($request->all(), [
            'nidn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dosen')->ignore($dosen->nidn, 'nidn'),
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'preferences' => 'nullable|array',
            'preferences.*' => 'exists:tag,id',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error);
            }
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $dosen->update([
            'nidn' => $request->nidn,
            'name' => $request->name,
        ]);

        $dosen->preferences()->sync($request->input('preferences', []));

        NotificationHelper::success('Dosen berhasil diperbarui.');
        return redirect()->route('admin.kelola-dosen');
    }

    public function destroyDosen($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        $user = $dosen->user;

        $dosen->delete();
        $user->delete();

        NotificationHelper::success('Dosen berhasil dihapus.');
        return redirect()->route('admin.kelola-dosen');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error);
            }
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::create([
            'username' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::ADMIN->value,
        ]);

        Admin::create([
            'id_user' => $user->id,
            'nip' => $request->nip,
            'name' => $request->name,
        ]);

        NotificationHelper::success('Admin berhasil ditambahkan.');
        return redirect()->route('admin.kelola-admin');
    }

    public function editAdmin($nip)
    {
        $activeMenu = 'kelola-admin';
        $breadcrumbs = [
            [
                'label' => 'Kelola Admin',
                'url' => route('admin.kelola-admin')
            ],
            [
                'label' => 'Edit Admin',
                'url' => route('admin.kelola-admin.edit', $nip)
            ],
        ];

        $headerTitle = 'Edit Admin';
        $headerDesc = 'Edit data admin yang ada di dalam sistem.';

        $admin = Admin::findOrFail($nip);

        return view('admin.edit-admin', [
            'activeMenu' => $activeMenu,
            'breadcrumbs' => $breadcrumbs,
            'headerTitle' => $headerTitle,
            'headerDesc' => $headerDesc,
            'admin' => $admin,
        ]);
    }

    public function updateAdmin(Request $request, $nip)
    {
        $admin = Admin::findOrFail($nip);
        $user = $admin->user;

        $validator = Validator::make($request->all(), [
            'nip' => [
                'required',
                'string',
                'max:255',
                Rule::unique('admin')->ignore($admin->nip, 'nip'),
            ],
            'name' => 'required|string|max:255',
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
            foreach ($validator->errors()->all() as $error) {
                NotificationHelper::error($error);
            }
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $admin->update([
            'nip' => $request->nip,
            'name' => $request->name,
        ]);

        NotificationHelper::success('Admin berhasil diperbarui.');
        return redirect()->route('admin.kelola-admin');
    }

    public function destroyAdmin($nip)
    {
        $admin = Admin::findOrFail($nip);
        $user = $admin->user;

        $admin->delete();
        $user->delete();

        NotificationHelper::success('Admin berhasil dihapus.');
        return redirect()->route('admin.kelola-admin');
    }
}
