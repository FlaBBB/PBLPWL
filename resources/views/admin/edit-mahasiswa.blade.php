@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Edit Mahasiswa</h2>
            <p class="text-sm text-gray-400">Perbarui data profil mahasiswa. Pastikan kamu mengisikan data dengan benar dan lengkap.</p>

            <div class="relative p-8 pt-14 mt-4 border border-gray-200 rounded-sm">
                <form action="{{ route('admin.kelola-mahasiswa.update', $mahasiswa->nim) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <!-- NIM -->
                    <div class="flex items-center space-x-4">
                        <label for="nim" class="block text-sm font-medium text-gray-700 w-50 mb-0">NIM</label>
                        <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="flex items-center space-x-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $mahasiswa->name) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Phone Number -->
                    <div class="flex items-center space-x-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 w-50 mb-0">No. Telepon</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $mahasiswa->phone_number) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Address -->
                    <div class="flex items-center space-x-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 w-50 mb-0">Alamat</label>
                        <textarea id="address" name="address"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">{{ old('address', $mahasiswa->address) }}</textarea>
                    </div>

                    <!-- City -->
                    <div class="flex items-center space-x-4">
                        <label for="city" class="block text-sm font-medium text-gray-700 w-50 mb-0">Kota</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $mahasiswa->city) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- District -->
                    <div class="flex items-center space-x-4">
                        <label for="district" class="block text-sm font-medium text-gray-700 w-50 mb-0">Kecamatan</label>
                        <input type="text" id="district" name="district" value="{{ old('district', $mahasiswa->district) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Subdistrict -->
                    <div class="flex items-center space-x-4">
                        <label for="subdistrict" class="block text-sm font-medium text-gray-700 w-50 mb-0">Kelurahan</label>
                        <input type="text" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $mahasiswa->subdistrict) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Prodi -->
                    <div class="flex items-center space-x-4">
                        <label for="prodi" class="block text-sm font-medium text-gray-700 w-50 mb-0">Program Studi</label>
                        <select id="prodi" name="prodi"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($prodiOptions as $prodi)
                                <option value="{{ $prodi->value }}" @selected(old('prodi', $mahasiswa->prodi) == $prodi->value)>
                                    {{ $prodi->value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Grade -->
                    <div class="flex items-center space-x-4">
                        <label for="grade" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tingkat</label>
                        <select id="grade" name="grade"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                            <option value="">Pilih Tingkat/ Tahun Mahasiswa</option>
                            <option value="1" @selected(old('grade', $mahasiswa->grade) == '1')>1</option>
                            <option value="2" @selected(old('grade', $mahasiswa->grade) == '2')>2</option>
                            <option value="3" @selected(old('grade', $mahasiswa->grade) == '3')>3</option>
                            <option value="4" @selected(old('grade', $mahasiswa->grade) == '4')>4</option>
                        </select>
                    </div>

                    <!-- Preferensi -->
                    <div class="flex items-center space-x-4">
                        <label for="preferences" class="block text-sm font-medium text-gray-700 w-50 mb-0">Preferensi</label>
                        <div class="relative flex-1">
                            <button type="button" id="preferences-button" onclick="toggleDropdown()"
                                class="text-sm text-left border border-gray-300 rounded-lg px-2 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-between w-full">
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

                    <!-- Email -->
                    <div class="flex items-center space-x-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 w-50 mb-0">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $mahasiswa->user->email) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Password -->
                    <div class="flex items-center space-x-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 w-50 mb-0">Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" id="password" name="password"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex items-center space-x-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 w-50 mb-0">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>


                    <!-- Tombol Submit -->
                    <div class="mt-8 text-right">
                        <a href="{{ route('admin.kelola-mahasiswa') }}"
                            class="w-32 bg-gray-300 text-gray-700 py-2 px-4 rounded-sm hover:bg-gray-400 transition duration-200 inline-block text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-32 bg-blue-500 text-white py-2 px-4 rounded-sm hover:bg-blue-700 transition duration-200">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("hidden");
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
                if (!event.target.closest('#preferences-button') && !event.target.closest('#dropdown')) {
                    const dropdown = document.getElementById("dropdown");
                    if (!dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden');
                    }
                }
            }
        });
    </script>
@endsection