@extends('layout.template')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow border border-gray-200 p-6 space-y-6">
            <h2 class="text-xl font-bold">Verifikasi</h2>
            <p class="text-gray-400 text-sm">Kelola dan pantau seluruh akun pengguna dalam sistem, termasuk mahasiswa, dosen pembimbing, dan admin. Pastikan data pengguna selalu akurat dan terverifikasi untuk mendukung pengelolaan prestasi dan lomba secara optimal</p>

            <!-- Filter -->
            <div class="flex flex-col md:flex-row flex-wrap md:items-center gap-3 mb-6">
                <input type="text" placeholder="🔍 Cari disini" class="px-3 py-2 border border-gray-200 rounded-md w-full md:w-60 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                <select class="px-3 py-2 border border-gray-200 rounded-md text-sm bg-white w-full md:w-48 focus:outline-none">
                    <option>Program Studi</option>
                    <option>D-IV Teknik Informatika</option>
                    <option>D-IV Sistem Informasi Bisnis</option>
                    <option>D-II PPLS</option>
                </select>
                <select class="px-3 py-2 border border-gray-200 rounded-md text-sm bg-white w-full md:w-48 focus:outline-none">
                    <option>Tingkat</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <select class="px-3 py-2 border border-gray-200 rounded-md text-sm bg-white w-full md:w-48 focus:outline-none">
                    <option>Kelas</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                </select>
            </div>

            <!-- Table -->
            <div class="w-full overflow-x-auto">
                <table class="min-w-[640px] w-full bg-white text-sm text-left md:text-center border rounded-lg overflow-hidden">
                    <thead class="bg-gray-50 text-gray-600 uppercase">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Lomba</th>
                            <th class="px-4 py-2">Kategori</th>
                            <th class="px-4 py-2">Ranking</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        {{-- Data rows tetap sama --}}
                        @for ($i = 1; $i <= 7; $i++)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $i }}</td>
                            <td class="px-4 py-2">Nama Siswa {{ $i }}</td>
                            <td class="px-4 py-2">Kompetisi {{ $i }}</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara {{ $i }}</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-gray-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
