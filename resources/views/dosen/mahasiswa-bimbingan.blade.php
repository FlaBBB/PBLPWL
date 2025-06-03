@extends('layout.template')

@section('content')
    <main class="flex-1 px-6">
        <div class="w-full mx-auto mb-12 p-6 border border-gray-200 rounded-lg relative">
            <h2 class="text-xl font-semibold mb-2">Daftar Mahasiswa Bimbingan Anda</h2>
            <p class="text-sm text-gray-400">Berikut adalah daftar mahasiswa bimbingan yang telah kamu bina sebelumnya.</p>

            {{-- Opsi jumlah baris per halaman --}}
            <div class="flex items-center justify-between mt-6 mb-4">
                <div>
                    <form method="GET" action="">
                        <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
                        <select name="perPage" id="perPage" onchange="this.form.submit()"
                            class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-[#1e6aae]">
                            @foreach ([5, 10, 25, 50] as $size)
                                <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>{{ $size }}
                                </option>
                            @endforeach
                        </select>
                        <span class="ml-1 text-sm text-gray-700">baris</span>
                    </form>
                </div>
            </div>

            <div class="relative mt-2 border border-gray-200 rounded-sm">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-400">
                            <th class="px-6 py-3 font-semibold">No.</th>
                            <th class="px-6 py-3 font-semibold">Nama Mahasiswa</th>
                            <th class="px-6 py-3 font-semibold">Lomba</th>
                            <th class="px-6 py-3 font-semibold">Tanggal Lomba</th>
                            <th class="px-6 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                        {{-- Contoh data paginasi, ganti dengan data dari controller --}}
                        @php
                            $perPage = request('perPage', 10);
                            $page = request('page', 1);
                            $total = 20; // total data, ganti sesuai kebutuhan
                            $start = ($page - 1) * $perPage + 1;
                            $end = min($start + $perPage - 1, $total);
                        @endphp
                        @for ($i = $start; $i <= $end; $i++)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-2 ">{{ $i }}</td>
                                <td class="px-6 py-2 ">Muhammad Budi Sentosa Rahmat</td>
                                <td class="px-6 py-2 ">Inovatif Creation IT 2021</td>
                                <td class="px-6 py-2 ">12 Oktober 2021</td>
                                <td class="px-6 py-2">
                                    <div class="flex space-x-3">
                                        <button onclick="openModal('modal-detail')"
                                            class="bg-transparent border border-[#1e6aae] text-[#1e6aae]  hover:bg-[#1e6aae] hover:text-white px-2 py-1 rounded text-xs font-medium flex items-center gap-1 gap-2"
                                            title="Lihat Detail"> Lihat Detail
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                    </div>
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

        <div id="modal-detail"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-16 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button onclick="closeModal('modal-detail')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800">Detail Mahasiswa Bimbingan</h3>

                <div class="overflow-x-auto">
                    <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium">Nama Mahasiswa</td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600">Fikri Muhammad</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Nama Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600">Lomba Cipta Puisi 2021</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Bidang Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600">Cyber Security</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Role Mahasiswa
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600">Leader</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600">2024-06-01</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                Berakhir</td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600">2024-06-03</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-8 text-right">
                    <button type="button" onclick="closeModal('modal-detail')"
                        class="px-3 py-2 rounded-lg bg-gray-200 text-sm text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        const DIALOG_TRANSITION_DURATION = 500; // Corresponds to duration-500 in Tailwind for the dialog
        const OVERLAY_TRANSITION_DURATION = 300; // Corresponds to duration-300 in Tailwind for the overlay

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            // Exit if modal doesn't exist or is already open/opening
            if (!modal || modal.dataset.state === 'opened' || modal.dataset.state === 'opening') {
                return;
            }
            const modalDialog = modal.querySelector('.modal-dialog');

            modal.dataset.state = 'opening';
            // Make overlay visible and interactive
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
            const duration = modalDialog ? DIALOG_TRANSITION_DURATION : OVERLAY_TRANSITION_DURATION;

            let openTransitionEnded = false;
            const onOpenTransitionEnd = (event) => {
                // Ensure the event is from the target element and not a child
                if (event.target === targetElement && modal.dataset.state === 'opening' && !openTransitionEnded) {
                    openTransitionEnded = true;
                    modal.dataset.state = 'opened';
                    targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                }
            };
            // Make sure to add the event listener only once if openModal can be called multiple times rapidly
            targetElement.removeEventListener('transitionend', onOpenTransitionEnd); // Remove previous just in case
            targetElement.addEventListener('transitionend', onOpenTransitionEnd);

            // Fallback timeout in case transitionend doesn't fire (e.g., element becomes display:none unexpectedly)
            setTimeout(() => {
                if (modal.dataset.state === 'opening' && !openTransitionEnded) {
                    openTransitionEnded = true;
                    modal.dataset.state = 'opened';
                    targetElement.removeEventListener('transitionend', onOpenTransitionEnd); // Clean up listener
                }
            }, duration + 70); // A little buffer, slightly increased
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            // Exit if modal doesn't exist or is already closed/closing
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
            const duration = modalDialog ? DIALOG_TRANSITION_DURATION : OVERLAY_TRANSITION_DURATION;

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
        }
    </script>

@endsection