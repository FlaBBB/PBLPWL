@extends('layout.template')
@php
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
@endphp

@section('content')
    <main class="flex-1 px-10">
        <div class="w-full mx-auto p-6  border border-gray-200 rounded-lg">
            <div class="flex flex-row items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Daftar Lomba ADMIN</h2>
            </div>
            <div class="flex flex-wrap gap-4 pb-4 items-center">
                <div class="flex flex-wrap gap-4 py-4 items-center w-full">
                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" placeholder="Cari disini"
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0113.15 6.15z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-700 ml-4">Filter berdasarkan:</p>
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
                </div>

                {{-- Opsi jumlah baris per halaman --}}
                <div class="flex flex-cols items-center justify-between gap-auto w-full">
                    <div>
                        <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
                        <select name="perPage" id="perPage" onchange="changePerPage(this.value)"
                            class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-[#1e6aae]">
                            @foreach ([5, 10, 25, 50] as $size)
                                <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>
                        <span class="ml-1 text-sm text-gray-700">baris</span>
                    </div>
                </div>

                <script>
                    function changePerPage(value) {
                        // Get current URL
                        const currentUrl = new URL(window.location.href);

                        // Set new perPage value and reset page to 1
                        currentUrl.searchParams.set('perPage', value);
                        currentUrl.searchParams.set('page', 1);

                        console.log('Redirecting to:', currentUrl.toString());

                        // Navigate to new URL
                        window.location.href = currentUrl.toString();
                    }
                </script>

                <table class="w-full text-left text-sm bg-white rounded-lg border border-gray-200 rounded-sm">
                    <thead class="text-gray-500">
                        <tr class="border-b border-gray-200">
                            <th class="w-[5%] px-4 py-2 text-left">No</th>
                            <th class="w-[25%] px-2 py-2 text-left">Nama Lomba</th>
                            <th class="w-[15%] px-2 py-2 text-left">Penyelenggara</th>
                            <th class="w-[10%] px-2 py-2 text-left">Tingkat</th>
                            <th class="w-[10%] px-2 py-2 text-left">Kategori</th>
                            <th class="w-[10%] px-2 py-2 text-left">Tanggal</th>
                            <th class="w-[20%] px-2 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($competition as $index => $lomba)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $competition->firstItem() + $index }}</td>
                                <td class="px-2 py-2">{{ Str::limit($lomba->name, 30) }}</td>
                                <td class="px-2 py-2">{{ Str::limit($lomba->organizer, 20) }}</td>
                                <td class="px-2 py-2">{{ $lomba->level }}</td>
                                <td class="px-2 py-2">
                                    @foreach ($lomba->tags as $tag)
                                        {{ $tag->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="px-2 py-2">{{ Carbon::parse($lomba->start_at)->format('d/m/Y') }}</td>
                                <td class="px-2 py-2 flex gap-2">
                                    <div class="flex space-x-2">
                                        <button type="button" onclick="openModal('modal-detail-{{ $lomba->id }}')"
                                            class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white  px-2 py-2 rounded text-xs flex items-center gap-1"
                                            title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                        <button type="button" onclick="openModal('modal-edit-{{ $lomba->id }}')"
                                            class="border border-amber-400 text-amber-400 hover:bg-amber-400 hover:text-white px-2 py-2 rounded text-xs flex items-center gap-1"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                        <button type="button" onclick="openModal('modal-hapus-{{ $lomba->id }}')"
                                            class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-2 py-2 rounded text-xs flex items-center gap-1"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Navigasi halaman --}}
            <div class="flex justify-end mt-6">
                {{ $competition->appends(request()->except('page'))->links('vendor.pagination.tailwind') }}
            </div>
        </div>

        {{-- MODAL COMPONENTS --}}
        @foreach($competition as $lomba)
        {{-- MODAL DETAIL LOMBA --}}
        <div id="modal-detail-{{ $lomba->id }}"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md text-xs shadow-2xl max-w-6xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button type="button" onclick="closeModal('modal-detail-{{ $lomba->id }}')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800">Detail Lomba</h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Informasi Lomba</h4>
                        <table class="w-full text-gray-800 text-left text-sm">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Nama Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">{{ $lomba->name }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Penyelenggara</td>
                                <td class="border border-gray-200 px-3 py-2">{{ $lomba->organizer }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tingkat Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">{{ $lomba->level }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Kategori</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    @foreach ($lomba->tags as $tag)
                                        {{ $tag->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Mulai</td>
                                <td class="border border-gray-200 px-3 py-2">{{ Carbon::parse($lomba->start_at)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Berakhir</td>
                                <td class="border border-gray-200 px-3 py-2">{{ Carbon::parse($lomba->end_at)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tipe Peserta</td>
                                <td class="border border-gray-200 px-3 py-2">{{ $lomba->participant_type ?? 'Tidak ditentukan' }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">URL Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    @if($lomba->url)
                                        <a href="{{ $lomba->url }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            Lihat Website
                                        </a>
                                    @else
                                        Tidak ada URL
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Informasi Pendaftaran -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Informasi Pendaftaran</h4>
                            <table class="w-full text-gray-800 text-left text-sm">
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Tanggal Buka</td>
                                    <td class="border border-gray-200 px-3 py-2">{{ $lomba->registration_start ? Carbon::parse($lomba->registration_start)->format('d F Y') : 'Tidak ditentukan' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Tutup</td>
                                    <td class="border border-gray-200 px-3 py-2">{{ $lomba->registration_end ? Carbon::parse($lomba->registration_end)->format('d F Y') : 'Tidak ditentukan' }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- File Dokumen -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Dokumen</h4>
                            <table class="w-full text-gray-800 text-left text-sm">
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Poster</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        @if($lomba->poster_path)
                                            <a href="{{ asset('storage/' . $lomba->poster_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                        @else
                                            Tidak ada file
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Deskripsi</td>
                                <td class="border border-gray-200 px-3 py-2">{{ $lomba->description ?? 'Tidak ada deskripsi' }}</td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="button" onclick="closeModal('modal-detail-{{ $lomba->id }}')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL HAPUS LOMBA --}}
        <div id="modal-hapus-{{ $lomba->id }}"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out pt-16 sm:pt-20 overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button type="button" onclick="closeModal('modal-hapus-{{ $lomba->id }}')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Data Lomba</h3>
                    <div class="mb-4 space-y-4">
                        <p class="text-sm text-gray-500 mb-2">
                            Apakah Anda yakin ingin menghapus data lomba berikut?
                        </p>
                        <div class="bg-gray-50 p-3 space-y-2 rounded-lg text-left">
                            <div class="text-sm"><strong>Nama Lomba:</strong> {{ $lomba->name }}</div>
                            <div class="text-sm"><strong>Penyelenggara:</strong> {{ $lomba->organizer }}</div>
                            <div class="text-sm"><strong>Tingkat:</strong> {{ $lomba->level }}</div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-3 justify-end">
                        <button type="button" onclick="closeModal('modal-hapus-{{ $lomba->id }}')"
                            class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <form action="" method="POST" class="w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL EDIT LOMBA --}}
        <div id="modal-edit-{{ $lomba->id }}"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-5xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button type="button" onclick="closeModal('modal-edit-{{ $lomba->id }}')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800">Edit Data Lomba</h3>

                <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @csrf
                    @method('PUT')
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-xs text-gray-800 mb-2">Informasi Lomba</h4>
                        <table class="w-full text-gray-800 text-left text-sm">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Nama Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <input type="text" name="name" value="{{ $lomba->name }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Penyelenggara</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <input type="text" name="organizer" value="{{ $lomba->organizer }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tingkat Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <select name="level"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm" required>
                                        <option value="Internal" {{ $lomba->level == 'Internal' ? 'selected' : '' }}>Internal</option>
                                        <option value="Kota/Kabupaten" {{ $lomba->level == 'Kota/Kabupaten' ? 'selected' : '' }}>Kota/Kabupaten</option>
                                        <option value="Provinsi" {{ $lomba->level == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                        <option value="Nasional" {{ $lomba->level == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                        <option value="Internasional" {{ $lomba->level == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Bidang Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <select name="level"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm" required>
                                        {{-- dropdown multi-choose --}}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Mulai Lomba</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        <input type="date" name="start_at" value="{{ Carbon::parse($lomba->start_at)->format('Y-m-d') }}"
                                            class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Berakhir Lomba</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        <input type="date" name="end_at" value="{{ Carbon::parse($lomba->end_at)->format('Y-m-d') }}"
                                            class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm" required>
                                    </td>
                                </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tipe Peserta</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <select name="participant_type"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm">
                                        <option value="Tim" {{ $lomba->participant_type == 'Tim' ? 'selected' : '' }}>Tim</option>
                                        <option value="Individu" {{ $lomba->participant_type == 'Individu' ? 'selected' : '' }}>Individu</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">URL Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <input type="url" name="url" value="{{ $lomba->url }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Tanggal -->
                        <div>
                            <h4 class="font-semibold text-xs text-gray-800 mb-2">Informasi Pendaftaran</h4>
                            <table class="w-full text-gray-800 text-left text-sm">

                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Mulai Pendaftaran</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        <input type="date" name="registration_start" value="{{ $lomba->registration_start ? Carbon::parse($lomba->registration_start)->format('Y-m-d') : '' }}"
                                            class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/2 bg-gray-50">Tutup Pendaftaran</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        <input type="date" name="registration_end" value="{{ $lomba->registration_end ? Carbon::parse($lomba->registration_end)->format('Y-m-d') : '' }}"
                                            class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- File Upload -->
                        <div>
                            <h4 class="font-semibold text-xs text-gray-800 mb-2">Dokumen Pelengkap</h4>
                            <table class="w-full text-gray-800 text-left text-sm">
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Poster</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        <input type="file" name="poster" accept=".jpg,.jpeg,.png,.pdf"
                                            class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm">
                                        @if($lomba->poster_path)
                                            <small class="text-gray-500">File saat ini: {{ basename($lomba->poster_path) }}</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Deskripsi</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <textarea name="description" rows="3"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#1e6aae] focus:border-transparent text-sm">{{ $lomba->description }}</textarea>
                                </td>
                            </tr>
                            </table>
                        </div>
                    </div>

                    <div class="lg:col-span-2 mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeModal('modal-edit-{{ $lomba->id }}')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-[#1e6aae] border border-transparent rounded-md hover:bg-[#17497C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1e6aae]">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </main>

    <script>
        // Prevent default behavior dan event bubbling
        function openModal(modalId, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            try {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'opened' || modal.dataset.state === 'opening') {
                    return;
                }

                const modalDialog = modal.querySelector('.modal-dialog');
                modal.dataset.state = 'opening';

                modal.classList.remove('opacity-0', 'pointer-events-none');
                // Force browser to recognize the initial state before adding transition classes
                void modal.offsetWidth;
                modal.classList.add('opacity-100', 'pointer-events-auto');

                if (modalDialog) {
                    modalDialog.classList.remove('-translate-y-full', 'scale-95');
                    modalDialog.classList.add('translate-y-0', 'scale-100');
                }

                // Determine which element and duration to monitor for transition end
                const targetElement = modalDialog || modal; // Fallback to modal overlay if dialog isn't there
                const duration = modalDialog ? 500 : 300;

                let openTransitionEnded = false;
                const onOpenTransitionEnd = (event) => {
                    // Ensure the event is from the target element and not a child
                    if (event.target === targetElement && modal.dataset.state === 'opening' && !openTransitionEnded) {
                        openTransitionEnded = true;
                        modal.dataset.state = 'opened';
                        targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                    }
                };

                targetElement.removeEventListener('transitionend', onOpenTransitionEnd); // Remove previous just in case
                targetElement.addEventListener('transitionend', onOpenTransitionEnd);

                // Fallback timeout in case transitionend doesn't fire (e.g., element becomes display:none unexpectedly)
                setTimeout(() => {
                    if (modal.dataset.state === 'opening' && !openTransitionEnded) {
                        openTransitionEnded = true;
                        modal.dataset.state = 'opened';
                        targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                    }
                }, duration + 70); // A little buffer, slightly increased

            } catch (error) {
                console.error('Error opening modal:', error);
            }
        }

        function closeModal(modalId, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            try {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'closed' || modal.dataset.state === 'closing') {
                    return;
                }

                const modalDialog = modal.querySelector('.modal-dialog');
                modal.dataset.state = 'closing';

                // Start fading out overlay
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                // Remove 'pointer-events-auto' immediately so it can't be re-triggered during closing,
                // 'pointer-events-none' will be added after transition.
                modal.classList.remove('pointer-events-auto');

                if (modalDialog) {
                    modalDialog.classList.remove('translate-y-0', 'scale-100');
                    modalDialog.classList.add('-translate-y-full', 'scale-95');
                }

                const targetElement = modalDialog || modal;
                const duration = modalDialog ? 500 : 300;

                let closeTransitionEnded = false;
                const onCloseTransitionEnd = (event) => {
                    if (event.target === targetElement && modal.dataset.state === 'closing' && !closeTransitionEnded) {
                        closeTransitionEnded = true;
                        modal.classList.add('pointer-events-none'); // Fully non-interactive
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                };

                targetElement.removeEventListener('transitionend', onCloseTransitionEnd); // Remove previous just in case
                targetElement.addEventListener('transitionend', onCloseTransitionEnd);

                // Fallback timeout
                setTimeout(() => {
                    if (modal.dataset.state === 'closing' && !closeTransitionEnded) {
                        closeTransitionEnded = true;
                        modal.classList.add('pointer-events-none');
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                }, duration + 70); // A little buffer

            } catch (error) {
                console.error('Error closing modal:', error);
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function (event) {
            const modals = document.querySelectorAll('[id^="modal-"]');
            modals.forEach(modal => {
                if (modal.dataset.state === 'opened') {
                    if (event.target === modal) {
                        closeModal(modal.id, event);
                    }
                }
            });
        });
    </script>
@endsection