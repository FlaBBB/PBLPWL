@extends('layout.template')

@section('content')
<main class="flex-1 px-6">
    <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
        <div class="flex flex-row items-center justify-between mb-4">
            <h2 class="text-xl font-semibold mb-4">Daftar Lomba Dosen</h2>
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
        <form method="GET" action="{{ route('dosen.daftar-lomba') }}"
            class="flex flex-row gap-4 py-4 items-center w-full">
            <!-- Search Input -->
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari disini"
                    class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                </svg>
            </div>

            <!-- Dropdown: Kategori -->
            <div class="relative w-2/5">
                <select name="kategori" class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option disabled selected hidden>Pilih Kategori</option>
                    <option value="" {{ request('kategori') == '' ? 'selected' : '' }}>Semua Kategori</option>
                    @foreach($kategoriList as $kategori)
                    <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <!-- Dropdown: Tingkat Lomba -->
            <div class="relative w-1/4">
                <select name="tingkat" class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option disabled selected hidden>Pilih Tingkat</option>
                    <option value="" {{ request('tingkat') == '' ? 'selected' : '' }}>Semua Tingkat</option>
                    @foreach($tingkatList as $tingkat)
                    <option value="{{ $tingkat }}" {{ request('tingkat') == $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
                    @endforeach
                </select>
                <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <!-- Dropdown: Partisipan -->
            <div class="relative w-1/4">
                <select name="partisipan" class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option disabled selected hidden>Pilih Tipe Peserta</option>
                    <option value="" {{ request('partisipan') == '' ? 'selected' : '' }}>Semua Tipe Peserta</option>
                    <option value="Individu" {{ request('partisipan') == 'Individu' ? 'selected' : '' }}>Individu</option>
                    <option value="Tim" {{ request('partisipan') == "Tim" ? 'selected' : '' }}>Tim</option>
                </select>
                <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <button type="submit" class="bg-[#1e6aae] text-white px-4 py-2 rounded-md text-sm hover:bg-[#17497C]">Filter</button>
        </form>

        <div class="mt-4 grid grid-cols-[repeat(auto-fit,_minmax(260px,_1fr))] gap-4">
            @foreach($competition as $i)
            {{-- Ganti dengan data lomba yang sesuai --}}
            <a href="{{ route('dosen.detail-lomba', ['id' => $i]) }}">
                <div
                    class="h-63 border border-gray-200 rounded-lg transform hover:-translate-y-1 transition duration-300 hover:shadow-lg hover:border-[#1e6aae] ">
                    <img src="https://placehold.co/400x120?text=Poster&font=poppins" alt="Banner Event"
                        class="w-full rounded-t-lg h-30 object-cover object-top">
                    <div class="p-4 truncate">
                        @foreach ($i->tags as $tag)
                        <span class="text-xs text-[#1e6aae] font-bold">{{ $tag->name }} @if(!$loop->last), @endif </span>
                        @endforeach
                        <h2 class="text-base font-semibold text-gray-800 mt-1">{{ Str::limit($i->name, 25) }}</h2>
                        <div class="flex items-center text-xs text-gray-600 mt-3 gap-1">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ Carbon\Carbon::parse($i->start_at)->format('d F Y') }} - {{ Carbon\Carbon::parse($i->end_at)->format('d F Y') }}</span>
                        </div>

                        <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>{{ $i->organizer }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

            {{-- Navigasi halaman otomatis --}}
        </div>

        <div class="mt-4 grid grid-cols items-end gap-4">
            {{ $competition->appends(request()->except('page'))->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</main>
@endsection