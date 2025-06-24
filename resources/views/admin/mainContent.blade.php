@extends('layout.template')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 px-10 pb-10">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <!-- Total Prestasi Card -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">{{ $totalAchievements }}</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path d="M5 3v18l7-5 7 5V3a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2z" stroke-width="2" 
                              stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Total prestasi</span>
            </div>
            
            <!-- Prestasi Menunggu Verifikasi Card -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">{{ $pendingAchievements }}</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke-width="2" 
                              stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Prestasi menunggu verifikasi</span>
                <div class="w-full justify-end text-right text-sm text-gray-700 hover:text-[#1e6aae] mt-2">
                    <a href="{{route('admin.verifikasi-achievement')}}"
                       class="inline-flex items-center gap-1 px-3 py-1 rounded-lg transition-all duration-250 hover:-translate-y-1 hover:shadow-sm">
                        Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Lomba Aktif Card -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold">{{ $activeCompetitions }}</span>
                    <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.21 13.89L7 21l5-3 5 3-1.21-7.11" stroke-width="2" 
                              stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Lomba aktif saat ini</span>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-base font-semibold text-gray-500 mb-4">Statistik Prestasi Mahasiswa</h2>
            <div class="grid grid-cols-3 gap-6 mb-8">
                <!-- Prestasi per Tahun Chart -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold mb-4">Prestasi per Tahun</h3>
                    <div class="h-48">
                        <canvas id="yearChart"></canvas>
                    </div>
                </div>
                <!-- Prestasi per Program Studi Chart -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold mb-4">Prestasi per Prodi</h3>
                    <div class="h-48">
                        <canvas id="prodiChart"></canvas>
                    </div>
                </div>
                <!-- Tingkat Lomba Chart -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold mb-4">Tingkat Lomba</h3>
                    <div class="h-48">
                        <canvas id="levelChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Selengkapnya Button -->
            <div class="mt-4 text-right px-2 text-sm text-gray-700 hover:text-[#1e6aae]">
                <a href="{{ route('admin.laporan') }}"
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

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Prestasi per Tahun (Bar Chart)
            new Chart(document.getElementById('yearChart'), {
                type: 'bar',
                data: {
                    labels: JSON.parse('@json($yearLabels)'),
                    datasets: [{
                        label: 'Prestasi',
                        data: JSON.parse('@json($yearData)'),
                        backgroundColor: '#3B82F6',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // 2. Prestasi per Program Studi (Pie Chart)
            new Chart(document.getElementById('prodiChart'), {
                type: 'pie',
                data: {
                    labels: JSON.parse('@json($prodiLabels)'),
                    datasets: [{
                        data: JSON.parse('@json($prodiData)'),
                        backgroundColor: ['#3B82F6', '#10B981', '#F59E0B'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });

            // 3. Tingkat Lomba (Pie Chart)
            new Chart(document.getElementById('levelChart'), {
                type: 'pie',
                data: {
                    labels: JSON.parse('@json($levelLabels)'),
                    datasets: [{
                        data: JSON.parse('@json($levelData)'),
                        backgroundColor: ['#EF4444', '#F59E0B', '#10B981'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection