@extends('layout.template')
@php
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
@endphp

@section('content')
    <main class="flex-1 px-10">
        <div class="w-full mx-auto p-6  border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold">Verifikasi Lomba</h2>
            <div class="flex flex-wrap gap-4 pb-4 items-center">
                <div class="flex flex-wrap gap-4 py-4 items-center w-full">
                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" placeholder="Cari disini"
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-700 ml-4">Filter berdasarkan:</p>
                    <!-- Dropdown: Kategori -->
                    <div class="relative w-54">
                        <select
                            class="appearance-none w-full py-2 pr-4 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option disabled selected hidden>Pilih Kategori</option>
                            <option>Cyber Security</option>
                            <option>IoT</option>
                            <option>Software Development</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <!-- Dropdown: Tingkat Lomba -->
                    <div class="relative w-40">
                        <select
                            class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option disabled selected hidden>Pilih Tingkat</option>
                            <option>Internasional</option>
                            <option>Nasional</option>
                            <option>Provinsi</option>
                            <option>Kota/Kabupaten</option>
                            <option>Internal</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <!-- Dropdown: Status -->
                    <div class="relative w-40">
                        <select
                            class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option disabled selected hidden>Status</option>
                            <option value="ACCEPTED">Terverifikasi</option>
                            <option value="WAITING">Menunggu</option>
                            <option value="REJECTED">Ditolak</option>
                            <option value="REVISION">Revisi</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                {{-- Opsi jumlah baris per halaman --}}
                <div class="flex flex-cols items-center justify-between gap-auto w-full">
                    <div>
                        <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
                        <select name="perPage" id="perPage" onchange="changePerPage(this.value)"
                            class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-[#1e6aae]">
                            @foreach ([5, 10, 25, 50] as $size)
                                <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>
                        <span class="ml-1 text-sm text-gray-700">baris</span>
                    </div>
                </div>

                <script>
                    function changePerPage(value) {
                        // Get current URL
                        const currentUrl = new URL(window.location.href);

                        // Set new perPage value and reset page to 1
                        currentUrl.searchParams.set('perPage', value);
                        currentUrl.searchParams.set('page', 1);

                        console.log('Redirecting to:', currentUrl.toString());

                        // Navigate to new URL
                        window.location.href = currentUrl.toString();
                    }
                </script>

                <table class="w-full text-left text-sm bg-white rounded-lg border border-gray-200 rounded-sm">
                    <thead class="text-gray-500">
                        <tr class="border-b border-gray-200">
                            <th class="w-[5%] px-4 py-2 text-left">No</th>
                            <th class="w-[25%] px-2 py-2 text-left">Nama Lomba</th>
                            <th class="w-[15%] px-2 py-2 text-left">Penyelenggara</th>
                            <th class="w-[10%] px-2 py-2 text-left">Tingkat</th>
                            <th class="w-[10%] px-2 py-2 text-left">Kategori</th>
                            <th class="w-[15%] px-2 py-2 text-left">Status</th>
                            <th class="w-[20%] px-2 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh data paginasi, ganti dengan data dari controller --}}
                        @php
                            $perPage = request('perPage', 10);
                            $page = request('page', 1);
                            $total = 15; // total data, ganti sesuai kebutuhan
                            $start = ($page - 1) * $perPage + 1;
                            $end = min($start + $perPage - 1, $total);
                        @endphp
                        @for($i = $start; $i <= $end; $i++)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2">{{$i}}</td>
                                <td class="px-2 py-2">{{ Str::limit('Kompetisi Programming Nasional 2024', 30) }}</td>
                                <td class="px-2 py-2">{{ Str::limit('Universitas Indonesia', 20) }}</td>
                                <td class="px-2 py-2">Nasional</td>
                                <td class="px-2 py-2">Software Development</td>
                                <td class="px-2 py-2">
                                     @php
                                        $status = ['WAITING', 'ACCEPTED', 'REJECTED', 'REVISION'][($i - 1) % 4]; 
                                    @endphp 
                                     @if($status == 'WAITING') 
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-[#1e6aae]/10 text-[#1e6aae]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#1e6aae]"></span>
                                            Perlu Verifikasi
                                        </span>
                                     @elseif($status == 'ACCEPTED') 
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Terverifikasi
                                        </span>
                                     @elseif($status == 'REJECTED') 
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                            Ditolak
                                        </span>
                                     @elseif($status == 'REVISION') 
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Revisi
                                        </span>
                                     @endif 
                                </td>
                                <td class="px-2 py-2">
                                    <button type="button" onclick="openModal('modal-detail')"
                                        class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white px-2 py-2 rounded text-sm flex items-center gap-1"
                                        title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            {{-- Navigasi halaman --}}
            @php
                $lastPage = ceil($total / $perPage);
            @endphp

            <div class="flex justify-end mt-6">
                <nav class="inline-flex -space-x-px">
                    <a href="?perPage={{ $perPage }}&page={{ max(1, $page - 1) }}"
                        class="px-3 py-1 border border-gray-300 rounded-l {{ $page == 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
                        &laquo;
                    </a>
                    @for ($p = 1; $p <= $lastPage; $p++)
                        <a href="?perPage={{ $perPage }}&page={{ $p }}"
                            class="px-3 py-1 border-t text-gray-600 border-b border-gray-300 {{ $p == $page ? 'bg-[#1e6aae] text-white' : 'hover:bg-gray-200' }}">
                            {{ $p }}
                        </a>
                    @endfor
                    <a href="?perPage={{ $perPage }}&page={{ min($lastPage, $page + 1) }}"
                        class="px-3 py-1 border border-gray-300 rounded-r {{ $page == $lastPage ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'hover:bg-gray-200' }}">
                        &raquo;
                    </a>
                </nav>
            </div>
        </div>

        {{-- MODAL COMPONENTS --}}

        {{-- MODAL DETAIL LOMBA --}}
        <div id="modal-detail"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md text-xs shadow-2xl max-w-6xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button type="button" onclick="closeModal('modal-detail')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800">Detail Lomba</h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Informasi Lomba</h4>
                        <table class="w-full text-gray-800 text-left text-sm">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Nama Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">Kompetisi Programming Nasional 2024</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Penyelenggara</td>
                                <td class="border border-gray-200 px-3 py-2">Universitas Indonesia</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tingkat Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">Nasional</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Kategori</td>
                                <td class="border border-gray-200 px-3 py-2">Software Development</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Mulai</td>
                                <td class="border border-gray-200 px-3 py-2">15 Oktober 2024</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Berakhir</td>
                                <td class="border border-gray-200 px-3 py-2">17 Oktober 2024</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tipe Peserta</td>
                                <td class="border border-gray-200 px-3 py-2">Tim</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">URL Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <a href="https://programming-contest.ui.ac.id" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        Lihat Website
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Informasi Pendaftaran -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Informasi Pendaftaran</h4>
                            <table class="w-full text-gray-800 text-left text-sm">
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Tanggal Buka</td>
                                    <td class="border border-gray-200 px-3 py-2">01 Oktober 2024</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Tutup</td>
                                    <td class="border border-gray-200 px-3 py-2">10 Oktober 2024</td>
                                </tr>
                            </table>
                        </div>

                        <!-- File Dokumen -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Dokumen</h4>
                            <table class="w-full text-gray-800 text-left text-sm">
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Poster</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        <a href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Deskripsi</td>
                                    <td class="border border-gray-200 px-3 py-2">Kompetisi programming untuk mahasiswa se-Indonesia dengan tema artificial intelligence dan machine learning.</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <div class="flex gap-3">
                        <button type="button" onclick="openMessageModal('revision')"
                            class="px-4 py-2 text-sm font-medium text-amber-500 border border-amber-500 rounded-md hover:bg-amber-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600">
                            Minta Revisi
                        </button>
                        <button type="button" onclick="openMessageModal('reject')"
                            class="px-4 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                            Tolak
                        </button>
                        <button type="button" onclick="handleVerification('approve')"
                            class="px-4 py-2 text-sm font-medium text-[#1E6AAE] border border-[#1E6AAE] rounded-md hover:bg-[#1E6AAE] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                            Verifikasi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL MESSAGE (untuk revisi dan tolak) --}}
        <div id="modal-message"
            class="fixed inset-0 z-60 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out pt-16 sm:pt-20 overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button type="button" onclick="closeModal('modal-message')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="text-center">
                    <div id="message-icon" class="mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4">
                        <!-- Icon will be set dynamically -->
                    </div>
                    <h3 id="message-title" class="text-lg font-medium text-gray-900 mb-2">
                        <!-- Title will be set dynamically -->
                    </h3>
                    <div class="mb-4">
                        <label for="message-text" class="block text-sm font-medium text-gray-700 mb-2 text-left">
                            <span id="message-label">Pesan:</span>
                        </label>
                        <textarea id="message-text" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="Masukkan pesan..."></textarea>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-3 justify-end">
                        <button type="button" onclick="closeModal('modal-message')"
                            class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button type="button" id="confirm-action-btn" onclick="confirmAction()"
                            class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">
                            <!-- Button text and color will be set dynamically -->
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentAction = '';

        // Prevent default behavior dan event bubbling
        function openModal(modalId, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            try {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'opened' || modal.dataset.state === 'opening') {
                    return;
                }

                const modalDialog = modal.querySelector('.modal-dialog');
                modal.dataset.state = 'opening';

                modal.classList.remove('opacity-0', 'pointer-events-none');
                // Force browser to recognize the initial state before adding transition classes
                void modal.offsetWidth;
                modal.classList.add('opacity-100', 'pointer-events-auto');

                if (modalDialog) {
                    modalDialog.classList.remove('-translate-y-full', 'scale-95');
                    modalDialog.classList.add('translate-y-0', 'scale-100');
                }

                // Determine which element and duration to monitor for transition end
                const targetElement = modalDialog || modal; // Fallback to modal overlay if dialog isn't there
                const duration = modalDialog ? 500 : 300;

                let openTransitionEnded = false;
                const onOpenTransitionEnd = (event) => {
                    // Ensure the event is from the target element and not a child
                    if (event.target === targetElement && modal.dataset.state === 'opening' && !openTransitionEnded) {
                        openTransitionEnded = true;
                        modal.dataset.state = 'opened';
                        targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                    }
                };

                targetElement.removeEventListener('transitionend', onOpenTransitionEnd); // Remove previous just in case
                targetElement.addEventListener('transitionend', onOpenTransitionEnd);

                // Fallback timeout in case transitionend doesn't fire (e.g., element becomes display:none unexpectedly)
                setTimeout(() => {
                    if (modal.dataset.state === 'opening' && !openTransitionEnded) {
                        openTransitionEnded = true;
                        modal.dataset.state = 'opened';
                        targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                    }
                }, duration + 70); // A little buffer, slightly increased

            } catch (error) {
                console.error('Error opening modal:', error);
            }
        }

        function closeModal(modalId, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            try {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'closed' || modal.dataset.state === 'closing') {
                    return;
                }

                const modalDialog = modal.querySelector('.modal-dialog');
                modal.dataset.state = 'closing';

                // Start fading out overlay
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                // Remove 'pointer-events-auto' immediately so it can't be re-triggered during closing,
                // 'pointer-events-none' will be added after transition.
                modal.classList.remove('pointer-events-auto');

                if (modalDialog) {
                    modalDialog.classList.remove('translate-y-0', 'scale-100');
                    modalDialog.classList.add('-translate-y-full', 'scale-95');
                }

                const targetElement = modalDialog || modal;
                const duration = modalDialog ? 500 : 300;

                let closeTransitionEnded = false;
                const onCloseTransitionEnd = (event) => {
                    if (event.target === targetElement && modal.dataset.state === 'closing' && !closeTransitionEnded) {
                        closeTransitionEnded = true;
                        modal.classList.add('pointer-events-none'); // Fully non-interactive
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                };

                targetElement.removeEventListener('transitionend', onCloseTransitionEnd); // Remove previous just in case
                targetElement.addEventListener('transitionend', onCloseTransitionEnd);

                // Fallback timeout
                setTimeout(() => {
                    if (modal.dataset.state === 'closing' && !closeTransitionEnded) {
                        closeTransitionEnded = true;
                        modal.classList.add('pointer-events-none');
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                }, duration + 70); // A little buffer

            } catch (error) {
                console.error('Error closing modal:', error);
            }
        }

        function handleVerification(action) {
            if (action === 'approve') {
                // Handle direct approval without message
                console.log('Lomba diverifikasi');
                // Add your approval logic here
                closeModal('modal-detail');
            }
        }

        function openMessageModal(action) {
            currentAction = action;
            const messageIcon = document.getElementById('message-icon');
            const messageTitle = document.getElementById('message-title');
            const messageLabel = document.getElementById('message-label');
            const confirmBtn = document.getElementById('confirm-action-btn');

            if (action === 'revision') {
                messageIcon.className = 'mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 mb-4';
                messageIcon.innerHTML = `
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    `;
                messageTitle.textContent = 'Minta Revisi Lomba';
                messageLabel.textContent = 'Alasan revisi:';
                confirmBtn.textContent = 'Kirim Revisi';
                confirmBtn.className = 'w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500';
            } else if (action === 'reject') {
                messageIcon.className = 'mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4';
                messageIcon.innerHTML = `
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    `;
                messageTitle.textContent = 'Tolak Lomba';
                messageLabel.textContent = 'Alasan penolakan:';
                confirmBtn.textContent = 'Tolak Lomba';
                confirmBtn.className = 'w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500';
            }

            // Clear previous message
            document.getElementById('message-text').value = '';
            openModal('modal-message');
        }

        function confirmAction() {
            const message = document.getElementById('message-text').value.trim();

            if (!message) {
                alert('Pesan tidak boleh kosong!');
                return;
            }

            if (currentAction === 'revision') {
                console.log('Lomba diminta revisi dengan pesan:', message);
                // Add your revision logic here
            } else if (currentAction === 'reject') {
                console.log('Lomba ditolak dengan pesan:', message);
                // Add your rejection logic here
            }

            closeModal('modal-message');
            closeModal('modal-detail');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function (event) {
            const modals = ['modal-detail', 'modal-message'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && modal.dataset.state === 'opened') {
                    if (event.target === modal) {
                        closeModal(modalId, event);
                    }
                }
            });
        });
    </script>
@endsection