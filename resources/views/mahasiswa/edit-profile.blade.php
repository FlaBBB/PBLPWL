@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-200 mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold border-b-2 border-gray-100 pb-2">Edit Profil saya</h2>

            <form action="{{ route('mahasiswa.update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST') {{-- Use POST for form submission, but Laravel will interpret it as PUT --}}

                <div class="flex items-center space-x-6 py-6">
                    <img src="{{ $user->photo_profile ? asset($user->photo_profile) : asset('images/user-avatar.jpg') }}"
                        alt="Foto Profil" class="object-center w-28 h-28 rounded-full object-cover" onerror="this.onerror=null;this.src='{{ asset('images/profile-default.jpg') }}';" />
                    <div class="flex flex-col space-y-2">
                        <div class="space-y-1">
                            <h3 class="text-sm font-semibold text-gray-800">Foto profil</h3>
                            <p class="text-xs text-gray-400">Format foto yang didukung JPEG, JPG, PNG dan maksimum ukuran
                                foto 2MB</p>
                        </div>
                        <div class="space-x-2">
                            <label for="profile_picture"
                                class="px-5 py-2 rounded-lg border border-gray-300 text-xs font-medium text-gray-700 bg-white hover:bg-gray-100 transition cursor-pointer">
                                Unggah foto baru
                            </label>
                            <input type="file" id="profile_picture" name="profile_picture" class="hidden"
                                onchange="displayFileName(this)">
                            <span id="file-name" class="text-sm text-gray-500"></span>
                            @if ($user->photo_profile)
                                <button type="button"
                                    class="px-5 py-2 rounded-lg border border-gray-300 text-xs font-medium text-gray-700 bg-white hover:bg-gray-100 transition"
                                    onclick="confirmDeleteProfilePicture()">
                                    Hapus foto
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-2 space-x-6 py-6">
                    <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex flex-col space-y-1">
                            <label for="name" class="block text-sm font-medium text-gray-500">Nama</label>
                            <input type="text" id="name" name="name"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->name }}" readonly disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="phone_number" class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                            <input type="text" id="phone_number" name="phone_number"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->phone_number }}" readonly disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="city" class="block text-sm font-medium text-gray-500">Kota</label>
                            <input type="text" id="city" name="city"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->city }}" readonly disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="district" class="block text-sm font-medium text-gray-500">Kecamatan</label>
                            <input type="text" id="district" name="district"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->district }}" readonly disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="subdistrict" class="block text-sm font-medium text-gray-500">Kelurahan</label>
                            <input type="text" id="subdistrict" name="subdistrict"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{  $mahasiswa->subdistrict }}" readonly disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="address" class="block text-sm font-medium text-gray-500">Alamat</label>
                            <input type="text" id="address" name="address"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->address }}" readonly disabled>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-2 space-x-6 py-6">
                    <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Academic Information</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex flex-col space-y-1">
                            <label for="nim" class="block text-sm font-medium text-gray-500">NIM</label>
                            <input type="text" id="nim" name="nim"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->nim }}" readonly disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="prodi" class="block text-sm font-medium text-gray-500">Program Studi</label>
                            <input type="text" id="prodi" name="prodi"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->prodi }}" readonly disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="grade" class="block text-sm font-medium text-gray-500">Angkatan</label>
                            <input type="number" id="grade" name="grade"
                                class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $mahasiswa->grade }}" readonly disabled>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="email" class="block text-sm font-medium text-gray-500">Email</label>
                    <input type="email" id="email" name="email"
                        class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('email', $user->email) }}">
                </div>

                <div class="flex flex-col space-y-2 space-x-6 py-6 mb-4">
                    <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Preference</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex flex-col space-y-1 relative">
                            <label for="tags" class="block text-sm font-medium text-gray-500">Minat dan Keahlian</label>
                            <div class="relative">
                                <button type="button" onclick="toggleDropdown()"
                                    class="text-sm text-left border border-gray-300 rounded-lg px-2 py-2 bg-white hover:bg-gray-50 flex items-center justify-between w-full">
                                    <span id="selected-tags-display">
                                        @if ($mahasiswa->preferences->isNotEmpty())
                                            {{ $mahasiswa->preferences->pluck('name')->join(', ') }}
                                        @else
                                            Pilih minat dan keahlian
                                        @endif
                                    </span>
                                    <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div id="dropdown"
                                    class="absolute z-10 bg-white border border-gray-300 mt-1 rounded-lg shadow-lg w-full hidden">
                                    <div class="max-h-48 overflow-y-auto p-2 space-y-2">
                                        @foreach ($tags as $tag)
                                            <label class="flex items-center space-x-2 text-sm">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                    class="form-checkbox rounded text-blue-600"
                                                    {{ $mahasiswa->preferences->contains($tag->id) ? 'checked' : '' }}>
                                                <span>{{ $tag->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-sm text-white rounded-lg hover:bg-blue-600 transition">
                        Simpan
                    </button>
                </div>
            </form>

            <form id="delete-profile-picture-form" action="{{ route('mahasiswa.delete-profile-picture') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>

        <script>
            function displayFileName(input) {
                const fileNameDisplay = document.getElementById('file-name');
                if (input.files.length > 0) {
                    fileNameDisplay.textContent = input.files[0].name;
                } else {
                    fileNameDisplay.textContent = '';
                }
            }

            function toggleDropdown() {
                document.getElementById("dropdown").classList.toggle("hidden");
            }

            function confirmDeleteProfilePicture() {
                if (confirm('Are you sure you want to delete your profile picture?')) {
                    document.getElementById('delete-profile-picture-form').submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const checkboxes = document.querySelectorAll('#dropdown input[type="checkbox"]');
                const selectedTagsDisplay = document.getElementById('selected-tags-display');

                function updateSelectedTagsDisplay() {
                    const selectedTags = Array.from(checkboxes)
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => checkbox.nextElementSibling.textContent);

                    if (selectedTags.length > 0) {
                        selectedTagsDisplay.textContent = selectedTags.join(', ');
                    } else {
                        selectedTagsDisplay.textContent = 'Pilih minat dan keahlian';
                    }
                }

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateSelectedTagsDisplay);
                });

                // Initial update on page load
                updateSelectedTagsDisplay();

                // Close the dropdown if the user clicks outside of it
                window.onclick = function(event) {
                    if (!event.target.matches('.text-left.border.border-gray-300.rounded-lg.px-2.py-2.bg-white.hover\\:bg-gray-50.flex.items-center.justify-between.w-full') && !event.target.closest('#dropdown')) {
                        const dropdown = document.getElementById("dropdown");
                        if (!dropdown.classList.contains('hidden')) {
                            dropdown.classList.add('hidden');
                        }
                    }
                }
            });
        </script>
    </main>
@endsection