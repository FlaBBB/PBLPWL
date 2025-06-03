@extends('layout.template')

@section('content')
    <main class="flex-1 px-10 pb-10">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Rekap Prestasi Mahasiswa</h2>
            <p class="text-gray-500 text-sm mt-1">Dashboard analitik untuk memantau dan mengevaluasi pencapaian prestasi mahasiswa dalam berbagai kompetisi dan lomba.</p>
        </div>

        <!-- Search & Export -->
        <div class="flex justify-between items-center mb-6">
            <div class="relative">
                <input type="text" placeholder="🔍 Cari mahasiswa, lomba, atau dosen..."
                    class="pl-4 pr-10 py-2 border border-gray-200 rounded-lg w-80 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white shadow-sm">
            </div>
            <div class="flex gap-2">
                <button class="inline-flex items-center px-4 py-2 border border-red-300 text-red-600 rounded-lg text-sm font-medium hover:bg-red-50 bg-white shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                    </svg>
                    Export PDF
                </button>
                <button class="inline-flex items-center px-4 py-2 border border-green-300 text-green-600 rounded-lg text-sm font-medium hover:bg-green-50 bg-white shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                    </svg>
                    Export Excel
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold text-gray-800">245</span>
                    <svg class="w-9 h-9 text-blue-500 bg-blue-50 rounded-xl p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Total prestasi</span>
                <span class="text-green-500 text-xs mt-2">↑ 12.5% <span class="text-gray-400">dari tahun lalu</span></span>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold text-gray-800">89</span>
                    <svg class="w-9 h-9 text-yellow-500 bg-yellow-50 rounded-xl p-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Juara 1</span>
                <span class="text-green-500 text-xs mt-2">↑ 8.2% <span class="text-gray-400">dari tahun lalu</span></span>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold text-gray-800">78</span>
                    <svg class="w-9 h-9 text-gray-500 bg-gray-50 rounded-xl p-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Juara 2</span>
                <span class="text-green-500 text-xs mt-2">↑ 5.1% <span class="text-gray-400">dari tahun lalu</span></span>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold text-gray-800">78</span>
                    <svg class="w-9 h-9 text-orange-500 bg-orange-50 rounded-xl p-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Juara 3</span>
                <span class="text-green-500 text-xs mt-2">↑ 3.8% <span class="text-gray-400">dari tahun lalu</span></span>
            </div>

            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                <div class="flex justify-between w-full">
                    <span class="text-2xl font-bold text-gray-800">156</span>
                    <svg class="w-9 h-9 text-green-500 bg-green-50 rounded-xl p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-gray-500 text-sm">Mahasiswa aktif</span>
                <span class="text-green-500 text-xs mt-2">↑ 15.3% <span class="text-gray-400">dari tahun lalu</span></span>
            </div>
        </div>

        <!-- Charts & Top Students -->
        <div class="grid grid-cols-3 gap-8 mb-8">
            <!-- Charts Section -->
            <div class="col-span-2 grid grid-cols-2 gap-6">
                <!-- Prestasi per Tahun -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold mb-4">Prestasi per Tahun</h3>
                    <div class="h-48">
                        <canvas id="yearChart"></canvas>
                    </div>
                </div>

                <!-- Prestasi per Program Studi -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold mb-4">Prestasi per Prodi</h3>
                    <div class="h-48">
                        <canvas id="prodiChart"></canvas>
                    </div>
                </div>

                <!-- Tingkat Lomba -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold mb-4">Tingkat Lomba</h3>
                    <div class="h-48">
                        <canvas id="levelChart"></canvas>
                    </div>
                </div>

                <!-- Distribusi Capaian -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-bold mb-4">Distribusi Capaian</h3>
                    <div class="h-48">
                        <canvas id="achievementChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top 10 Mahasiswa Berprestasi -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold mb-4">Top 10 Mahasiswa ⚡</h3>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @for($i = 1; $i <= 10; $i++)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full {{ $i <= 3 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }} flex items-center justify-center mr-3 font-bold text-sm">
                                    {{ $i }}
                                </div>
                                <div>
                                    <p class="font-medium text-sm">Mahasiswa {{ $i }}</p>
                                    <p class="text-xs text-gray-500">{{ ['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer'][($i-1) % 3] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-blue-600 text-sm">{{ 20 - $i }}</p>
                                <p class="text-xs text-gray-500">prestasi</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Detail Table -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg">Prestasi Terbaru</h3>
                <div class="flex gap-2">
                    <button class="border border-gray-300 px-3 py-1 rounded-lg text-sm text-gray-500 hover:bg-gray-50 bg-white">
                        Filter <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-200">
                            <th class="py-3 font-semibold">No</th>
                            <th class="py-3 font-semibold">Nama Lomba</th>
                            <th class="py-3 font-semibold">Mahasiswa</th>
                            <th class="py-3 font-semibold">Dosen Pembimbing</th>
                            <th class="py-3 font-semibold">Tingkat</th>
                            <th class="py-3 font-semibold">Capaian</th>
                            <th class="py-3 font-semibold">Tanggal</th>
                            <th class="py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 8; $i++)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3">{{ $i }}</td>
                                <td class="py-3">
                                    <div class="font-medium">{{ ['Hackathon Digital', 'UI/UX Competition', 'Cyber Security', 'Web Development', 'Mobile App'][($i-1) % 5] }}</div>
                                    <div class="text-xs text-gray-500">{{ ['Programming', 'Design', 'Security', 'Web Dev', 'Mobile'][($i-1) % 5] }}</div>
                                </td>
                                <td class="py-3">
                                    <div class="font-medium">Mahasiswa {{ $i }}</div>
                                    <div class="text-xs text-gray-500">2301020{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                <td class="py-3">
                                    <div class="font-medium">Dr. Dosen {{ $i }}</div>
                                    <div class="text-xs text-gray-500">Pembimbing</div>
                                </td>
                                <td class="py-3">
                                    <span class="inline-flex px-2 py-1 text-xs rounded-full {{ $i <= 3 ? 'bg-red-100 text-red-600' : ($i <= 6 ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600') }}">
                                        {{ $i <= 3 ? 'Internasional' : ($i <= 6 ? 'Nasional' : 'Regional') }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full {{ $i <= 3 ? 'bg-yellow-100 text-yellow-800' : ($i <= 6 ? 'bg-gray-100 text-gray-800' : 'bg-orange-100 text-orange-800') }}">
                                        {{ $i <= 3 ? '🥇 Juara 1' : ($i <= 6 ? '🥈 Juara 2' : '🥉 Juara 3') }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="text-sm">{{ date('M d, Y', strtotime('-' . $i . ' days')) }}</div>
                                </td>
                                <td class="py-3">
                                    <button onclick="viewDetail({{ $i }})" class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 text-xs">
                                        Lihat detail
                                    </button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    Menampilkan 1-8 dari 245 hasil
                </div>
                <div class="flex items-center space-x-1">
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">Previous</button>
                    <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded">1</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">3</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">Next</button>
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

        // 2. Prestasi per Program Studi (Doughnut Chart)
        new Chart(document.getElementById('prodiChart'), {
            type: 'doughnut',
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
                cutout: '60%',
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

        function viewDetail(id) {
            alert('Menampilkan detail prestasi ID: ' + id);
        }
    </script>
@endsection