@extends('layout.template')

@section('content')
    <main class="flex-1 px-6 pb-10">
        <div class="w-full bg-white mx-auto p-6 border border-gray-200 rounded-lg relative">
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
                            <th class="px-6 py-3 font-semibold">Lomba</th>
                            <th class="px-6 py-3 font-semibold">Tanggal Lomba</th>
                            <th class="px-6 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                        {{-- Contoh data paginasi, ganti dengan data dari controller --}}
                        @forelse ($achievements as $index => $achievement)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-2 ">{{ $achievements->firstItem() + $index }}</td>
                                <td class="px-6 py-2 ">{{ $achievement->competition_name }}</td>
                                <td class="px-6 py-2 ">{{ \Carbon\Carbon::parse($achievement->start_at)->format('d F Y') }}</td>
                                <td class="px-6 py-2">
                                    <div class="flex space-x-3">
                                        <button onclick="openDetailModal(this)"
                                            data-achievement-id="{{ $achievement->id }}"
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
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada mahasiswa bimbingan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Navigasi halaman --}}
            <div class="flex justify-end mt-6">
                {{ $achievements->links('pagination::tailwind') }}
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
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Nama Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600" id="detail-nama-lomba"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Bidang Lomba
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600" id="detail-bidang-lomba"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Role Pembimbing
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600" id="detail-role-pembimbing"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600" id="detail-tanggal-mulai"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                Berakhir</td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-600" id="detail-tanggal-berakhir"></td>
                        </tr>
                    </table>
                </div>

                <div class="mt-6">
                    <h4 class="text-lg font-semibold mb-4 text-gray-800">Daftar Mahasiswa Terlibat</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                            <thead>
                                <tr>
                                    <th class="border border-gray-200 px-3 py-2 font-medium">Nama Mahasiswa</th>
                                    <th class="border border-gray-200 px-3 py-2 font-medium">Tag Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody id="detail-mahasiswa-list">
                                <!-- Mahasiswa list will be populated here by JavaScript -->
                            </tbody>
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

        function openModal(modalId) { // Keep the original openModal for general use if needed
            const modal = document.getElementById(modalId);
            if (!modal || modal.dataset.state === 'opened' || modal.dataset.state === 'opening') {
                return;
            }
            const modalDialog = modal.querySelector('.modal-dialog');

            modal.dataset.state = 'opening';
            modal.classList.remove('opacity-0', 'pointer-events-none');
            void modal.offsetWidth;
            modal.classList.add('opacity-100', 'pointer-events-auto');

            if (modalDialog) {
                modalDialog.classList.remove('-translate-y-full', 'scale-95');
                modalDialog.classList.add('translate-y-0', 'scale-100');
            }

            const targetElement = modalDialog || modal;
            const duration = modalDialog ? DIALOG_TRANSITION_DURATION : OVERLAY_TRANSITION_DURATION;

            let openTransitionEnded = false;
            const onOpenTransitionEnd = (event) => {
                if (event.target === targetElement && modal.dataset.state === 'opening' && !openTransitionEnded) {
                    openTransitionEnded = true;
                    modal.dataset.state = 'opened';
                    targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                }
            };
            targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
            targetElement.addEventListener('transitionend', onOpenTransitionEnd);

            setTimeout(() => {
                if (modal.dataset.state === 'opening' && !openTransitionEnded) {
                    openTransitionEnded = true;
                    modal.dataset.state = 'opened';
                    targetElement.removeEventListener('transitionend', onOpenTransitionEnd);
                }
            }, duration + 70);
        }

        async function openDetailModal(buttonElement) {
            const achievementId = buttonElement.dataset.achievementId;
            try {
                const response = await fetch(`/dosen/mahasiswa-bimbingan/${achievementId}/details`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();

                document.getElementById('detail-nama-lomba').innerText = data.nama_lomba;
                document.getElementById('detail-bidang-lomba').innerText = data.bidang_lomba;
                document.getElementById('detail-role-pembimbing').innerText = data.supervisor_role;
                document.getElementById('detail-tanggal-mulai').innerText = data.tanggal_mulai;
                document.getElementById('detail-tanggal-berakhir').innerText = data.tanggal_berakhir;

                const mahasiswaListBody = document.getElementById('detail-mahasiswa-list');
                mahasiswaListBody.innerHTML = ''; // Clear previous list

                if (data.mahasiswa_list && data.mahasiswa_list.length > 0) {
                    data.mahasiswa_list.forEach(mahasiswa => {
                        const row = `
                            <tr>
                                <td class="border border-gray-200 px-3 py-2 text-gray-600">${mahasiswa.name}</td>
                                <td class="border border-gray-200 px-3 py-2 text-gray-600">${mahasiswa.mahasiswa_tag}</td>
                            </tr>
                        `;
                        mahasiswaListBody.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    mahasiswaListBody.innerHTML = `
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada mahasiswa terlibat.</td>
                        </tr>
                    `;
                }

                openModal('modal-detail');
            } catch (error) {
                console.error('Error fetching achievement details:', error);
                alert('Gagal memuat detail bimbingan. Silakan coba lagi.');
            }
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