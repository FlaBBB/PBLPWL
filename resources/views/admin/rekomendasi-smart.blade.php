@extends('layout.template')

@section('content')
    <main class="flex-1 px-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-lg font-semibold mb-8">Rekomendasi dengan Metode SMART</h2>
            <div class="flex items-center space-x-4">
                <p class="text-gray-700 text-sm mb-0">Pilih bidang Lomba</p>
                <div class="relative">
                    <select name="bidang_lomba" id="bidang_lomba"
                        class="block w-full px-3 py-2 pr-10 border border-gray-300 bg-white rounded-md appearance-none focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-400">
                        <option value="">--</option>
                        <option value="sains">Sains</option>
                        <option value="teknologi">Teknologi</option>
                        <option value="seni">Seni</option>
                        <option value="olahraga">Olahraga</option>
                    </select>

                    <!-- Ikon chevron -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center grid grid-cols-2 mt-4 gap-6">
                <div class="w-full p-4 border border-gray-200 rounded-lg">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-400">
                                <th class="py-3 py-2 font-semibold">Rank</th>
                                <th class="py-3 px-2 py-2 font-semibold">Nama Mahasiswa</th>
                                <th class="py-3 px-2 py-2 font-semibold">Kelas</th>
                                <th class="py-3 px-2 py-2 font-semibold">Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 2; $i++)
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-2">1</td>
                                    <td class="py-3 px-2">Kapiten Pattimura</td>
                                    <td class="py-3 px-2">TI-2E</td>
                                    <td class="py-3 px-2">20,118</td>
                                </tr>
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-2">2</td>
                                    <td class="py-3 px-2">Pangeran Diponegoro</td>
                                    <td class="py-3 px-2">TI-2E</td>
                                    <td class="py-3 px-2">20,118</td>
                                </tr>
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-2">3</td>
                                    <td class="py-3 px-2">Cut Nyak Dhien</td>
                                    <td class="py-3 px-2">TI-2E</td>
                                    <td class="py-3 px-2">20,118</td>
                                </tr>
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-2">4</td>
                                    <td class="py-3 px-2">Radjiman Wedyodiningrat</td>
                                    <td class="py-3 px-2">TI-2E</td>
                                    <td class="py-3 px-2">20,118</td>
                                </tr>
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-2">5</td>
                                    <td class="py-3 px-2">Muhammad Hatta</td>
                                    <td class="py-3 px-2">TI-2E</td>
                                    <td class="py-3 px-2">20,118</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="self-start">
                    <h3 class="font-semibold mb-4">Daftar Lomba Relevan</h3>
                    <div class="h-full space-y-3">
                        @for($i = 0; $i < 4; $i++)
                            <a href="" class="block h-full">
                                <div
                                    class="h-full flex flex-col border border-gray-200 rounded-lg transform hover:-translate-y-1 transition duration-300 hover:shadow-lg hover:border-blue-700">
                                    <div class="p-4 flex-1 flex flex-row items-center gap-4">
                                        {{-- Poster event --}}
                                        <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                                            <img src="{{ asset('images/poster.jpeg') }}" alt="Banner Event"
                                                class="w-full h-full object-cover object-top">
                                        </div>
                                        <div class="flex flex-col justify-center flex-1">
                                            <h2 class="text-sm font-medium text-gray-800">Hackathon Merdeka Jawa</h2>
                                            <div class="grid grid-cols-2 gap-1 mt-1">
                                                <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>21 Agustus – 22 Agustus 2020</span>
                                                </div>

                                                <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                                    </svg>

                                                    <span>TIM - 4 orang</span>
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
                                                <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                                    </svg>

                                                    <span>Nasional</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endfor
                    </div>
                    <div class="mt-4 text-right px-2 text-sm text-gray-700 hover:text-[#1e6aae]">
                        <a href=""
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-lg transition-all duration-250 hover:-translate-y-1 hover:shadow-sm ">
                            <!-- beri link ke menu daftar prestasi mahasiswa saat ini -->
                            Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Langkah-langkah --}}
            <h2 class="mt-8 text-lg font-semibold">Langkah Perhitungan</h2>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">1. Matriks Awal</h3>
                <table class="table-fixed border border-gray-300 w-full text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 1 (IPK)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 2 (Prestasi)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 3 (Frekuensi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 4; $i++)
                            <tr>
                                @for ($j = 0; $j < 4; $j++)
                                    <td class="border border-gray-300 px-4 py-2">0</td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">2. Normalisasi Bobot</h3>
                <table class="table-fixed border border-gray-300 w-full text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 1 (IPK)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 2 (Prestasi)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 3 (Frekuensi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 4; $i++)
                            <tr>
                                @for ($j = 0; $j < 4; $j++)
                                    <td class="border border-gray-300 px-4 py-2">0</td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">3. Mencari nilai <span class="font-mono">C<sub>max</sub></span> dan
                    <span class="font-mono">C<sub>min</sub></span>
                </h3>
                <table class="table-fixed border border-gray-300 w-full text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 1 (IPK)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 2 (Prestasi)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 3 (Frekuensi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">F max</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                        </tr>
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">F min</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">4. Menghitung Utility Alternatif <span
                        class="font-mono">u<sub>i</sub></span><span class="font-mono">(a<sub>i</sub>)</span></h3>
                <table class="table-fixed border border-gray-300 w-full text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 1 (IPK)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 2 (Prestasi)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 3 (Frekuensi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 4; $i++)
                            <tr>
                                @for ($j = 0; $j < 4; $j++)
                                    <td class="border border-gray-300 px-4 py-2">0</td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">5. Menghitung Nilai Akhir Alternatif</h3>
                <table class="table-fixed border border-gray-300 w-full text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 1 (IPK)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 2 (Prestasi)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Kriteria 3 (Frekuensi)</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Total skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr>
                                @for ($j = 0; $j < 5; $j++)
                                    <td class="border border-gray-300 px-4 py-2">0</td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">6. Perangkingan berdasarkan total skor</h3>
                <table class="table-fixed border border-gray-300 w-1/2 text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Total Skor</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 3; $i++)
                            <tr>
                                @for ($j = 0; $j < 3; $j++)
                                    <td class="border border-gray-300 px-4 py-2">0</td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection