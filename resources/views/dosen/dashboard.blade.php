@extends('layout.template')

@section('content')
<!-- Main Content -->
<main class="flex-1 px-10 pb-10">
    <!-- Stats -->
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="flex justify-between w-full">
                <span class="text-2xl font-bold">24</span>
                <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M5 3v18l7-5 7 5V3a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <span class="text-gray-500 text-sm">Total Mahasiswa Bimbingan</span>
            <span class="text-green-500 text-xs mt-2">↑ 10.2 <span class="text-gray-400">+1.01% this month</span></span>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="flex justify-between w-full">
                <span class="text-2xl font-bold">2</span>
                <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <span class="text-gray-500 text-sm">Prestasi menunggu verifikasi</span>
            <span class="text-green-500 text-xs mt-2">↑ 3.1 <span class="text-gray-400">+0.49% this week</span></span>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="flex justify-between w-full">
                <span class="text-2xl font-bold">12</span>
                <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8.21 13.89L7 21l5-3 5 3-1.21-7.11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <span class="text-gray-500 text-sm">Lomba aktif saat ini</span>
            <span class="text-green-500 text-xs mt-2">↑ 7.2 <span class="text-gray-400">+1.51% this week</span></span>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mb-8">
        <!-- Chart 1: Prestasi Berdasarkan Kategori -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="font-bold text-lg mb-1">Prestasi Berdasarkan Kategori</h2>
            <p class="text-gray-400 text-sm mb-4">Jumlah prestasi mahasiswa berdasarkan kategori</p>
            <div class="h-56">
                <canvas id="kategoriChart"></canvas>
            </div>
        </div>
        <!-- Chart 2: Prestasi Berdasarkan Tahun -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="font-bold text-base mb-1">Jumlah Mahasiswa Bimbingan Berdasarkan Tahun</h2>
            <p class="text-gray-400 text-xs mb-4">Jumlah Mahasiswa Bimbingan Berdasarkan Tahun</p>
            <div class="h-56">
                <canvas id="tahunChart"></canvas>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart: Prestasi Berdasarkan Kategori
        new Chart(document.getElementById('kategoriChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Cyber Security', 'IoT', 'UI/UX', 'Infografis', 'Olahraga', 'Essay', 'Lainnya'],
                datasets: [{
                    data: [7, 10, 8, 12, 4, 3, 4],
                    backgroundColor: '#2563eb', // blue-600
                    borderRadius: 8,
                    barPercentage: 1,
                    categoryPercentage: 0.6,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 13
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: '#e5e7eb'
                        },
                        beginAtZero: true,
                        ticks: {
                            stepSize: 2,
                            font: {
                                size: 13
                            }
                        }
                    }
                }
            }
        });

        // Line Chart: Prestasi Berdasarkan Tahun
        new Chart(document.getElementById('tahunChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024'],
                datasets: [{
                    data: [8, 11, 10, 13, 12],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,0.1)',
                    tension: 0.4,
                    fill: false,
                    pointBackgroundColor: '#2563eb',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 13
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: '#e5e7eb'
                        },
                        beginAtZero: true,
                        ticks: {
                            stepSize: 2,
                            font: {
                                size: 13
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection