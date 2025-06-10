@extends('layout.template')
@section('content')
    <main class="flex-1 px-10">
        <div class="w-full mx-auto p-6  border border-gray-200 rounded-lg space-y-4">
            <h2 class="text-xl font-semibold">Verifikasi Lomba</h2>

                <form action="{{ route('admin.verifikasi-lomba') }}" method="GET" class="flex flex-wrap gap-4 items-center w-full">
                    {{-- Search Input --}}
                    <div class="relative">
                        <input type="text" placeholder="Cari disini" name="search" value="{{ $search }}"
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-700 ml-4">Filter berdasarkan:</p>
                    {{-- Dropdown: Bidang --}}
                    <div class="relative w-54">
                        <select name="bidang" onchange="this.form.submit()"
                            class="appearance-none w-full py-2 pr-4 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" {{ !$bidang ? 'selected' : '' }}>Bidang</option>
                            @foreach($bidangOptions as $option)
                                <option value="{{ $option->name }}" {{ $bidang == $option->name ? 'selected' : '' }}>{{ $option->name }}</option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    {{-- Dropdown: Tingkat Lomba --}}
                    <div class="relative w-40">
                        <select name="tingkat" onchange="this.form.submit()"
                            class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" {{ !$tingkat ? 'selected' : '' }}>Tingkat</option>
                            @foreach($tingkatOptions as $option)
                                <option value="{{ $option->value }}" {{ $tingkat == $option->value ? 'selected' : '' }}>{{ ucfirst(strtolower($option->value)) }}</option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </form>

                {{-- Opsi jumlah baris per halaman --}}
                <div class="flex flex-cols items-center justify-between gap-auto w-full">
                    <div>
                        <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
                        <select name="perPage" id="perPage" onchange="changePerPage(this.value)"
                            class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-[#1e6aae]">
                            @foreach ([5, 10, 25, 50] as $size)
                                <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>
                        <span class="ml-1 text-sm text-gray-700">baris</span>
                    </div>
                </div>

                <script>
                    function changePerPage(value) {
                        const currentUrl = new URL(window.location.href);
                        currentUrl.searchParams.set('perPage', value);
                        currentUrl.searchParams.set('page', 1);
                        window.location.href = currentUrl.toString();
                    }
                </script>

                <table class="w-full text-left text-sm bg-white rounded-lg border border-gray-200 rounded-sm">
                    <thead class="text-gray-500">
                        <tr class="border-b border-gray-200">
                            <th class="w-[5%] px-4 py-2 text-left">No</th>
                            <th class="w-[40%] px-2 py-2 text-left">Nama Lomba</th>
                            <th class="w-[20%] px-2 py-2 text-left">Penyelenggara</th>
                            <th class="w-[15%] px-2 py-2 text-left">Status</th>
                            <th class="w-[20%] px-2 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lomba as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $loop->iteration + ($lomba->currentPage() - 1) * $lomba->perPage() }}</td>
                                <td class="px-2 py-2">{{ $item->name }}</td>
                                <td class="px-2 py-2">{{ $item->organizer }}</td>
                                <td class="px-2 py-2">
                                    @if($item->status->value == 'WAITING')
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-[#1e6aae]/10 text-[#1e6aae]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#1e6aae]"></span>
                                            Perlu Verifikasi
                                        </span>
                                    @elseif($item->status->value == 'ACCEPTED')
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Terverifikasi
                                        </span>
                                    @elseif($item->status->value == 'REJECTED')
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Ditolak
                                        </span>
                                    @elseif($item->status->value == 'REVISION')
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                            Revisi
                                        </span>
                                    @endif
                                </td>
                                <td class="px-2 py-2">
                                    <button type="button" onclick="openDetailModal({{ $item->id }})"
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
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">Tidak ada data lomba.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Navigasi halaman dan informasi jumlah data --}}
            <div class="flex justify-between items-center mt-6">
                <div class="text-sm text-gray-700">
                    Menampilkan {{ $lomba->firstItem() }} hingga {{ $lomba->lastItem() }} dari {{ $lomba->total() }} hasil
                </div>
                <div>
                    {{ $lomba->links('pagination::tailwind') }}
                </div>
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
                        <h4 class="font-semibold text-gray-800 mb-2">Data Lomba</h4>
                        <table class="w-full text-gray-800 text-left text-sm">
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Nama Lomba</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-nama-lomba"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Penyelenggara</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-penyelenggara"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tingkat Lomba</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-tingkat-lomba"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Bidang</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-bidang"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Mulai</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-tanggal-mulai"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Tanggal Berakhir</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-tanggal-berakhir"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Link Pendaftaran</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <a href="#" target="_blank" class="text-blue-600 hover:underline" id="detail-link-pendaftaran">
                                        Lihat Link
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Biaya Pendaftaran</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-biaya-pendaftaran"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Batas Pendaftaran</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-batas-pendaftaran"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Maksimal Peserta</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-max-peserta"></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Deskripsi Lomba -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Deskripsi Lomba</h4>
                            <div class="border border-gray-200 px-3 py-2 bg-gray-50" id="detail-deskripsi"></div>
                        </div>

                        <!-- Poster Lomba -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Poster Lomba</h4>
                            <div class="border border-gray-200 px-3 py-2 bg-gray-50 text-center">
                                <img id="detail-poster" src="#" alt="Poster Lomba" class="max-w-full h-auto mx-auto">
                                <a href="#" target="_blank" class="text-blue-600 hover:underline mt-2 block" id="detail-poster-link">Lihat Gambar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <div class="flex gap-3">
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
        let currentLombaId = null; // To store the ID of the lomba being detailed/verified

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

        async function openDetailModal(id) {
            currentLombaId = id;
            try {
                const response = await fetch(`/admin/kelola-lomba/${id}/show`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                console.log(data);

                // Populate Data Lomba
                document.getElementById('detail-nama-lomba').textContent = data.name || 'N/A';
                document.getElementById('detail-penyelenggara').textContent = data.organizer || 'N/A';
                document.getElementById('detail-tingkat-lomba').textContent = data.level ? data.level.charAt(0).toUpperCase() + data.level.slice(1).toLowerCase() : 'N/A';
                document.getElementById('detail-bidang').textContent = data.tags.map(tag => tag.name).join(', ') || 'N/A';
                document.getElementById('detail-tanggal-mulai').textContent = data.start_at || 'N/A';
                document.getElementById('detail-tanggal-berakhir').textContent = data.end_at || 'N/A';
                document.getElementById('detail-link-pendaftaran').href = data.registration_link || '#';
                document.getElementById('detail-link-pendaftaran').textContent = data.registration_link ? 'Lihat Link' : 'Tidak Tersedia';
                document.getElementById('detail-biaya-pendaftaran').textContent = data.registration_fee || 'N/A';
                document.getElementById('detail-batas-pendaftaran').textContent = data.registration_deadline || 'N/A';
                document.getElementById('detail-max-peserta').textContent = data.max_participation_amount || 'N/A';
                document.getElementById('detail-deskripsi').textContent = data.description || 'N/A';

                // Populate Poster Lomba
                const posterImg = document.getElementById('detail-poster');
                const posterLink = document.getElementById('detail-poster-link');
                if (data.poster) {
                    posterImg.src = '/' + data.poster;
                    posterLink.href = '/' + data.poster;
                    posterLink.textContent = 'Lihat Gambar';
                } else {
                    posterImg.src = '#';
                    posterLink.href = '#';
                    posterLink.textContent = 'Tidak Tersedia';
                }

                openModal('modal-detail');
            } catch (error) {
                console.error('Error fetching lomba details:', error);
                alert('Gagal memuat detail lomba. Silakan coba lagi.');
            }
        }

        async function handleVerification(action) {
            if (!currentLombaId) {
                alert('Tidak ada lomba yang dipilih.');
                return;
            }

            if (action === 'approve') {
                try {
                    const response = await fetch(`/admin/kelola-lomba/${currentLombaId}/approve`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const result = await response.json();
                    alert(result.message);
                    closeModal('modal-detail');
                    location.reload(); // Reload page to reflect changes
                } catch (error) {
                    console.error('Error approving lomba:', error);
                    alert('Gagal memverifikasi lomba. Silakan coba lagi.');
                }
            }
        }

        function openMessageModal(action) {
            currentAction = action;
            const messageIcon = document.getElementById('message-icon');
            const messageTitle = document.getElementById('message-title');
            const messageLabel = document.getElementById('message-label');
            const confirmBtn = document.getElementById('confirm-action-btn');

            if (action === 'reject') {
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

        async function confirmAction() {
            const message = document.getElementById('message-text').value.trim();

            if (!message) {
                alert('Pesan tidak boleh kosong!');
                return;
            }

            if (!currentLombaId) {
                alert('Tidak ada lomba yang dipilih.');
                return;
            }

            let url = `/admin/kelola-lomba/${currentLombaId}/reject`;
            let successMessage = 'Lomba berhasil ditolak.';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                alert(result.message || successMessage);
                closeModal('modal-message');
                closeModal('modal-detail');
                location.reload(); // Reload page to reflect changes
            } catch (error) {
                console.error(`Error ${currentAction}ing lomba:`, error);
                alert(`Gagal ${currentAction} lomba. Silakan coba lagi.`);
            }
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