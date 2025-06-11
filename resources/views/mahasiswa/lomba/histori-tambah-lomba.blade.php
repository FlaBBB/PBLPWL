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

                                        {{-- MENYIMPAN DATA DI ATRIBUT data-* --}}
                                        data-name="{{ $achievement->name }}"
                                        data-organizer="{{ $achievement->organizer }}"
                                        data-level="{{ $achievement->level }}"
                                        data-max-participation-amount="{{ $achievement->max_participation_amount }}"
                                        data-start-at="{{ $achievement->start_at ? $achievement->start_at->format('d F Y') : '-' }}"
                                        data-end-at="{{ $achievement->end_at ? $achievement->end_at->format('d F Y') : '-' }}"
                                        data-registration-deadline="{{ $achievement->registration_deadline ? $achievement->registration_deadline->format('d F Y') : '-' }}"
                                        data-description="{{ $achievement->description }}"
                                        data-registration-link="{{ $achievement->registration_link }}"
                                        data-status="{{ $achievement->status }}"

                                        {{-- ONCLICK SEKARANG JAUH LEBIH SEDERHANA --}}
                                        onclick="showDetailModal(this)">

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
            <div id="detail-lomba-modal" onclick="closeModal()"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 opacity-0 pointer-events-none transition-opacity duration-300"
                data-state="closed" style="display:none">

                <div onclick="event.stopPropagation()"
                    class="bg-white rounded-lg shadow-xl w-full max-w-2xl transform transition-transform duration-300 scale-95">

                    <div class="flex justify-between items-center p-4 sm:p-5 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-indigo-100 rounded-full">
                                <svg class="w-6 h-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <h3 id="modal-header-name" class="text-xl font-bold text-gray-800">Detail Informasi Lomba</h3>
                        </div>
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 transition">&times;</button>
                    </div>

                    <div class="p-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">

                            {{-- Nama Lomba --}}
                            <div class="md:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Nama Lomba</dt>
                                <dd id="modal-nama" class="mt-1 text-lg font-semibold text-gray-900"></dd>
                            </div>

                            {{-- Penyelenggara --}}
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Penyelenggara</dt>
                                <dd id="modal-penyelenggara" class="mt-1 text-gray-900"></dd>
                            </div>

                            {{-- Tingkat --}}
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tingkat</dt>
                                <dd id="modal-tingkat" class="mt-1 text-gray-900"></dd>
                            </div>

                            {{-- Jumlah Peserta --}}
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jumlah Peserta/Tim</dt>
                                <dd id="modal-peserta" class="mt-1 text-gray-900"></dd>
                            </div>

                            {{-- Status --}}
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                {{-- Konten dan style untuk status akan diisi oleh JavaScript --}}
                                <dd id="modal-status" class="mt-1"></dd>
                            </div>

                            {{-- Pendaftaran Dibuka --}}
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Pendaftaran Dibuka</dt>
                                <dd id="modal-mulai" class="mt-1 text-gray-900"></dd>
                            </div>

                            {{-- Pendaftaran Ditutup --}}
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Pendaftaran Ditutup</dt>
                                <dd id="modal-berakhir" class="mt-1 text-gray-900"></dd>
                            </div>

                            {{-- Tenggat --}}
                            <div class="md:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Tenggat Pengumpulan</dt>
                                <dd id="modal-tenggat" class="mt-1 text-gray-900"></dd>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="md:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                                <dd id="modal-deskripsi" class="mt-1 text-gray-700 whitespace-pre-wrap"></dd>
                            </div>

                        </dl>
                    </div>

                    <div class="flex justify-end items-center p-4 bg-gray-50 border-t border-gray-200 rounded-b-lg gap-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm font-medium">
                            Tutup
                        </button>
                        <a id="modal-url" href="#" target="_blank" rel="noopener noreferrer"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm font-medium">
                            Kunjungi Laman Lomba
                        </a>
                    </div>
                </div>
            </div>
</main>

<script>
    function showDetailModal(buttonElement) {
        // Ambil data dari atribut 'data-*' menggunakan .dataset
        // JavaScript otomatis mengubah kebab-case (data-max-participation-amount) menjadi camelCase (maxParticipationAmount)
        const data = buttonElement.dataset;

        document.getElementById('modal-nama').textContent = data.name || '-';
        document.getElementById('modal-penyelenggara').textContent = data.organizer || '-';
        document.getElementById('modal-tingkat').textContent = data.level || '-';
        document.getElementById('modal-peserta').textContent = data.maxParticipationAmount || '-'; // perhatikan camelCase
        document.getElementById('modal-mulai').textContent = data.startAt || '-';
        document.getElementById('modal-berakhir').textContent = data.endAt || '-';
        document.getElementById('modal-tenggat').textContent = data.registrationDeadline || '-';
        document.getElementById('modal-deskripsi').textContent = data.description || '-';

        const statusElement = document.getElementById('modal-status');
        const status = data.status ? data.status.toUpperCase() : 'WAITING'; // Default ke WAITING jika null

        // Reset class sebelum menambahkan yang baru
        statusElement.className = '';
        statusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1).toLowerCase(); // Format teks (e.g., Waiting)

        // Tambahkan class dasar untuk semua badge
        statusElement.classList.add('px-3', 'py-1', 'text-xs', 'font-medium', 'rounded-full', 'inline-block');

        switch (status) {
            case 'ACCEPTED':
                statusElement.classList.add('bg-green-100', 'text-green-800');
                break;
            case 'REJECTED':
                statusElement.classList.add('bg-red-100', 'text-red-800');
                break;
            case 'WAITING':
            default:
                statusElement.classList.add('bg-yellow-100', 'text-yellow-800');
                break;
        }

        const urlElement = document.getElementById('modal-url');
        if (data.registrationLink) { // perhatikan camelCase
            urlElement.href = data.registrationLink;
            urlElement.style.display = 'inline-block';
        } else {
            urlElement.style.display = 'none';
        }

        // Logika untuk menampilkan modal (ini sudah benar)
        const modal = document.getElementById('detail-lomba-modal');
        modal.style.display = 'flex'; // Tampilkan modal

        // Timeout kecil untuk memastikan transisi opacity berjalan setelah display diubah
        setTimeout(() => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
        }, 10);
    }

    // Fungsi closeModal Anda sudah benar, tidak perlu diubah.
    function closeModal() {
        const modal = document.getElementById('detail-lomba-modal');
        modal.classList.remove('opacity-100', 'pointer-events-auto');

        // Tambahkan kembali class ini untuk memulai transisi fade out
        modal.classList.add('opacity-0');

        // Tunggu transisi selesai (300ms sesuai class duration-300) baru display:none
        setTimeout(() => {
            modal.style.display = 'none';
            // PENTING: Tambahkan kembali pointer-events-none setelah modal benar-benar hilang
            modal.classList.add('pointer-events-none');
        }, 300);
    }
</script>



@endsection