@extends('layout.template')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 px-10 pb-10">
        <!-- Stats -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">24</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M5 3v18l7-5 7 5V3a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2z" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Total prestasi</span>
                <span class="text-green-500 text-xs mt-2">↑ 10.2 <span class="text-gray-400">+1.01% this month</span></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">2</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Prestasi menunggu verifikasi</span>
                <span class="text-green-500 text-xs mt-2">↑ 3.1 <span class="text-gray-400">+0.49% this week</span></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">12</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.21 13.89L7 21l5-3 5 3-1.21-7.11" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Lomba aktif saat ini</span>
                <span class="text-green-500 text-xs mt-2">↑ 7.2 <span class="text-gray-400">+1.51% this week</span></span>
            </div>
        </div>
        <!-- Recommendations & Chart -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="col-span-2 bg-white rounded-xl p-6 border border-gray-200">
                <!--contoh saja-->
                @php 
                    $minat = true;
                @endphp
                <h2 class="font-bold mb-4">Rekomendasi Lomba Untuk Anda ⚡</h2>

                @if ($minat) <!-- Kalau preferensi sudah di pilih/ ditentukan -->
                    <div>
                        <div class="gap-4 grid grid-cols-2">
                            @for($i = 0; $i < 4; $i++) {{--Munculkan 4 daftar/ katalog lomba --}}
                                <a href="" class=""> {{--route menuju ke detail lomba yang sesuai --}}
                                    <div
                                        class=" w-auto flex flex-col border border-gray-200 rounded-lg transform hover:-translate-y-1 transition duration-300 hover:shadow-lg hover:border-blue-700">
                                        <div class="p-4 flex-1 flex flex-row items-center gap-4">
                                            {{-- Poster event --}}
                                            <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                                                <img src="{{ asset('images/poster.jpeg') }}" alt="Banner Event"
                                                    class="w-full h-full object-cover object-top">
                                            </div>
                                            <div class="flex flex-col justify-center flex-1">
                                                <h2 class="text-sm font-medium text-gray-800">Hackathon Merdeka Jawa</h2>
                                                <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
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
                                    </div>
                                </a>
                            @endfor
                        </div>
                        <div class="mt-4 text-right px-2 text-sm text-gray-700 hover:text-[#1e6aae]">
                            <a href=""
                                class="inline-flex items-center gap-1 px-3 py-1 rounded-lg transition-all duration-250 hover:-translate-y-1 hover:shadow-sm ">
                                <!-- beri link ke menu daftar lomba/ katalog lomba dang langsung terfilter sesuai preferensi mahasiswa saat ini -->
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @elseif (!$minat) <!-- Kalau preferensi belum di pilih/ ditentukan -->
                    <div class="text-center text-gray-500 border border-gray-300 p-4 rounded-md">
                        <p class="mb-3 text-sm flex items-center gap-2 text-left text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-[#1E6AAE]" size="5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Anda belum menetapkan minat dan keahlian. Yuk lengkapi agar bisa dapat rekomendasi lomba yang
                            sesuai!
                        </p>
                        <div class="text-right">
                            <a href=""
                                class="inline-flex items-center gap-2 text-xs border border-[#1E6AAE] text-[#1E6AAE] py-2 px-3 rounded hover:bg-[#1E6AAE] hover:text-white transition">
                                Atur Preferensi
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                @endif
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-6 flex flex-col items-center">
                <h2 class="font-bold mb-4">Prestasimu</h2>
                <!-- Placeholder for chart -->
                <div class="w-36 h-36 mb-4">
                    <canvas id="prestasiChart" width="120" height="120"></canvas>
                </div>
                <div class="flex flex-col gap-1 text-xs text-gray-500">
                    <span><span class="inline-block w-3 h-3 bg-blue-500 rounded-full mr-2"></span>IT (7)</span>
                    <span><span class="inline-block w-3 h-3 bg-pink-500 rounded-full mr-2"></span>Olahraga (3)</span>
                    <span><span class="inline-block w-3 h-3 bg-yellow-400 rounded-full mr-2"></span>Essay (2)</span>
                    <span><span class="inline-block w-3 h-3 bg-orange-400 rounded-full mr-2"></span>Lorem (2)</span>
                </div>
            </div>
        </div>
        <!-- Latest Achievements Table -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold">Prestasi Terbaru</h2>
            </div>
            <table class="w-full text-left text-sm bg-white rounded-lg overflow-hidden">
                <thead class="text-gray-500">
                    <tr class="border-b border-gray-200">
                        <th class="py-2 px-3">No</th>
                        <th class="py-2 px-3 flex items-center gap-1">
                            Nama Lomba <button type="button"
                                class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </button>
                        </th>
                        <th class="py-2 px-3">Kategori</th>
                        <th class="py-2 px-3">Ranking <button type="button"
                                class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </button>
                        </th>
                        <th class="py-2 px-3">Tingkat</th>
                        <th class="py-2 px-3">Status <button type="button"
                                class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @for ($i = 0; $i < 3; $i++)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">{{ $i + 1 }}</td>
                            <td class="py-2 px-3">Hackathon Merdeka</td>
                            <td class="py-2 px-3">Software Development</td>
                            <td class="py-2 px-3">Juara 2</td>
                            <td class="py-2 px-3">Nasional</td>
                            <td class="py-2 px-3">
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Terverifikasi
                                </span>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div class="mt-4 text-right px-2 text-sm text-gray-700 hover:text-[#1e6aae]">
                <a href=""
                    class="inline-flex items-center gap-1 px-3 py-1 rounded-lg transition-all duration-250 hover:-translate-y-1 hover:shadow-sm ">
                    <!-- beri link ke menu daftar prestasi mahasiswa saat ini -->
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('prestasiChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['IT', 'Olahraga', 'Essay', 'Lorem'],
                    datasets: [{
                        data: [7, 3, 2, 2],
                        backgroundColor: [
                            '#3B82F6', // blue-500
                            '#EC4899', // pink-500
                            '#FACC15', // yellow-400
                            '#FB923C' // orange-400
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
@endsection