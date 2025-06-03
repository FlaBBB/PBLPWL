@extends('layout.template')

@section('content')
    <main class="flex-1 px-6 pb-96">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg relative">
            <div class="mb-4 flex space-x-4 border-b border-gray-200">
                <a href="{{ route('mahasiswa.tambah-lomba') }}">
                    <button id="tab-tambah"
                        class="tab-btn text-sm font-medium py-2 px-3 border-b-4 text-gray-500 border-transparent hover:text-[#1E6AAE]"
                        data-tab="tambah" type="button">
                        Tambah Lomba
                    </button>
                </a>
                <button id="tab-histori" data-tab="histori"
                    class="tab-btn text-sm font-medium py-2 px-3 border-b-4 text-[#1E6AAE] border-[#1E6AAE]" type="button">
                    Riwayat Tambah Lomba
                </button>
            </div>

            <div id="content-histori" class="tab-content p-6">
                <h2 class="text-xl font-semibold mb-2">Riwayat Tambah Lomba</h2>
                <p class="text-sm text-gray-400">Berikut adalah daftar lomba yang telah kamu tambahkan sebelumnya.</p>
                <div class="relative mt-8 border border-gray-200 rounded-sm">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="">
                            <tr class="border-b border-gray-200 text-gray-400">
                                <th class="px-6 py-3 font-semibold">No.</th>
                                <th class="px-6 py-3 font-semibold">Nama Lomba</th>
                                <th class="px-6 py-3 font-semibold">Tanggal Upload</th>
                                <th class="px-6 py-3 font-semibold">Status</th>
                                <th class="px-6 py-3 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @for ($i = 1; $i <= 4; $i++)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-2 ">{{ $i }}</td>
                                    <td class="px-6 py-2 ">Lomba Inovasi Digital</td>
                                    <td class="px-6 py-2 ">2024-06-01</td>
                                    <td class="px-6 py-2 ">
                                        {{-- Aku ngga paham if-else e, tulung --}}
                                        {{-- Ini buat tampilan VERIFIED --}}
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                            Terverifikasi
                                        </span>
                                        {{-- Ini buat tampilan WAITING --}}
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                            Menunggu
                                        </span>
                                        {{-- Ini buat tampilan REJECT --}}
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                            Ditolak
                                        </span>
                                    </td>
                                    {{-- OH IYA KALO TAMBAH LOMBA, GAPERLU ADA STATUS "PERLU REVISI", KALAU DITOLAK YA DITOLAK --}}
                                    <td class="px-6 py-2">
                                        <div class="flex space-x-2"> {{-- Ini kasihin pengkondisian openModal, kalau waiting ya buka modal-waiting--}}
                                            <button onclick="openModal('modal-rejected')"
                                                class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white  px-2 py-2 rounded text-xs flex items-center gap-1"
                                                title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                Lihat detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- MODAL DETAIL VERIFIED --}}
                <div id="modal-detail"
                    class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
                    data-state="closed">
                    <div
                        class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out ">
                        <button onclick="closeModal('modal-detail')"
                            class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 inline-block mr-2">Detail Lomba</h3>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 align-middle">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            Terverifikasi
                        </span>

                        <div class="overflow-x-auto">
                            <table class="w-full max-w-auto text-gray-800 text-left text-sm mt-6">
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium">Nama Lomba</td>
                                    <td class="border border-gray-200 px-3 py-2">Lomba Inovasi Digital</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Penyelenggara
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Institut Teknologi Malang</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tingkat Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Nasional</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Bidang Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Web Development</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-01</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                        Berakhir</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-03</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tenggat
                                        Pendaftaran</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-05-29</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Jumlah
                                        Peserta</td>
                                    <td class="border border-gray-200 px-3 py-2">3</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">URL Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">www.tidaktahu.com</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 align-top font-medium">Deskripsi</td>
                                    <td class="border border-gray-200 px-3 py-2 max-w-xs align-top">
                                        <div class="line-clamp-2 break-words text-ellipsis overflow-hidden"
                                            style="max-width: 24rem;"
                                            title="Deskripsi lomba akan ditampilkan di sini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
                                            Deskripsi lomba akan ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Deskripsi lomba akan
                                            ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-8 text-right">
                            <button type="button" onclick="closeModal('modal-detail')"
                                class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>

                {{-- MODAL WAITING/DIPROSES --}}
                <div id="modal-waiting"
                    class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
                    data-state="closed">
                    <div
                        class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                        <button onclick="closeModal('modal-waiting')"
                            class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 inline-block mr-2">Detail Lomba</h3>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                            <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                            Sedang diproses
                        </span>

                        <div class="overflow-x-auto">
                            <table class="w-full max-w-auto text-gray-800 text-left text-sm mt-6">
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium">Nama Lomba</td>
                                    <td class="border border-gray-200 px-3 py-2">Lomba Inovasi Digital</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Penyelenggara
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Institut Teknologi Malang</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tingkat Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Nasional</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Bidang Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Web Development</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-01</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                        Berakhir</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-03</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tenggat
                                        Pendaftaran</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-05-29</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Jumlah
                                        Peserta</td>
                                    <td class="border border-gray-200 px-3 py-2">3</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">URL Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">www.tidaktahu.com</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 align-top font-medium">Deskripsi</td>
                                    <td class="border border-gray-200 px-3 py-2 max-w-xs align-top">
                                        <div class="line-clamp-2 break-words text-ellipsis overflow-hidden"
                                            style="max-width: 24rem;">
                                            Deskripsi lomba akan ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-8 text-right flex justify-end gap-4">
                            <button onclick="openModal('modal-edit')"
                                class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white px-4 py-2 rounded text-sm font-medium flex items-center gap-1"
                                title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                Edit
                            </button>
                            <button onclick="openModal('modal-hapus')"
                                class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-4 py-2 rounded text-sm font-medium flex items-center gap-1"
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

                {{-- MODAL REJECTED --}}
                <div id="modal-rejected"
                    class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
                    data-state="closed">
                    <div
                        class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out ">
                        <button onclick="closeModal('modal-rejected')"
                            class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 inline-block mr-2">Detail Lomba</h3>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Ditolak
                        </span>

                        <div class="overflow-x-auto">
                            <table class="w-full max-w-auto text-gray-800 text-left text-sm mt-6">
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium">Nama Lomba</td>
                                    <td class="border border-gray-200 px-3 py-2">Lomba Inovasi Digital</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Penyelenggara
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Institut Teknologi Malang</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tingkat Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Nasional</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Bidang Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Web Development</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-01</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                        Berakhir</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-03</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tenggat
                                        Pendaftaran</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-05-29</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Jumlah
                                        Peserta</td>
                                    <td class="border border-gray-200 px-3 py-2">3</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">URL Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">www.tidaktahu.com</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 align-top font-medium">Deskripsi</td>
                                    <td class="border border-gray-200 px-3 py-2 max-w-xs align-top">
                                        <div class="line-clamp-2 break-words text-ellipsis overflow-hidden"
                                            style="max-width: 24rem;">
                                            Deskripsi lomba akan ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Alasan Penolakan --}}
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mt-6">
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
                                    <h4 class="text-sm font-medium text-red-800">
                                        Alasan Penolakan
                                    </h4>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>Data lomba yang disubmit tidak sesuai dengan kriteria yang telah ditetapkan.
                                            Silakan periksa kembali kelengkapan data dan pastikan semua informasi sesuai
                                            dengan
                                            ketentuan yang berlaku.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 text-right">
                            <button type="button" onclick="closeModal('modal-rejected')"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <div class="text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Lomba</h3>
                            <p class="text-sm text-gray-500 mb-6">
                                Apakah Anda yakin ingin menghapus lomba ini? Tindakan ini tidak dapat dibatalkan.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-3 sm:gap-3">
                                <button type="button" onclick="closeModal('modal-hapus')"
                                    class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </button>
                                <button type="button"
                                    class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

    </main>

    <script>
        const DIALOG_TRANSITION_DURATION = 500; // Corresponds to duration-500 in Tailwind for the dialog
        const OVERLAY_TRANSITION_DURATION = 300; // Corresponds to duration-300 in Tailwind for the overlay

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            // Exit if modal doesn't exist or is already open/opening
            if (!modal || modal.dataset.state === 'opened' || modal.dataset.state === 'opening') {
                return;
            }
            const modalDialog = modal.querySelector('.modal-dialog');

            modal.dataset.state = 'opening';
            // Make overlay visible and interactive
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
            const duration = modalDialog ? DIALOG_TRANSITION_DURATION : OVERLAY_TRANSITION_DURATION;

            let openTransitionEnded = false;
            const onOpenTransitionEnd = (event) => {
                // Ensure the event is from the target element and not a child
                if (event.target === targetElement && modal.dataset.state === 'opening' && !openTransitionEnded) {
                    openTransitionEnded = true;
                    modal.dataset.state = 'opened';
                    targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                }
            };
            // Make sure to add the event listener only once if openModal can be called multiple times rapidly
            targetElement.removeEventListener('transitionend', onOpenTransitionEnd); // Remove previous just in case
            targetElement.addEventListener('transitionend', onOpenTransitionEnd);

            // Fallback timeout in case transitionend doesn't fire (e.g., element becomes display:none unexpectedly)
            setTimeout(() => {
                if (modal.dataset.state === 'opening' && !openTransitionEnded) {
                    openTransitionEnded = true;
                    modal.dataset.state = 'opened';
                    targetElement.removeEventListener('transitionend', onOpenTransitionEnd); // Clean up listener
                }
            }, duration + 70); // A little buffer, slightly increased
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            // Exit if modal doesn't exist or is already closed/closing
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
            const duration = modalDialog ? DIALOG_TRANSITION_DURATION : OVERLAY_TRANSITION_DURATION;

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
        }
    </script>



@endsection