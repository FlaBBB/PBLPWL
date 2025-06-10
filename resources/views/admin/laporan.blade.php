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
                                <span class="text-5xl font-bold">{{ $totalAchievements }}</span>
                                <p class="text-blue-100 text-lg mt-2">Total Prestasi</p>
                            </div>
                            <div class="text-right">
                                <span
                                    class="text-base font-medium @if($isIncrease) text-green-400 @else text-red-400 @endif">
                                    @if($isIncrease) ↑ @else ↓ @endif {{ number_format($percentageChange, 1) }}%
                                </span>
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
                    <button onclick="window.location.href='{{ route('laporan.exportPdf') }}'"
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
            <!-- Charts dan Tabel Statistik-->
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
                                        @foreach ($achievementsPerYear as $data)
                                            <tr>
                                                <td class="px-3 py-2">{{ $data->year }}</td>
                                                <td class="px-3 py-2 text-right">{{ $data->total }}</td>
                                            </tr>
                                        @endforeach
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
                                        @foreach ($achievementsPerProdi as $data)
                                            <tr>
                                                <td class="px-3 py-2">{{ $data->prodi }}</td>
                                                <td class="px-3 py-2 text-right">{{ $data->total_achievements }}</td>
                                            </tr>
                                        @endforeach
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
                                        @foreach ($achievementsPerLevel as $data)
                                            <tr>
                                                <td class="px-3 py-2">
                                                    @php
                                                        $levelLabels = [
                                                            'INTERNAL' => 'Internal',
                                                            'CITY' => 'Kota/ Kabupaten',
                                                            'PROVINCE' => 'Provinsi',
                                                            'NATIONAL' => 'Nasional',
                                                            'INTERNATIONAL' => 'Internasional'
                                                        ];
                                                    @endphp
                                                    {{ $levelLabels[$data->level->value] ?? $data->level->value }}
                                                </td>
                                                <td class="px-3 py-2 text-right">{{ $data->total }}</td>
                                            </tr>
                                        @endforeach
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
                                        @foreach ($achievementsPerCapaian as $data)
                                            <tr>
                                                <td class="px-3 py-2">{{ $data->capaian }}</td>
                                                <td class="px-3 py-2 text-right">{{ $data->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori Lomba -->
                    <div class="bg-white col-span-2 rounded-xl shadow p-6">
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
                                        @foreach ($achievementsPerCategory as $data)
                                            <tr>
                                                <td class="px-3 py-2">{{ $data->category }}</td>
                                                <td class="px-3 py-2 text-right">{{ $data->total }}</td>
                                            </tr>
                                        @endforeach
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
        const achievementsPerYearData = {!! json_encode($achievementsPerYear) !!};
        const yearLabels = achievementsPerYearData.map(item => item.year);
        const yearData = achievementsPerYearData.map(item => item.total);

        new Chart(document.getElementById('yearChart'), {
            type: 'bar',
            data: {
                labels: yearLabels,
                datasets: [{
                    label: 'Prestasi',
                    data: yearData,
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
        const achievementsPerProdiData = {!! json_encode($achievementsPerProdi) !!};
        const prodiLabels = achievementsPerProdiData.map(item => item.program_studi);
        const prodiData = achievementsPerProdiData.map(item => item.total_achievements);

        new Chart(document.getElementById('prodiChart'), {
            type: 'pie',
            data: {
                labels: prodiLabels,
                datasets: [{
                    data: prodiData,
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#F97316', '#64748B', '#DC2626', '#8B5CF6', '#06B6D4'],
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
        const achievementsPerLevelData = {!! json_encode($achievementsPerLevel) !!};
        const levelLabels = achievementsPerLevelData.map(item => item.level);
        const levelData = achievementsPerLevelData.map(item => item.total);

        new Chart(document.getElementById('levelChart'), {
            type: 'pie',
            data: {
                labels: levelLabels,
                datasets: [{
                    data: levelData,
                    backgroundColor: ['#EF4444', '#F59E0B', '#10B981', '#3B82F6', '#F97316', '#64748B', '#DC2626', '#8B5CF6', '#06B6D4'],
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
        const achievementsPerCapaianData = {!! json_encode($achievementsPerCapaian) !!};
        const capaianLabels = achievementsPerCapaianData.map(item => item.capaian);
        const capaianData = achievementsPerCapaianData.map(item => item.total);

        new Chart(document.getElementById('achievementChart'), {
            type: 'bar',
            data: {
                labels: capaianLabels,
                datasets: [{
                    data: capaianData,
                    backgroundColor: ['#F59E0B', '#9CA3AF', '#F97316', '#3B82F6', '#10B981', '#EF4444', '#64748B', '#DC2626', '#8B5CF6', '#06B6D4'],
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
        const achievementsPerCategoryData = {!! json_encode($achievementsPerCategory) !!};
        const categoryLabels = achievementsPerCategoryData.map(item => item.category);
        const categoryData = achievementsPerCategoryData.map(item => item.total);

        new Chart(document.getElementById('categoryChart'), {
            type: 'pie',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryData,
                    backgroundColor: ['#DC2626', '#8B5CF6', '#06B6D4', '#64748B', '#3B82F6', '#10B981', '#EF4444', '#F59E0B', '#F97316'],
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