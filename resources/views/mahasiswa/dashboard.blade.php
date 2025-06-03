@extends('layout.template')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 px-10 pb-10">
        <!-- Stats -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">{{ $data['totalPrestasi'] }}</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M5 3v18l7-5 7 5V3a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2z" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Total prestasi</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">{{ $data['totalWaitedPrestasi'] }}</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Prestasi menunggu verifikasi</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">{{ $data['totalActiveCompetition'] }}</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.21 13.89L7 21l5-3 5 3-1.21-7.11" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Lomba aktif saat ini</span>
            </div>
        </div>
        <!-- Recommendations & Chart -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="col-span-2 bg-white rounded-xl shadow p-6">
                <h2 class="font-bold mb-4">Rekomendasi Lomba Untuk Anda ⚡</h2>
                <div class=" space-y-2">
                    @for($i = 0; $i < 3; $i++)
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
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <h2 class="font-bold mb-4">Prestasimu</h2>
                <!-- Placeholder for chart -->
                <div class="w-36 h-36 mb-4">
                    <canvas id="prestasiChart" width="120" height="120"></canvas>
                </div>
                <div class="flex flex-col gap-1 text-xs text-gray-500">
                    @php
                        $colors = ['#3B82F6', '#EC4899', '#FACC15', '#FB923C', '#6B7280', '#10B981', '#EF4444']; // Add more colors if needed
                        $i = 0;
                    @endphp
                    @foreach($data['acceptedAchievementsByTag'] as $achievement)
                        <span><span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $colors[$i % count($colors)] }}"></span>{{ $achievement->name }} ({{ $achievement->total }})</span>
                        @php $i++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Latest Achievements Table -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold">Prestasi Terbaru</h2>
                <div>
                    <button class="border px-3 py-1 rounded text-sm text-gray-500">Semester <svg class="w-4 h-4 inline ml-1"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></button>
                </div>
            </div>
            <table class="w-full text-left text-sm bg-white rounded-lg overflow-hidden">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-2 px-3">No</th>
                        <th class="py-2 px-3 flex items-center gap-1">
                            Nama Lomba <button type="button"
                                class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6 text-gray-400 inline-block align-middle">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </button>
                        </th>
                        <th class="py-2 px-3">Kategori</th>
                        <th class="py-2 px-3">Ranking <button type="button"
                                class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6 text-gray-400 inline-block align-middle">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </button>
                        </th>
                        <th class="py-2 px-3">Tingkat</th>
                        <th class="py-2 px-3">Status <button type="button"
                                class="ml-1 p-1 rounded hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6 text-gray-400 inline-block align-middle">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </button>
                        </th>
                        <th class="py-2 px-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['listPrestasi'] as $index => $prestasi)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-3">{{ $index + 1 }}</td>
                            <td class="py-2 px-3">{{ $prestasi->competition_name }}</td>
                            <td class="py-2 px-3">{{ $prestasi->tag_name }}</td>
                            <td class="py-2 px-3">{{ $prestasi->place }}</td>
                            <td class="py-2 px-3">{{ $prestasi->level }}</td>
                            <td class="py-2 px-3">
                                @if($prestasi->status == \App\Enums\AchievementStatusEnum::ACCEPTED->value)
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        Terverifikasi
                                    </span>
                                @elseif($prestasi->status == \App\Enums\AchievementStatusEnum::WAITING->value)
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                        Sedang Diproses
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        DITOLAK
                                    </span>
                                @endif
                            </td>
                            <td class="py-2 px-3">
                                <div class="flex space-x-2">
                                    <button onclick="openModal('modal-detail')"
                                        class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white  px-2 py-2 rounded text-xs flex items-center gap-1"
                                        title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" class="size-4">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('prestasiChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($data['acceptedAchievementsByTag']->pluck('name')),
                    datasets: [{
                        data: @json($data['acceptedAchievementsByTag']->pluck('total')),
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
