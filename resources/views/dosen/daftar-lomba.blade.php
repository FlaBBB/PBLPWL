@extends('layout.template')

@section('content')
    <main class="flex-1 px-6">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Katalog Lomba</h2>
            <div class="flex flex-wrap gap-4 py-4 items-center">
                <!-- Search Input -->
                <div class="relative">
                    <input type="text" placeholder="Cari disini"
                        class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                    </svg>
                </div>

                <!-- Dropdown: Kategori -->
                <div class="relative w-54">
                    <select
                        class="appearance-none w-full py-2 pr-4 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected hidden>Pilih Kategori</option>
                        <option>Cyber Security</option>
                        <option>IoT</option>
                        <option>Software Development</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <!-- Dropdown: Tingkat Lomba -->
                <div class="relative w-40">
                    <select
                        class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected hidden>Pilih Tingkat</option>
                        <option>Internasional</option>
                        <option>Nasional</option>
                        <option>Provinsi</option>
                        <option>Kota/Kabupaten</option>
                        <option>Internal</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <!-- Dropdown: Partisipan -->
                <div class="relative w-44">
                    <select
                        class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected hidden>Pilih Tipe Peserta</option>
                        <option>Tim</option>
                        <option>Individu</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <!-- Button: Tambah Lomba -->
                <div class="ml-auto">
                    <a href="{{route('dosen.tambah-lomba')}}">
                        <button
                            class="text-sm bg-[#1e6aae] text-white px-5 py-2 rounded-md hover:bg-[#17497C] transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Lomba
                        </button>
                    </a>
                </div>
            </div>

            {{-- Opsi jumlah baris per halaman --}}
            <div class="flex items-center justify-between mt-2 mb-4">
            <div>
                <form method="GET" action="">
                <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
                <select name="perPage" id="perPage" onchange="this.form.submit()" class="border border-gray-300 rounded px-2 py-1 text-sm">
                    @foreach ([12, 24, 36, 48] as $size)
                    <option value="{{ $size }}" {{ request('perPage', 12) == $size ? 'selected' : '' }}>{{ $size }}</option>
                    @endforeach
                </select>
                <span class="ml-1 text-sm text-gray-700">item</span>
                </form>
            </div>
            </div>

            <div class="mt-4 grid grid-cols-[repeat(auto-fit,_minmax(260px,_1fr))] gap-4">
                @php
                    $perPage = request('perPage', 12);
                    $page = request('page', 1);
                    $total = 37; // total data, ganti sesuai kebutuhan
                    $start = ($page - 1) * $perPage + 1;
                    $end = min($start + $perPage - 1, $total);
                @endphp
                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ route('dosen.detail-lomba') }}">
                        <div
                            class="h-63 border border-gray-200 rounded-lg transform hover:-translate-y-1 transition duration-300 hover:shadow-lg hover:border-[#1e6aae] ">
                            <img src="https://placehold.co/400x120?text=Poster&font=poppins" alt="Banner Event"
                                class="w-full rounded-t-lg h-30 object-cover object-top">

                            <div class="p-4">
                                <p class="text-xs text-[#1e6aae] font-bold">Cyber Security, IoT</p>
                                <h2 class="text-base font-semibold text-gray-800 mt-1">Hackathon Merdeka Jawa</h2>
                                <div class="flex items-center text-xs text-gray-600 mt-3 gap-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>21 Agustus – 22 Agustus 2020</span>
                                </div>

                                <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Institut Teknologi Guatemala</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endfor
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