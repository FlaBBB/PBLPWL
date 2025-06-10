@extends('layout.template')

@section('content')
<main class="flex-1 px-6 pb-96">
    <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg relative">
        <div class="mb-4 flex space-x-4 border-b border-gray-200">
            <a href="{{ route('mahasiswa.tambah-lomba') }}">
                <button id="tab-tambah"
                    class="tab-btn text-sm font-medium py-2 px-3 border-b-4 text-gray-500 border-transparent hover:text-[#1E6AAE]"
                    data-tab="tambah" type="button">
                    Tambah Lomba
                </button>
            </a>
            <button id="tab-histori" data-tab="histori"
                class="tab-btn text-sm font-medium py-2 px-3 border-b-4 text-[#1E6AAE] border-[#1E6AAE]" type="button">
                Riwayat Tambah Lomba
            </button>
        </div>

        <div id="content-histori" class="tab-content p-6">
            <h2 class="text-xl font-semibold mb-2">Riwayat Tambah Lomba</h2>
            <p class="text-sm text-gray-400">Berikut adalah daftar lomba yang telah kamu tambahkan sebelumnya.</p>
            <div class="relative mt-8 border border-gray-200 rounded-sm">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="">
                        <tr class="border-b border-gray-200 text-gray-400">
                            <th class="px-6 py-3 font-semibold">No.</th>
                            <th class="px-6 py-3 font-semibold">Nama Lomba</th>
                            <th class="px-6 py-3 font-semibold">Tanggal Upload</th>
                            <th class="px-6 py-3 font-semibold">Status</th>
                            <th class="px-6 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($achievements as $i => $achievement)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-2 ">{{ $achievements->firstItem() + $i }}</td>
                            <td class="px-6 py-2 ">{{ $achievement->name }}</td>
                            <td class="px-6 py-2 ">{{ \Carbon\Carbon::parse($achievement->upload_at)->format('Y-m-d') }}</td>
                            <td class="px-6 py-2 ">
                                @if($achievement->status->value === 'ACCEPTED')
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Terverifikasi
                                </span>
                                @elseif($achievement->status->value === 'WAITING')
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    Menunggu
                                </span>
                                @elseif($achievement->status->value === 'REJECTED')
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Ditolak
                                </span>
                                @elseif($achievement->status->value === 'REVISION')
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">
                                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                    Revisi
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-2">
                                <div class="flex space-x-2">
                                    <button
    type="button"
    class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white px-2 py-2 rounded text-xs flex items-center gap-1"
    title="Lihat Detail"
    onclick="showDetailModal(
        @json([
            'name' => $achievement->name,
            'organizer' => $achievement->organizer,
            'level' => $achievement->level,
            'max_participation_amount' => $achievement->max_participation_amount,
            'start_at' => $achievement->start_at,
            'end_at' => $achievement->end_at,
            'registration_deadline' => $achievement->registration_deadline,
            'description' => $achievement->description,
            'registration_link' => $achievement->registration_link ]))">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
    </svg>
    Lihat detail
</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Belum ada riwayat tambah lomba.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Modal Detail Lomba -->
<div id="detail-lomba-modal"
     onclick="closeModal()"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-700 bg-opacity-30 opacity-0 pointer-events-none transition-opacity duration-300"
     style="display:none">
    <div onclick="event.stopPropagation()"
         class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Detail Informasi Lomba</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="p-6 space-y-4">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <dt class="font-semibold text-gray-600">Nama Lomba</dt>
                    <dd id="modal-nama" class="text-gray-800"></dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Penyelenggara</dt>
                    <dd id="modal-penyelenggara" class="text-gray-800"></dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Tingkat</dt>
                    <dd id="modal-tingkat" class="text-gray-800"></dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Jumlah Peserta</dt>
                    <dd id="modal-peserta" class="text-gray-800"></dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Pendaftaran Dibuka</dt>
                    <dd id="modal-mulai" class="text-gray-800"></dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Pendaftaran Ditutup</dt>
                    <dd id="modal-berakhir" class="text-gray-800"></dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="font-semibold text-gray-600">Tenggat Pengumpulan</dt>
                    <dd id="modal-tenggat" class="text-gray-800"></dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="font-semibold text-gray-600">Deskripsi</dt>
                    <dd id="modal-deskripsi" class="text-gray-800 whitespace-pre-wrap"></dd>
                </div>
            </dl>
        </div>
        <div class="flex justify-end items-center p-4 border-t">
            <a id="modal-url" href="#" target="_blank" rel="noopener noreferrer"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
               Kunjungi Laman Lomba
            </a>
        </div>
    </div>
</div>

</main>

<script>
function showDetailModal(data) {
    document.getElementById('modal-nama').textContent = data.name || '-';
    document.getElementById('modal-penyelenggara').textContent = data.organizer || '-';
    document.getElementById('modal-tingkat').textContent = data.level || '-';
    document.getElementById('modal-peserta').textContent = data.max_participation_amount || '-';
    document.getElementById('modal-mulai').textContent = data.start_at || '-';
    document.getElementById('modal-berakhir').textContent = data.end_at || '-';
    document.getElementById('modal-tenggat').textContent = data.registration_deadline || '-';
    document.getElementById('modal-deskripsi').textContent = data.description || '-';
    const urlElement = document.getElementById('modal-url');
    if (data.registration_link) {
        urlElement.href = data.registration_link;
        urlElement.style.display = 'inline-block';
    } else {
        urlElement.style.display = 'none';
    }
    // Tampilkan modal
    const modal = document.getElementById('detail-lomba-modal');
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
    }, 10);
}
function closeModal() {
    const modal = document.getElementById('detail-lomba-modal');
    modal.classList.remove('opacity-100', 'pointer-events-auto');
    modal.classList.add('opacity-0', 'pointer-events-none');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}
</script>



@endsection