@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Edit Dosen</h2>
            <p class="text-sm text-gray-400">Perbarui data profil dosen. Pastikan kamu mengisikan data dengan benar dan lengkap.</p>

            <div class="relative p-8 pt-14 mt-4 border border-gray-200 rounded-sm">
                <form action="{{ route('admin.kelola-dosen.update', $dosen->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <!-- NIP -->
                    <div class="flex items-center space-x-4">
                        <label for="nip" class="block text-sm font-medium text-gray-700 w-50 mb-0">NIP</label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip', $dosen->nip) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="flex items-center space-x-4">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $dosen->nama_lengkap) }}"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                    </div>

                    <!-- Email -->
                    <div class="flex items-center space-x-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 w-50 mb-0">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $dosen->user->email) }}"
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
                        <a href="{{ route('admin.kelola-dosen') }}"
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
@endsection