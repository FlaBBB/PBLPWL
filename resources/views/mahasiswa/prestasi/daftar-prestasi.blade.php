@extends('layout.template')

@section('content')
    <main class="flex-1 px-10 pb-96">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">Daftar Prestasi</h2>
            <p class="text-sm text-gray-400">Lihat dan pantau seluruh prestasi yang telah Anda unggah selama masa studi.
                Pastikan setiap prestasi disertai bukti sah seperti sertifikat atau surat keterangan resmi.</p>
            <form id="filterForm" class="flex flex-wrap gap-4 py-4 items-center">
                <div class="flex flex-wrap gap-4 py-4 items-center w-full">
                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" id="search" name="search" placeholder="Cari disini"
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            value="{{ $currentSearch }}" />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                        </svg>
                    </div>

                    <!-- Dropdown: Kategori -->
                    <div class="relative w-54">
                        <select id="kategori" name="kategori"
                            class="appearance-none w-full py-2 pr-4 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}" {{ $currentKategori == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- Dropdown: Tingkat prestasi -->
                    <div class="relative w-40">
                        <select id="tingkat" name="tingkat"
                            class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Tingkat</option>
                            <option value="INTERNATIONAL" {{ $currentTingkat == 'INTERNATIONAL' ? 'selected' : '' }}>Internasional</option>
                            <option value="NATIONAL" {{ $currentTingkat == 'NATIONAL' ? 'selected' : '' }}>Nasional</option>
                            <option value="PROVINCE" {{ $currentTingkat == 'PROVINCE' ? 'selected' : '' }}>Provinsi</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <!-- Dropdown: Partisipan -->
                    <div class="relative w-44">
                        <select id="status" name="status"
                            class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="ACCEPTED" {{ $currentStatus == 'ACCEPTED' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="WAITING" {{ $currentStatus == 'WAITING' ? 'selected' : '' }}>Menunggu</option>
                            <option value="REJECTED" {{ $currentStatus == 'REJECTED' ? 'selected' : '' }}>Ditolak</option>
                            <option value="REVISION" {{ $currentStatus == 'REVISION' ? 'selected' : '' }}>Revisi</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <!-- Button: Tambah prestasi -->
                    <div class="ml-auto">
                        <a href="{{route('mahasiswa.tambah-prestasi')}}">
                            <button type="button"
                                class="text-sm bg-[#1e6aae] text-white px-5 py-2 rounded-md hover:bg-[#17497C] transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Prestasi
                            </button>
                        </a>
                    </div>
                </div>
            </form>
                <table id="achievements-table" class="w-full text-left text-sm bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3">Nama Lomba</th>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Ranking</th>
                            <th class="py-2 px-3">Tingkat</th>
                            <th class="py-2 px-3">Status</th>
                            <th class="py-2 px-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- DataTables will populate this --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL --}}

        {{-- MODAL VERIFIED --}} {{-- CUMA BISA LIHAT AJA --}}
        <div id="modal-detail"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-7xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out ">
                <button onclick="closeModal('modal-detail')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800 inline-block mr-2">Detail Prestasi</h3>
                <span id="detail-status-badge"
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 align-middle">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Terverifikasi
                </span>

                <div class="overflow-x-auto grid grid-cols-2 gap-8 mt-6 items-start">
                    {{-- table kiri --}}
                    <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium">Nama Lomba</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-competition-name"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Penyelenggara
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-organizer"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Ranking Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-place"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tingkat Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-level"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Bidang Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-type"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-start-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                Berakhir</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-end-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tenggat
                                Pendaftaran</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-registration-deadline"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Jumlah
                                Peserta</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-participants"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">URL prestasi
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-url" href="#" target="_blank" class="text-blue-600 hover:underline"></a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 align-top font-medium">Deskripsi</td>
                            <td class="border border-gray-200 px-3 py-2 max-w-xs align-top">
                                <div id="detail-description" class="line-clamp-2 break-words text-ellipsis overflow-hidden"
                                    style="max-width: 24rem;"
                                    title="">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium">File Surat Tugas</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-assignment-letter" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">File Sertifikat
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-certificate" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">File Foto Kegiatan
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-activity-photo" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">File Poster
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-poster" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                    </table>
                    {{-- table kanan --}}
                    <div class="space-y-6">
                        <table class="w-full max-w-auto text-gray-800 text-left text-sm h-fit">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 w-1/3 font-medium">Nama Peserta 1</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-participant-name-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 1</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-participant-role-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Peserta 2</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-participant-name-2"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 2</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-participant-role-2"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Peserta 3</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-participant-name-3"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 3</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-participant-role-3"></td>
                            </tr>

                        </table>
                        <table class="w-full max-w-auto text-gray-800 text-left text-sm h-fit">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Nama Dosen
                                    Pembimbing
                                </td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-supervisor-name"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Peran Dosen
                                    Pembimbing
                                </td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-supervisor-role"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="button" onclick="closeModal('modal-detail')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <div id="modal-waiting"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button onclick="closeModal('modal-waiting')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800 inline-block mr-2">Detail Prestasi</h3>
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Sedang diproses
                </span>
                <div id="waiting-detail-content">
                </div>
                <div class="mt-8 text-right flex justify-end gap-4">
                    <button
                        class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white px-4 py-3 rounded text-base font-medium flex items-center justify-center gap-1 h-12"
                        title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Edit
                    </button>
                    <button onclick="openModal('modal-hapus')"
                        class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-4 py-3 rounded text-base font-medium flex items-center justify-center gap-1 h-12"
                        title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL REJECTED --}} {{-- CUMA BISA LIHAT AJA --}}
        <div id="modal-rejected"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-7xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out ">
                <button onclick="closeModal('modal-rejected')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-2 text-gray-800 inline-block mr-2">Detail Prestasi</h3>
                {{-- Ini buat tampilan REJECTED --}}
                <span id="rejected-status-badge"
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                    <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                    Ditolak
                </span>

                <div class="overflow-x-auto grid grid-cols-2 gap-8 mt-6 items-start">
                    {{-- table kiri --}}
                    <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Lomba</td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-competition-name"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Penyelenggara
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-organizer"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Ranking Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-place"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Tingkat Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-level"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Bidang Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-type"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Tanggal Mulai
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-start-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Tanggal
                                Berakhir</td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-end-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Jumlah
                                Peserta</td>
                            <td class="border border-gray-200 px-3 py-2" id="rejected-participants"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">URL prestasi
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="rejected-url" href="#" target="_blank" class="text-blue-600 hover:underline"></a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">File Surat Tugas</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="rejected-file-assignment-letter" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">File Sertifikat</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="rejected-file-certificate" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">File Poster</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="rejected-file-poster" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">Foto Kegiatan</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="rejected-file-activity-photo" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                    </table>
                    {{-- table kanan --}}
                    <div class="space-y-6">
                        <table class="w-full max-w-auto text-gray-800 text-left text-sm h-fit">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 w-1/3 font-medium">Nama Peserta 1</td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-participant-name-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 1</td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-participant-role-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Peserta 2</td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-participant-name-2"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 2</td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-participant-role-2"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Peserta 3</td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-participant-name-3"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 3</td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-participant-role-3"></td>
                            </tr>

                        </table>

                        <table class="w-full max-w-auto text-gray-800 text-left text-sm h-fit">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Nama Dosen
                                    Pembimbing
                                </td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-supervisor-name"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Peran Dosen
                                    Pembimbing
                                </td>
                                <td class="border border-gray-200 px-3 py-2" id="rejected-supervisor-role"></td>
                            </tr>
                        </table>

                        <div class="bg-red-50 border-l-4 border-red-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium w-1/3 text-red-800">
                                        Alasan Penolakan
                                    </h4>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p id="rejected-reason-text">Data prestasi yang disubmit tidak sesuai dengan kriteria yang telah ditetapkan.
                                            Silakan periksa kembali kelengkapan berkas dan pastikan semua data sesuai dengan
                                            ketentuan yang berlaku.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="button" onclick="closeModal('modal-rejected')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium w-1/3 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <div id="modal-revised"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-7xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button onclick="closeModal('modal-revised')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800 inline-block mr-2">Detail Prestasi</h3>
                {{-- Ini buat tampilan REVISED --}}
                <span id="revised-status-badge"
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Perlu Revisi
                </span>
                <div class="overflow-x-auto grid grid-cols-2 gap-8 mt-6 items-start">
                    {{-- table kiri --}}
                    <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Lomba</td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-competition-name"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Penyelenggara
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-organizer"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Ranking Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-place"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Tingkat Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-level"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Bidang Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-type"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Tanggal Mulai
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-start-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Tanggal
                                Berakhir</td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-end-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Jumlah
                                Peserta</td>
                            <td class="border border-gray-200 px-3 py-2" id="revised-participants"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">URL Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="revised-url" href="#" target="_blank" class="text-blue-600 hover:underline"></a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">File Surat Tugas</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="revised-file-assignment-letter" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">File Sertifikat</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="revised-file-certificate" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">File Poster</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="revised-file-poster" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium w-1/3">Foto Kegiatan</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="revised-file-activity-photo" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                    </table>
                    {{-- table kanan --}}
                    <div class="space-y-6">
                        <table class="w-full max-w-auto text-gray-800 text-left text-sm h-fit">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 w-1/3 font-medium">Nama Peserta 1</td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-participant-name-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 1</td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-participant-role-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Peserta 2</td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-participant-name-2"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 2</td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-participant-role-2"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Nama Peserta 3</td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-participant-name-3"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3">Role Peserta 3</td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-participant-role-3"></td>
                            </tr>

                        </table>

                        <table class="w-full max-w-auto text-gray-800 text-left text-sm h-fit">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Nama Dosen
                                    Pembimbing
                                </td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-supervisor-name"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 whitespace-nowrap">Peran Dosen
                                    Pembimbing
                                </td>
                                <td class="border border-gray-200 px-3 py-2" id="revised-supervisor-role"></td>
                            </tr>
                        </table>

                        <div class="bg-red-50 border-l-4 border-red-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium w-1/3 text-red-800">
                                        Alasan Revisi
                                    </h4>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p id="revised-reason-text">Data prestasi yang disubmit tidak sesuai dengan kriteria yang telah ditetapkan.
                                            Silakan periksa kembali kelengkapan berkas dan pastikan semua data sesuai dengan
                                            ketentuan yang berlaku.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-8 text-right">
                    <button
                        class="px-4 py-2 rounded-lg bg-blue-200 text-blue-800 hover:bg-blue-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Lakukan Revisi
                    </button>
                    <button type="button" onclick="closeModal('modal-revised')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL HAPUS --}}
        <div id="modal-hapus"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out pt-16 sm:pt-20 overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button onclick="closeModal('modal-hapus')"
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Prestasi</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Apakah Anda yakin ingin menghapus prestasi ini? Tindakan ini tidak dapat dibatalkan dan data
                        prestasi akan hilang secara permanen.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-3">
                        <button type="button" onclick="closeModal('modal-hapus')"
                            class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button type="button"
                            class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Hapus Prestasi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            const DIALOG_TRANSITION_DURATION = 500; // Corresponds to duration-500 in Tailwind for the dialog
            const OVERLAY_TRANSITION_DURATION = 300; // Corresponds to duration-300 in Tailwind for the overlay

            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'opened' || modal.dataset.state === 'opening') {
                    return;
                }
                const modalDialog = modal.querySelector('.modal-dialog');

                modal.dataset.state = 'opening';
                modal.classList.remove('opacity-0', 'pointer-events-none');
                void modal.offsetWidth; // Force reflow
                modal.classList.add('opacity-100', 'pointer-events-auto');

                if (modalDialog) {
                    modalDialog.classList.remove('-translate-y-full', 'scale-95');
                    modalDialog.classList.add('translate-y-0', 'scale-100');
                }

                const targetElement = modalDialog || modal;
                const duration = modalDialog ? DIALOG_TRANSITION_DURATION : OVERLAY_TRANSITION_DURATION;

                let openTransitionEnded = false;
                const onOpenTransitionEnd = (event) => {
                    if (event.target === targetElement && modal.dataset.state === 'opening' && !openTransitionEnded) {
                        openTransitionEnded = true;
                        modal.dataset.state = 'opened';
                        targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                    }
                };
                targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                targetElement.addEventListener('transitionend', onOpenTransitionEnd);

                setTimeout(() => {
                    if (modal.dataset.state === 'opening' && !openTransitionEnded) {
                        openTransitionEnded = true;
                        modal.dataset.state = 'opened';
                        targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                    }
                }, duration + 70);
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'closed' || modal.dataset.state === 'closing') {
                    return;
                }
                const modalDialog = modal.querySelector('.modal-dialog');

                modal.dataset.state = 'closing';
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                modal.classList.remove('pointer-events-auto');

                if (modalDialog) {
                    modalDialog.classList.remove('translate-y-0', 'scale-100');
                    modalDialog.classList.add('-translate-y-full', 'scale-95');
                }

                const targetElement = modalDialog || modal;
                const duration = modalDialog ? DIALOG_TRANSITION_DURATION : OVERLAY_TRANSITION_DURATION;

                let closeTransitionEnded = false;
                const onCloseTransitionEnd = (event) => {
                    if (event.target === targetElement && modal.dataset.state === 'closing' && !closeTransitionEnded) {
                        closeTransitionEnded = true;
                        modal.classList.add('pointer-events-none');
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                };
                targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                targetElement.addEventListener('transitionend', onCloseTransitionEnd);

                setTimeout(() => {
                    if (modal.dataset.state === 'closing' && !closeTransitionEnded) {
                        closeTransitionEnded = true;
                        modal.classList.add('pointer-events-none');
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                }, duration + 70);
            }

            async function openDetailModal(achievementId) {
                try {
                    const response = await fetch(`/prestasi/detail/${achievementId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const achievement = await response.json();

                    // Populate modal-detail
                    const modalDetail = document.getElementById('modal-detail');
                    modalDetail.querySelector('#detail-competition-name').textContent = achievement.competition_name;
                    modalDetail.querySelector('#detail-organizer').textContent = achievement.competition_location;
                    modalDetail.querySelector('#detail-place').textContent = achievement.place;
                    modalDetail.querySelector('#detail-level').textContent = achievement.level;
                    modalDetail.querySelector('#detail-type').textContent = achievement.competition_type;
                    modalDetail.querySelector('#detail-start-date').textContent = achievement.start_at;
                    modalDetail.querySelector('#detail-end-date').textContent = achievement.end_at;
                    modalDetail.querySelector('#detail-registration-deadline').textContent = achievement.assignment_letter_date;
                    modalDetail.querySelector('#detail-participants').textContent = achievement.partition_number;
                    modalDetail.querySelector('#detail-url').textContent = achievement.competition_url;
                    modalDetail.querySelector('#detail-url').href = achievement.competition_url;
                    modalDetail.querySelector('#detail-description').textContent = achievement.note;

                    // File links
                    modalDetail.querySelector('#detail-file-assignment-letter').href = achievement.assignment_letter_file_path || '#';
                    modalDetail.querySelector('#detail-file-certificate').href = achievement.certificate_file_path || '#';
                    modalDetail.querySelector('#detail-file-activity-photo').href = achievement.activity_photo_file_path || '#';
                    modalDetail.querySelector('#detail-file-poster').href = achievement.poster_file_path || '#';

                    // Participants (assuming achievement.mahasiswa_achievements is an array of objects with nim, role)
                    // This part needs to be dynamic based on the actual data structure
                    // For now, I'll just show placeholders or first few if available
                    if (achievement.mahasiswa_achievements && achievement.mahasiswa_achievements.length > 0) {
                        for (let i = 0; i < 3; i++) { // Assuming max 3 participants for now
                            const participant = achievement.mahasiswa_achievements[i];
                            if (participant) {
                                modalDetail.querySelector(`#detail-participant-name-${i + 1}`).textContent = participant.mahasiswa_name || ''; // Assuming mahasiswa_name exists
                                modalDetail.querySelector(`#detail-participant-role-${i + 1}`).textContent = participant.role || '';
                            } else {
                                modalDetail.querySelector(`#detail-participant-name-${i + 1}`).textContent = '';
                                modalDetail.querySelector(`#detail-participant-role-${i + 1}`).textContent = '';
                            }
                        }
                    } else {
                        for (let i = 0; i < 3; i++) {
                            modalDetail.querySelector(`#detail-participant-name-${i + 1}`).textContent = '';
                            modalDetail.querySelector(`#detail-participant-role-${i + 1}`).textContent = '';
                        }
                    }

                    // Supervisor (assuming achievement.supervisor_achievement is an object with name, role)
                    if (achievement.supervisor_achievement) {
                        modalDetail.querySelector('#detail-supervisor-name').textContent = achievement.supervisor_achievement.dosen_name || ''; // Assuming dosen_name exists
                        modalDetail.querySelector('#detail-supervisor-role').textContent = achievement.supervisor_achievement.role || '';
                    } else {
                        modalDetail.querySelector('#detail-supervisor-name').textContent = '';
                        modalDetail.querySelector('#detail-supervisor-role').textContent = '';
                    }


                    // Update status badge in modal-detail
                    const statusBadgeDetail = modalDetail.querySelector('#detail-status-badge');
                    let statusText = '';
                    let statusClass = '';
                    let statusDotClass = '';

                    switch (achievement.status) {
                        case 'ACCEPTED':
                            statusText = 'Terverifikasi';
                            statusClass = 'bg-green-100 text-green-700';
                            statusDotClass = 'bg-green-500';
                            break;
                        case 'WAITING':
                            statusText = 'Menunggu';
                            statusClass = 'bg-yellow-100 text-yellow-700';
                            statusDotClass = 'bg-yellow-500';
                            break;
                        case 'REJECTED':
                            statusText = 'Ditolak';
                            statusClass = 'bg-red-100 text-red-700'; // Changed to red for rejected
                            statusDotClass = 'bg-red-500'; // Changed to red for rejected
                            break;
                        case 'REVISION':
                            statusText = 'Revisi';
                            statusClass = 'bg-blue-100 text-blue-700'; // Changed to blue for revision
                            statusDotClass = 'bg-blue-500'; // Changed to blue for revision
                            break;
                        default:
                            statusText = 'Unknown';
                            statusClass = 'bg-gray-100 text-gray-700';
                            statusDotClass = 'bg-gray-500';
                    }
                    statusBadgeDetail.setAttribute('class', 'inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold align-middle ' + statusClass);
                    statusBadgeDetail.innerHTML = `<span class="w-2 h-2 rounded-full ${statusDotClass}"></span>${statusText}`;


                    // Open the correct modal based on status
                    if (achievement.status === 'WAITING') {
                        const modalWaiting = document.getElementById('modal-waiting');
                        modalWaiting.querySelector('#waiting-detail-content').textContent = `Detail untuk prestasi "${achievement.competition_name}" sedang menunggu verifikasi.`;
                        openModal('modal-waiting');
                    } else if (achievement.status === 'REJECTED') {
                        const modalRejected = document.getElementById('modal-rejected');
                        modalRejected.querySelector('#rejected-competition-name').textContent = achievement.competition_name;
                        modalRejected.querySelector('#rejected-organizer').textContent = achievement.competition_location;
                        modalRejected.querySelector('#rejected-place').textContent = achievement.place;
                        modalRejected.querySelector('#rejected-level').textContent = achievement.level;
                        modalRejected.querySelector('#rejected-type').textContent = achievement.competition_type;
                        modalRejected.querySelector('#rejected-start-date').textContent = achievement.start_at;
                        modalRejected.querySelector('#rejected-end-date').textContent = achievement.end_at;
                        modalRejected.querySelector('#rejected-participants').textContent = achievement.partition_number;
                        modalRejected.querySelector('#rejected-url').textContent = achievement.competition_url;
                        modalRejected.querySelector('#rejected-url').href = achievement.competition_url;

                        modalRejected.querySelector('#rejected-file-assignment-letter').href = achievement.assignment_letter_file_path || '#';
                        modalRejected.querySelector('#rejected-file-certificate').href = achievement.certificate_file_path || '#';
                        modalRejected.querySelector('#rejected-file-activity-photo').href = achievement.activity_photo_file_path || '#';
                        modalRejected.querySelector('#rejected-file-poster').href = achievement.poster_file_path || '#';

                        if (achievement.mahasiswa_achievements && achievement.mahasiswa_achievements.length > 0) {
                            for (let i = 0; i < 3; i++) {
                                const participant = achievement.mahasiswa_achievements[i];
                                if (participant) {
                                    modalRejected.querySelector(`#rejected-participant-name-${i + 1}`).textContent = participant.mahasiswa_name || '';
                                    modalRejected.querySelector(`#rejected-participant-role-${i + 1}`).textContent = participant.role || '';
                                } else {
                                    modalRejected.querySelector(`#rejected-participant-name-${i + 1}`).textContent = '';
                                    modalRejected.querySelector(`#rejected-participant-role-${i + 1}`).textContent = '';
                                }
                            }
                        } else {
                            for (let i = 0; i < 3; i++) {
                                modalRejected.querySelector(`#rejected-participant-name-${i + 1}`).textContent = '';
                                modalRejected.querySelector(`#rejected-participant-role-${i + 1}`).textContent = '';
                            }
                        }

                        if (achievement.supervisor_achievement) {
                            modalRejected.querySelector('#rejected-supervisor-name').textContent = achievement.supervisor_achievement.dosen_name || '';
                            modalRejected.querySelector('#rejected-supervisor-role').textContent = achievement.supervisor_achievement.role || '';
                        } else {
                            modalRejected.querySelector('#rejected-supervisor-name').textContent = '';
                            modalRejected.querySelector('#rejected-supervisor-role').textContent = '';
                        }

                        modalRejected.querySelector('#rejected-reason-text').textContent = achievement.note; // Assuming 'note' contains rejection reason

                        // Update status badge in modal-rejected
                        const statusBadgeRejected = modalRejected.querySelector('#rejected-status-badge');
                        statusBadgeRejected.setAttribute('class', 'inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold ' + statusClass);
                        statusBadgeRejected.innerHTML = `<span class="w-2 h-2 rounded-full ${statusDotClass}"></span>${statusText}`;

                        openModal('modal-rejected');
                    } else if (achievement.status === 'REVISION') {
                        const modalRevised = document.getElementById('modal-revised');
                        modalRevised.querySelector('#revised-competition-name').textContent = achievement.competition_name;
                        modalRevised.querySelector('#revised-organizer').textContent = achievement.competition_location;
                        modalRevised.querySelector('#revised-place').textContent = achievement.place;
                        modalRevised.querySelector('#revised-level').textContent = achievement.level;
                        modalRevised.querySelector('#revised-type').textContent = achievement.competition_type;
                        modalRevised.querySelector('#revised-start-date').textContent = achievement.start_at;
                        modalRevised.querySelector('#revised-end-date').textContent = achievement.end_at;
                        modalRevised.querySelector('#revised-participants').textContent = achievement.partition_number;
                        modalRevised.querySelector('#revised-url').textContent = achievement.competition_url;
                        modalRevised.querySelector('#revised-url').href = achievement.competition_url;

                        modalRevised.querySelector('#revised-file-assignment-letter').href = achievement.assignment_letter_file_path || '#';
                        modalRevised.querySelector('#revised-file-certificate').href = achievement.certificate_file_path || '#';
                        modalRevised.querySelector('#revised-file-activity-photo').href = achievement.activity_photo_file_path || '#';
                        modalRevised.querySelector('#revised-file-poster').href = achievement.poster_file_path || '#';

                        if (achievement.mahasiswa_achievements && achievement.mahasiswa_achievements.length > 0) {
                            for (let i = 0; i < 3; i++) {
                                const participant = achievement.mahasiswa_achievements[i];
                                if (participant) {
                                    modalRevised.querySelector(`#revised-participant-name-${i + 1}`).textContent = participant.mahasiswa_name || '';
                                    modalRevised.querySelector(`#revised-participant-role-${i + 1}`).textContent = participant.role || '';
                                } else {
                                    modalRevised.querySelector(`#revised-participant-name-${i + 1}`).textContent = '';
                                    modalRevised.querySelector(`#revised-participant-role-${i + 1}`).textContent = '';
                                }
                            }
                        } else {
                            for (let i = 0; i < 3; i++) {
                                modalRevised.querySelector(`#revised-participant-name-${i + 1}`).textContent = '';
                                modalRevised.querySelector(`#revised-participant-role-${i + 1}`).textContent = '';
                            }
                        }

                        if (achievement.supervisor_achievement) {
                            modalRevised.querySelector('#revised-supervisor-name').textContent = achievement.supervisor_achievement.dosen_name || '';
                            modalRevised.querySelector('#revised-supervisor-role').textContent = achievement.supervisor_achievement.role || '';
                        } else {
                            modalRevised.querySelector('#revised-supervisor-name').textContent = '';
                            modalRevised.querySelector('#revised-supervisor-role').textContent = '';
                        }

                        modalRevised.querySelector('#revised-reason-text').textContent = achievement.note; // Assuming 'note' contains revision reason

                        // Update status badge in modal-revised
                        const statusBadgeRevised = modalRevised.querySelector('#revised-status-badge');
                        statusBadgeRevised.setAttribute('class', 'inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold ' + statusClass);
                        statusBadgeRevised.innerHTML = `<span class="w-2 h-2 rounded-full ${statusDotClass}"></span>${statusText}`;

                        openModal('modal-revised');
                    } else {
                        openModal('modal-detail');
                    }

                } catch (error) {
                    console.error('Error fetching achievement details:', error);
                    alert('Failed to load achievement details.');
                }
            }

            $(document).ready(function() {
                var table = $('#achievements-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false, // Disable default search bar
                    lengthChange: false, // Disable "Show X entries" dropdown
                    ajax: {
                        url: "{{ route('mahasiswa.prestasi.data') }}",
                        data: function (d) {
                            d.search = $('#search').val();
                            d.kategori = $('#kategori').val();
                            d.tingkat = $('#tingkat').val();
                            d.status = $('#status').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'competition_name', name: 'competition_name' },
                        { data: 'tag_name', name: 'tag_name' },
                        { data: 'place', name: 'place' },
                        { data: 'level', name: 'level' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: {
                        emptyTable: "Tidak ada data prestasi yang tersedia."
                    }
                });

                $('#filterForm select, #search').on('change keyup', function() {
                    table.draw();
                });
            });
        </script>
    @endpush
@endsection
