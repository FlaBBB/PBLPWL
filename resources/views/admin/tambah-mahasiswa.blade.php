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
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nim') border-red-500 @enderror">
                        @error('nim')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="flex items-center space-x-4">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex items-center space-x-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 w-50 mb-0">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="flex items-center space-x-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 w-50 mb-0">Password</label>
                        <input type="password" id="password" name="password"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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