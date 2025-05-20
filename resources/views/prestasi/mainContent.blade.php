@extends('layout.template')

@section('content')
<!-- Main Content -->
<main class="flex-1 p-10">
    <!-- Stats -->
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="flex justify-between w-full">
                <span class="text-2xl font-bold">24</span>
                <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M5 3v18l7-5 7 5V3a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="text-gray-500 text-sm">Total prestasi</span>
            <span class="text-green-500 text-xs mt-2">↑ 10.2 <span class="text-gray-400">+1.01% this month</span></span>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                        <div class="flex justify-between w-full">
                <span class="text-2xl font-bold">2</span>
                <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="text-gray-500 text-sm">Prestasi menunggu verifikasi</span>
            <span class="text-green-500 text-xs mt-2">↑ 3.1 <span class="text-gray-400">+0.49% this week</span></span>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
                        <div class="flex justify-between w-full">
                <span class="text-2xl font-bold">12</span>
                <svg class="w-9 h-9 text-blue-500 bg-white rounded-xl shadow-sm p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.21 13.89L7 21l5-3 5 3-1.21-7.11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="text-gray-500 text-sm">Lomba aktif saat ini</span>
            <span class="text-green-500 text-xs mt-2">↑ 7.2 <span class="text-gray-400">+1.51% this week</span></span>
        </div>
    </div>
    <!-- Recommendations & Chart -->
    <div class="grid grid-cols-3 gap-8 mb-8">
        <div class="col-span-2 bg-white rounded-xl shadow p-6">
            <h2 class="font-bold mb-4">Rekomendasi Lomba Untuk Anda ⚡</h2>
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-400">
                        <th class="py-2 font-semibold">No</th>
                        <th class="py-2 font-semibold">Nama Lomba</th>
                        <th class="py-2 font-semibold">Penyelenggara</th>
                        <th class="py-2 font-semibold">Batas Pendaftaran</th>
                        <th class="py-2 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-2">1</td>
                        <td class="py-3 px-2">GEMASTIK</td>
                        <td class="py-3 px-2">Puspresnas</td>
                        <td class="py-3 px-2">25 Agustus 2021</td>
                        <td class="py-3 px-2">
                            <a href="#" class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 text-xs">Lihat detail</a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-2">2</td>
                        <td class="py-3 px-2">Hackathon Merdeka</td>
                        <td class="py-3 px-2">Institut Merdeka</td>
                        <td class="py-3 px-2">11 Januari 2022</td>
                        <td class="py-3 px-2">
                            <a href="#" class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 text-xs">Lihat detail</a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-2">3</td>
                        <td class="py-3 px-2">IoT Competition</td>
                        <td class="py-3 px-2">Kementerian Pendidikan</td>
                        <td class="py-3 px-2">21 Desember 2021</td>
                        <td class="py-3 px-2">
                            <a href="#" class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 text-xs">Lihat detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
            <h2 class="font-bold mb-4">Prestasimu</h2>
            <!-- Placeholder for chart -->
            <div class="w-36 h-36 mb-4">
                <canvas id="prestasiChart" width="144" height="144"></canvas>
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
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold">Prestasi Terbaru</h2>
            <div>
                <button class="border px-3 py-1 rounded text-sm text-gray-500">Semester <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg></button>
            </div>
        </div>
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="text-gray-400">
                    <th class="py-2">No</th>
                    <th class="py-2">ID</th>
                    <th class="py-2">Date</th>
                    <th class="py-2">Customer Name</th>
                    <th class="py-2">Location</th>
                    <th class="py-2">Amount</th>
                    <th class="py-2">Status Order</th>
                    <th class="py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t border-gray-200">
                    <td class="py-2">1</td>
                    <td>#12564</td>
                    <td>Dec 1, 2021</td>
                    <td>Frank Murlo</td>
                    <td>312 S Wilmette Ave</td>
                    <td>$847.69</td>
                    <td><span class="inline-block px-2 py-1 bg-green-100 text-green-600 rounded text-xs">New Order</span></td>
                    <td>
                        <button class="px-2 py-1 rounded hover:bg-gray-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="1.5" />
                                <circle cx="19.5" cy="12" r="1.5" />
                                <circle cx="4.5" cy="12" r="1.5" />
                            </svg>
                        </button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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