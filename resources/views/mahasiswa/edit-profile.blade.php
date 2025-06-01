@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-200 mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold border-b-2 border-gray-100 pb-2">Edit Profil saya</h2>
            <div class="flex items-center space-x-6 py-6">
                <img src={{ asset('images/user-avatar.jpg') }} alt="Foto Profil"
                    class="object-center w-28 h-28 rounded-full object-cover" />
                <div class="flex flex-col space-y-2">
                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-gray-800">Foto profil</h3>
                        <p class="text-xs text-gray-400">Format foto yang didukung JPEG, JPG, PNG dan maksimum ukuran foto
                            2MB</p>
                    </div>
                    <div class="space-x-2">
                        <button
                            class="px-5 py-2 rounded-lg border border-gray-300 text-xs font-medium text-gray-700 bg-white hover:bg-gray-100 transition">
                            Unggah foto baru
                        </button>
                        <button
                            class="px-5 py-2 rounded-lg border border-gray-300 text-xs font-medium text-gray-700 bg-white hover:bg-gray-100 transition">
                            Hapus foto
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-2 space-x-6 py-6">
                <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Personal Information</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col space-y-1">
                        <label for="nama" class="block text-sm font-medium text-gray-500">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="Denis Denis">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="ttl" class="block text-sm font-medium text-gray-500">Tempat & Tanggal Lahir</label>
                        <input type="text" id="ttl" name="ttl"
                            class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="Guatemala, 1 Mei 1998">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="telepon" class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                        <input type="text" id="telepon" name="telepon"
                            class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="+62 812-3456-7890">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="email" class="block text-sm font-medium text-gray-500">Email</label>
                        <input type="text" id="email" name="email"
                            class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="dennisbebanadit@gmail.com">
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-2 space-x-6 py-6">
                <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Academic Information</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col space-y-1">
                        <label for="nama" class="block text-sm font-medium text-gray-500">NIM</label>
                        <input type="text" id="nama" name="nama"
                            class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="2341720122">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="ttl" class="block text-sm font-medium text-gray-500">Jurusan</label>
                        <input type="text" id="ttl" name="ttl"
                            class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="Teknologi Informasi">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="telepon" class="block text-sm font-medium text-gray-500">Program Studi</label>
                        <input type="text" id="telepon" name="telepon"
                            class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="Teknik Informatika">
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-2 space-x-6 py-6 mb-4">
                <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Preference</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col space-y-1 relative">
                         <label for="email" class="block text-sm font-medium text-gray-500">Minat dan Keahlian</label>
                        {{-- <!-- Dropdown Trigger --> --}}
                        <button onclick="toggleDropdown()"
                            class="text-sm text-left border border-gray-300 rounded-lg px-2 py-2 bg-white hover:bg-gray-50 flex items-center justify-between w-full" >
                            UI/UX
                            <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown List -->
                        <div id="dropdown"
                            class="absolute z-10 bg-white border border-gray-300 mt-1 rounded-lg shadow-lg w-full hidden">
                            <div class="max-h-48 overflow-y-auto p-2 space-y-2">
                                @for ($i = 0; $i <5; $i++)
                                    <label class="flex items-center space-x-2 text-sm">
                                    <input type="checkbox" class="form-checkbox rounded text-blue-600"> <span>UI/UX</span>
                                </label>
                                @endfor
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

            <div>
            </div>
        </div>
    </main>
@endsection