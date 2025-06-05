@extends('layout.template')

@section('content')
    <main class="flex-1 px-10 pb-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Analisis Data Prestasi</h2>
            </div>

            <!-- Stats Cards -->
            <div class="mb-8">
                <!-- Total Prestasi Card -->
                <div class="col-span-2">
                    <div class="bg-gradient-to-br from-[#1e6aae] to-[#17497C] rounded-xl shadow-lg p-8 text-white">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-5xl font-bold">245</span>
                                <p class="text-blue-100 text-lg mt-2">Total Prestasi</p>
                            </div>
                            <div class="text-right">
                                <span class="text-blue-100 text-base font-medium">↑ 12.5%</span>
                                <span class="text-blue-100 text-base ml-2">dari tahun lalu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search & Export -->
            <div class="flex justify-end items-center mb-6">
                <div class="flex items-center gap-2">
                    <p class="text-sm text-gray-700 mr-2">Buat Laporan Analisis:</p>
                    <button
                        class="inline-flex items-center px-4 py-2 border border-red-600 text-red-600 rounded-lg text-sm font-medium hover:bg-red-600 hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                        </svg>
                        Export PDF
                    </button>
                    <button
                        class="inline-flex items-center px-4 py-2 border border-green-600 text-green-600 rounded-lg text-sm font-medium hover:bg-green-600 hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                        </svg>
                        Export Excel
                    </button>
                </div>
            </div>
            <!-- Charts-->
            <div class="grid grid-cols-1 gap-8 mb-8">
                <!-- Charts Section -->
                <div class="grid grid-cols-2 gap-6">
                    <!-- Prestasi per Tahun -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="font-bold mb-4">Prestasi per Tahun</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="h-48">
                                <canvas id="yearChart"></canvas>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-3 py-2 text-left font-medium text-gray-700">Tahun</th>
                                            <th class="px-3 py-2 text-right font-medium text-gray-700">Prestasi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-3 py-2">2020</td>
                                            <td class="px-3 py-2 text-right">25</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">2021</td>
                                            <td class="px-3 py-2 text-right">42</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">2022</td>
                                            <td class="px-3 py-2 text-right">67</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">2023</td>
                                            <td class="px-3 py-2 text-right">89</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">2024</td>
                                            <td class="px-3 py-2 text-right">95</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Prestasi per Program Studi -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="font-bold mb-4">Prestasi per Prodi</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="h-48">
                                <canvas id="prodiChart"></canvas>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-3 py-2 text-left font-medium text-gray-700">Program Studi</th>
                                            <th class="px-3 py-2 text-right font-medium text-gray-700">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-3 py-2">Teknik Informatika</td>
                                            <td class="px-3 py-2 text-right">120</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Sistem Informasi</td>
                                            <td class="px-3 py-2 text-right">80</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Teknik Komputer</td>
                                            <td class="px-3 py-2 text-right">45</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tingkat Lomba -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="font-bold mb-4">Tingkat Lomba</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="h-48">
                                <canvas id="levelChart"></canvas>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-3 py-2 text-left font-medium text-gray-700">Tingkat</th>
                                            <th class="px-3 py-2 text-right font-medium text-gray-700">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-3 py-2">Internasional</td>
                                            <td class="px-3 py-2 text-right">67</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Nasional</td>
                                            <td class="px-3 py-2 text-right">123</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Regional</td>
                                            <td class="px-3 py-2 text-right">55</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Distribusi Capaian -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="font-bold mb-4">Distribusi Capaian</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="h-48">
                                <canvas id="achievementChart"></canvas>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-3 py-2 text-left font-medium text-gray-700">Capaian</th>
                                            <th class="px-3 py-2 text-right font-medium text-gray-700">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-3 py-2">Juara 1</td>
                                            <td class="px-3 py-2 text-right">89</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Juara 2</td>
                                            <td class="px-3 py-2 text-right">78</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Juara 3</td>
                                            <td class="px-3 py-2 text-right">78</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori Lomba -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <h3 class="font-bold mb-4">Kategori Lomba</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="h-48">
                                <canvas id="categoryChart"></canvas>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-3 py-2 text-left font-medium text-gray-700">Kategori</th>
                                            <th class="px-3 py-2 text-right font-medium text-gray-700">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-3 py-2">Cyber Security</td>
                                            <td class="px-3 py-2 text-right">92</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">UI/UX</td>
                                            <td class="px-3 py-2 text-right">68</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Web</td>
                                            <td class="px-3 py-2 text-right">54</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">Lainnya</td>
                                            <td class="px-3 py-2 text-right">31</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // 1. Prestasi per Tahun (Bar Chart)
        new Chart(document.getElementById('yearChart'), {
            type: 'bar',
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024'],
                datasets: [{
                    label: 'Prestasi',
                    data: [25, 42, 67, 89, 95],
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
                labels: ['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer'],
                datasets: [{
                    data: [120, 80, 45],
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15 } } }
            }
        });

        // 3. Tingkat Lomba (Pie Chart)
        new Chart(document.getElementById('levelChart'), {
            type: 'pie',
            data: {
                labels: ['Internasional', 'Nasional', 'Regional'],
                datasets: [{
                    data: [67, 123, 55],
                    backgroundColor: ['#EF4444', '#F59E0B', '#10B981'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15 } } }
            }
        });

        // 4. Distribusi Capaian (Bar Chart)
        new Chart(document.getElementById('achievementChart'), {
            type: 'bar',
            data: {
                labels: ['Juara 1', 'Juara 2', 'Juara 3'],
                datasets: [{
                    data: [89, 78, 78],
                    backgroundColor: ['#F59E0B', '#9CA3AF', '#F97316'],
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

        // 5. Kategori Lomba (Pie Chart)
        new Chart(document.getElementById('categoryChart'), {
            type: 'pie',
            data: {
                labels: ['Cyber Security', 'UI/UX', 'Web', 'Lainnya'],
                datasets: [{
                    data: [92, 68, 54, 31],
                    backgroundColor: ['#DC2626', '#8B5CF6', '#06B6D4', '#64748B'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15 } } }
            }
        });

        function viewDetail(id) {
            alert('Menampilkan detail prestasi ID: ' + id);
        }
    </script>
@endsection