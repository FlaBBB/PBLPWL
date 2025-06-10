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
        <div class="col-span-2 bg-white rounded-xl p-6 border border-gray-200">
            <!--contoh saja-->
            @php
            $minat = true;
            @endphp
            <h2 class="font-bold mb-4">Rekomendasi Lomba Untuk Anda ⚡</h2>

            @if ($minat)
            <div>
                <div class="gap-4 grid grid-cols-2">
                    @foreach($rekomendasiLomba as $lomba)
                    <a href="{{ route('mahasiswa.detail-lomba', ['id' => $lomba->id]) }}" class="">
                        <div class="w-auto h-40 min-h-[160px] flex flex-col border border-gray-200 rounded-lg transform hover:-translate-y-1 transition duration-300 hover:shadow-lg hover:border-blue-700">
                            <div class="p-4 flex-1 flex flex-row items-center gap-4">
                                {{-- Poster event --}}  
                                <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                                    <img src="{{ $lomba->poster_url ?? asset('images/poster.jpeg') }}" alt="Banner Event"
                                        class="w-full h-full object-cover object-top">
                                </div>
                                <div class="flex flex-col justify-center flex-1">
                                    <h2 class="text-sm font-medium text-gray-800">{{ \Str::words($lomba->name, 5, '...') }}</h2>
                                    <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>
                                            {{ \Carbon\Carbon::parse($lomba->start_at)->format('d M Y') }}
                                            –
                                            {{ \Carbon\Carbon::parse($lomba->end_at)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-xs text-gray-600 mt-1 gap-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span>{{ $lomba->organizer }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="mt-4 text-right px-2 text-sm text-gray-700 hover:text-[#1e6aae]">
                    <a href="{{ route('mahasiswa.daftar-lomba') }}"
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-lg transition-all duration-250 hover:-translate-y-1 hover:shadow-sm ">
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
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-right px-2 text-sm text-gray-700 hover:text-[#1e6aae]">
            <a href="{{@route("mahasiswa.daftar-achievement")}}"
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
    document.addEventListener('DOMContentLoaded', function() {
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