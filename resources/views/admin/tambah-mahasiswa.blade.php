@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Tambah Mahasiswa</h2>
            <p class="text-sm text-gray-400">Lengkapi data profil mahasiswa. Pastikan kamu mengisikan data dengan benar dan lengkap.</p>

            <div class="relative p-8 pt-14 mt-4 border border-gray-200 rounded-sm">
                <form action="{{ route('admin.kelola-mahasiswa.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- NIM -->
                    <div class="flex items-center space-x-4">
                        <label for="nim" class="block text-sm font-medium text-gray-700 w-50 mb-0">NIM</label>
                        <input type="text" id="nim" name="nim" value="{{ old('nim') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="flex items-center space-x-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Phone Number -->
                    <div class="flex items-center space-x-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nomor Telepon</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- City -->
                    <div class="flex items-center space-x-4">
                        <label for="city" class="block text-sm font-medium text-gray-700 w-50 mb-0">Kota</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- District -->
                    <div class="flex items-center space-x-4">
                        <label for="district" class="block text-sm font-medium text-gray-700 w-50 mb-0">Kecamatan</label>
                        <input type="text" id="district" name="district" value="{{ old('district') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Subdistrict -->
                    <div class="flex items-center space-x-4">
                        <label for="subdistrict" class="block text-sm font-medium text-gray-700 w-50 mb-0">Kelurahan</label>
                        <input type="text" id="subdistrict" name="subdistrict" value="{{ old('subdistrict') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Address -->
                    <div class="flex items-center space-x-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 w-50 mb-0">Alamat</label>
                        <textarea id="address" name="address"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">{{ old('address') }}</textarea>
                    </div>

                    <!-- Prodi -->
                    <div class="flex items-center space-x-4">
                        <label for="prodi" class="block text-sm font-medium text-gray-700 w-50 mb-0">Program Studi</label>
                        <select id="prodi" name="prodi"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($prodiOptions as $prodi)
                                <option value="{{ $prodi->value }}" {{ old('prodi') == $prodi->value ? 'selected' : '' }}>
                                    {{ $prodi->value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Grade -->
                    <div class="flex items-center space-x-4">
                        <label for="grade" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tingkat</label>
                        <input type="number" id="grade" name="grade" value="{{ old('grade') }}" min="1" max="4"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Email -->
                    <div class="flex items-center space-x-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 w-50 mb-0">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Password -->
                    <div class="flex items-center space-x-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 w-50 mb-0">Password</label>
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
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection