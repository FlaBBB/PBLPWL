@extends('layout.template')

@section('content')
    <main class="flex-1 px-6">
        <div class="w-full mx-auto mb-12 p-6 border border-gray-200 rounded-lg relative">
            <h2 class="text-xl font-semibold mb-2">Daftar Mahasiswa Bimbingan</h2>
            <p class="text-sm text-gray-400">Berikut adalah daftar mahasiswa bimbingan yang telah kamu bina sebelumnya.</p>
            
            {{-- Opsi jumlah baris per halaman --}}
            <div class="flex items-center justify-between mt-6 mb-4">
            <div>
                <form method="GET" action="">
                <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
                <select name="perPage" id="perPage" onchange="this.form.submit()" class="border border-gray-300 rounded px-2 py-1 text-sm">
                    @foreach ([5, 10, 25, 50] as $size)
                    <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
                    @endforeach
                </select>
                <span class="ml-1 text-sm text-gray-700">baris</span>
                </form>
            </div>
            </div>

            <div class="relative mt-2 border border-gray-200 rounded-sm">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead>
                <tr class="border-b border-gray-200 text-gray-400">
                    <th class="px-6 py-3 font-semibold">No.</th>
                    <th class="px-6 py-3 font-semibold">Nama Mahasiswa</th>
                    <th class="px-6 py-3 font-semibold">Lomba</th>
                    <th class="px-6 py-3 font-semibold">Tanggal Lomba</th>
                    <th class="px-6 py-3 font-semibold">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                {{-- Contoh data paginasi, ganti dengan data dari controller --}}
                @php
                    $perPage = request('perPage', 10);
                    $page = request('page', 1);
                    $total = 20; // total data, ganti sesuai kebutuhan
                    $start = ($page - 1) * $perPage + 1;
                    $end = min($start + $perPage - 1, $total);
                @endphp
                @for ($i = $start; $i <= $end; $i++)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-2 ">{{ $i }}</td>
                    <td class="px-6 py-2 ">Muhammad Budi Sentosa Rahmat</td>
                    <td class="px-6 py-2 ">Inovatif Creation IT 2021</td>
                    <td class="px-6 py-2 ">12 Oktober 2021</td>
                    <td class="px-6 py-2">
                        <div class="flex space-x-3">
                        <button
                            class="bg-transparent border border-[#1e6aae] text-[#1e6aae]  hover:bg-[#1e6aae] hover:text-white px-2 py-1 rounded text-xs font-medium flex items-center gap-1 gap-2"
                            title="Lihat Detail"> Lihat Detail
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                        </div>
                    </td>
                    </tr>
                @endfor
                </tbody>
            </table>
            </div>

            {{-- Navigasi halaman --}}
            @php
            $lastPage = ceil($total / $perPage);
            @endphp
            
            <div class="flex justify-end mt-6">
            <nav class="inline-flex -space-x-px">
                <a href="?perPage={{ $perPage }}&page={{ max(1, $page-1) }}"
                class="px-3 py-1 border border-gray-300 rounded-l {{ $page == 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
                &laquo;
                </a>
                @for ($p = 1; $p <= $lastPage; $p++)
                <a href="?perPage={{ $perPage }}&page={{ $p }}"
                    class="px-3 py-1 border-t text-gray-600 border-b border-gray-300 {{ $p == $page ? 'bg-[#1e6aae] text-white' : 'hover:bg-gray-200' }}">
                    {{ $p }}
                </a>
                @endfor
                <a href="?perPage={{ $perPage }}&page={{ min($lastPage, $page+1) }}"
                class="px-3 py-1 border border-gray-300 rounded-r {{ $page == $lastPage ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
                &raquo;
                </a>
            </nav>
            </div>
        </div>
    </main>
@endsection