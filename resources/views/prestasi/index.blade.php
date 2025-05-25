@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Daftar Prestasi</h2>
            <div class="flex flex-wrap gap-4 py-4 items-center">
                <p class="text-gray-400">Lihat dan pantau seluruh prestasi yang telah Anda unggah selama masa studi.
                    Pastikan setiap prestasi disertai bukti sah seperti sertifikat atau surat keterangan resmi.</p>
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
                            <option disabled selected hidden>Tanggal</option>
                            <option>Terbaru</option>
                            <option>Terlama</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <table class="w-full text-left text-sm bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3 flex items-center gap-1">
                                Nama Lomba <button type="button"
                                    class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-6 text-gray-400 inline-block align-middle">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                    </svg>
                                </button>
                            </th>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Ranking <button type="button"
                                    class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-6 text-gray-400 inline-block align-middle">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                    </svg>
                                </button>
                            </th>
                            <th class="py-2 px-3">Tingkat</th>
                            <th class="py-2 px-3">Status <button type="button"
                                    class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-6 text-gray-400 inline-block align-middle">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                    </svg>
                                </button>
                            </th>
                            <th class="py-2 px-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">1</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">2</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">3</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">4</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">5</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">6</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">7</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">8</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">9</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">10</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">11</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">12</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">13</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">14</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">15</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">Terverifikasi</td>
                            <td class="py-2 px-3">ooo</td>
                    </tbody>
                </table>
            </div>
    </main>
@endsection