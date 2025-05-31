@extends('layout.template')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow border border-gray-200 p-6 space-y-6 outline-1 outline-gray-200">
            <h2 class="text-xl font-bold">Laporan</h2>
            <p class="text-gray-400">Lengkapi data prestasi yang telah kamu raih selama masa studi. Pastikan kamu mengunggah bukti yang valid seperti sertifikat atau surat keterangan resmi.</p>

            <!-- Filter -->
            <div class="flex flex-col md:flex-row flex-wrap md:items-center gap-3 mb-6">
                <input type="text" placeholder="🔍 Cari disini" class="px-3 py-2 border rounded-md w-full md:w-60 text-sm focus:outline-none outline-1 outline-gray-200 focus:ring-2 focus:ring-blue-400">
                <select class="px-3 py-2 border rounded-md text-sm bg-white w-full md:w-48 focus:outline-none outline-1 outline-gray-200">
                    <option>Tahun Akademik</option>
                    <option>2022/2023</option>
                    <option>2023/2024</option>
                </select>
                <select class="px-3 py-2 border rounded-md text-sm bg-white w-full md:w-48 focus:outline-none outline-1 outline-gray-200">
                    <option>Jenis Lomba</option>
                    <option>Cyber Security</option>
                    <option>UI/UX</option>
                </select>
                <button class="flex items-center px-4 py-2 bg-white text-red-600 border border-red-400 rounded-md text-sm font-medium hover:bg-red-100 outline-1 outline-gray-200">
                    <i class="fas fa-file-pdf mr-1"></i> Ekspor PDF
                </button>
                <button class="flex items-center px-4 py-2 bg-white text-green-700 border border-green-500 rounded-md text-sm font-medium hover:bg-green-100 outline-1 outline-gray-200">
                    <i class="fas fa-file-excel mr-1"></i> Ekspor Excel
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white text-sm text-center border rounded-lg overflow-hidden">
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
                    <tbody class="text-black-700">
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Andi Muhammad Pratama</td>
                            <td class="px-4 py-2">Hackathon Merdeka</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara 1</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-grey-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100 outline-1 outline-gray-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">2</td>
                            <td class="px-4 py-2">Desi Ayu Lestari</td>
                            <td class="px-4 py-2">Web Design Competition</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara 3</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-grey-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100 outline-1 outline-gray-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                       <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">3</td>
                            <td class="px-4 py-2">Fajar Rizky Nugraha</td>
                            <td class="px-4 py-2">GEMASTIK</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara 1</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-grey-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100 outline-1 outline-gray-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">4</td>
                            <td class="px-4 py-2">Nadya Meisya Rahmawati</td>
                            <td class="px-4 py-2">Hackathon Merdeka</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara 1</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-black-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100 outline-1 outline-gray-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">5</td>
                            <td class="px-4 py-2">Siti Nurhaliza Zahra</td>
                            <td class="px-4 py-2">Techcomp Fest</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara 2</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-grey-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100 outline-1 outline-gray-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">6</td>
                            <td class="px-4 py-2">Bayu Aditya Saputra</td>
                            <td class="px-4 py-2">ITFEST 2021</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara 2</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-grey-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100 outline-1 outline-gray-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">7</td>
                            <td class="px-4 py-2">Rizky Maulana</td>
                            <td class="px-4 py-2">Hackathon Merdeka</td>
                            <td class="px-4 py-2">Cyber Security</td>
                            <td class="px-4 py-2">Juara 1</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center px-3 py-1 bg-white text-grey-500 border border-gray-200 rounded-md text-sm font-medium hover:bg-gray-100 outline-1 outline-gray-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat detail
                                </button>
                            </td>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection