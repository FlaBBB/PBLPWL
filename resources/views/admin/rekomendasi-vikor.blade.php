@extends('layout.template')

@section('content')
    <main class="flex-1 px-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-lg font-semibold mb-8">Rekomendasi dengan Metode VIKOR</h2>
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
                    <div class="self-start">
                        <h3 class="font-semibold mb-4">Rekomendasi Dosen</h3>
                        <div class="h-full space-y-3">
                            @for($i = 0; $i < 4; $i++)
                                <a href="" class="block h-full">
                                    <div
                                        class="h-full flex flex-col border border-gray-200 rounded-lg transform hover:-translate-y-1 transition duration-300 hover:shadow-lg hover:border-blue-700">
                                        <div class="p-4 flex-1 flex flex-row items-center gap-4">
                                            {{-- Foto dosen --}}
                                            <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                                                <img src="{{ asset('images/dosen-avatar.jpg') }}" alt="Foto Dosen"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex flex-col justify-center flex-1">
                                                <h2 class="text-sm font-medium text-gray-800">Dr. Budiono Siregar, M.Kom</h2>
                                                <div class="grid grid-cols-1 gap-1 mt-1">
                                                    <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.611L5 14.5" />
                                                        </svg>
                                                        <span>Web Development, AI</span>
                                                    </div>

                                                    <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.228V2.721m-2.48 5.228a6.726 6.726 0 0 1-2.748 1.35m0 0V14.25" />
                                                        </svg>
                                                        <span>15x Bimbingan Lomba</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endfor
                        </div>
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
                <h3 class="text-base text-gray-700 mb-2">2. Mencari nilai Fmax dan Fmin</h3>
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
                <h3 class="text-base text-gray-700 mb-2">3. Menghitung Normalisasi</h3>
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
                <h3 class="text-base text-gray-700 mb-2">4. Normalisasi Bobot (F*)</h3>
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
                <h3 class="text-base text-gray-700 mb-2">5. Menghitung Si dan Ri</h3>
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
                <h3 class="text-base text-gray-700 mb-2">6. Mencari nilai max dan min daari Si dan Ri</h3>
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
                            <td class="border border-gray-300 px-4 py-2">Si max</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                        </tr>
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">Si min</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                        </tr>
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">Ri max</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                        </tr>
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">Ri min</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                            <td class="border border-gray-300 px-4 py-2">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">7. Mencari Qi</h3>
                <table class="table-fixed border border-gray-300 w-1/2 text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Qi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                @for ($j = 0; $j < 2; $j++)
                                    <td class="border border-gray-300 px-4 py-2">0</td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="overflow-x-auto mt-6">
                <h3 class="text-base text-gray-700 mb-2">8. Perangkingan berdasarkan Qi</h3>
                <table class="table-fixed border border-gray-300 w-1/2 text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">A</th>
                            <th class="border border-gray-300 px-4 py-2 font-semibold">Qi</th>
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