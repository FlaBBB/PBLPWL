@extends('layout.template')

@section('content')
    <main class="flex-1 px-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg space-y-4">
            <h2 class="text-xl font-semibold">Daftar Prestasi</h2>
            <form action="{{ route('admin.daftar-achievement') }}" method="GET"
                class="flex flex-wrap gap-4 items-center w-full">
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
                        <option value="" {{ !$bidang ? 'selected' : '' }}>Pilih Bidang</option>
                        @foreach(['Programming', 'UI/UX Design', 'Data Science', 'Cyber Security'] as $option)
                            <option value="{{ $option }}" {{ $bidang == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                {{-- Dropdown: Tingkat Lomba Prestasi--}}
                <div class="relative w-40">
                    <select name="tingkat" onchange="this.form.submit()"
                        class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected hidden>Pilih Tingkat</option>
                        @php
                            $levelLabels = [
                                'INTERNAL' => 'Internal',
                                'CITY' => 'Kota/ Kabupaten',
                                'PROVINCE' => 'Provinsi',
                                'NATIONAL' => 'Nasional',
                                'INTERNATIONAL' => 'Internasional'
                            ];
                        @endphp
                        @foreach($levelLabels as $value => $label)
                            <option value="{{ $value }}" {{ $tingkat == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </form>

            {{-- Opsi jumlah baris per halaman --}}
            <div class="flex flex-cols items-center justify-between gap-auto mb-4 w-full">
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
                        <th class="w-[30%] px-2 py-2 text-left">Nama Lomba</th>
                        <th class="w-[25%] px-2 py-2 text-left">Nama Mahasiswa</th>
                        <th class="w-[10%] px-2 py-2 text-left">Ranking</th>
                        <th class="w-[15%] px-2 py-2 text-left">Tingkat</th>
                        <th class="w-[15%] px-2 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prestasi as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration + ($prestasi->currentPage() - 1) * $prestasi->perPage() }}
                            </td>
                            <td class="px-2 py-2">{{ $item->competition_name }}</td>
                            <td class="px-2 py-2">{{ $item->nama_mahasiswa }}</td>
                            <td class="px-2 py-2 text-left">{{ $item->place }}</td>
                            <td class="px-2 py-2 text-left">
                                @php
                                    $levelLabels = [
                                        'INTERNAL' => 'Internal',
                                        'CITY' => 'Kota/ Kabupaten',
                                        'PROVINCE' => 'Provinsi',
                                        'NATIONAL' => 'Nasional',
                                        'INTERNATIONAL' => 'Internasional'
                                    ];
                                @endphp
                                {{ $levelLabels[$item->level->value] ?? $item->level->value }}
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
                            <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak ada data achievement.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Navigasi halaman dan informasi jumlah data --}}
        <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-gray-700">
                Menampilkan {{ $prestasi->firstItem() }} hingga {{ $prestasi->lastItem() }} dari {{ $prestasi->total() }}
                hasil
            </div>
            <div>
                {{ $prestasi->links('pagination::tailwind') }}
            </div>
        </div>
        </div>

        {{-- MODAL COMPONENTS --}}

        {{-- MODAL DETAIL ACHIEVEMENT --}}
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
                <h3 class="text-xl font-semibold mb-6 text-gray-800">Detail Achievement</h3>

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
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Ranking</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-ranking"></td>
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
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Jumlah Peserta</td>
                                <td class="border border-gray-200 px-3 py-2" id="detail-jumlah-peserta"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">URL Lomba</td>
                                <td class="border border-gray-200 px-3 py-2">
                                    <a href="#" target="_blank" class="text-blue-600 hover:underline" id="detail-url-lomba">
                                        Lihat Website
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Data Mahasiswa -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Data Mahasiswa</h4>
                            <table class="w-full text-gray-800 text-left text-sm" id="mahasiswa-table">
                                <thead>
                                    <tr>
                                        <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Nama
                                            Mahasiswa</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">NIM</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Role</td>
                                    </tr>
                                </thead>
                                <tbody id="mahasiswa-table-body">
                                    <!-- Mahasiswa data will be inserted here by JS -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Data Dosen Pembimbing -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Data Dosen Pembimbing</h4>
                            <table class="w-full text-gray-800 text-left text-sm" id="dosen-table">
                                <thead>
                                    <tr>
                                        <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Nama Dosen
                                        </td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">NIDN</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Role</td>
                                    </tr>
                                </thead>
                                <tbody id="dosen-table-body">
                                    <!-- Dosen data will be inserted here by JS -->
                                </tbody>
                            </table>
                        </div>

                        <!-- File Dokumen -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Dokumen</h4>
                            <table class="w-full text-gray-800 text-left text-sm">
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">Surat Tugas
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2" id="detail-surat-tugas">
                                        <a href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Sertifikat</td>
                                    <td class="border border-gray-200 px-3 py-2" id="detail-sertifikat">
                                        <a href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Poster</td>
                                    <td class="border border-gray-200 px-3 py-2" id="detail-poster">
                                        <a href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Foto Kegiatan</td>
                                    <td class="border border-gray-200 px-3 py-2" id="detail-foto-kegiatan">
                                        <a href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="button" onclick="closeModal('modal-detail')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentAchievementId = null; // To store the ID of the achievement being detailed

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
            currentAchievementId = id;
            try {
                const response = await fetch(`/admin/kelola-achievement/${id}/show`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                console.log(data);

                // Populate Data Lomba
                document.getElementById('detail-nama-lomba').textContent = data.competition_name || 'N/A';
                document.getElementById('detail-penyelenggara').textContent = data.competition_location || 'N/A';
                document.getElementById('detail-ranking').textContent = data.place || 'N/A';
                document.getElementById('detail-tingkat-lomba').textContent = data.level || 'N/A';
                document.getElementById('detail-bidang').textContent = data.tags.map(tag => tag.name).join(', ') || 'N/A';
                document.getElementById('detail-tanggal-mulai').textContent = data.start_at || 'N/A';
                document.getElementById('detail-tanggal-berakhir').textContent = data.end_at || 'N/A';
                document.getElementById('detail-jumlah-peserta').textContent = data.partition_number || 'N/A';
                const urlLomba = document.getElementById('detail-url-lomba');
                if (data.competition_url) {
                    urlLomba.href = data.competition_url;
                    urlLomba.textContent = 'Lihat Website';
                } else {
                    urlLomba.href = '#';
                    urlLomba.textContent = 'Tidak Tersedia';
                }


                // Populate Data Mahasiswa
                const mahasiswaTableBody = document.getElementById('mahasiswa-table-body');
                mahasiswaTableBody.innerHTML = ''; // Clear existing content
                if (data.mahasiswa && data.mahasiswa.length > 0) {
                    data.mahasiswa.forEach(mhs => {
                        const row = mahasiswaTableBody.insertRow();
                        row.innerHTML = `
                                <td class="border border-gray-200 px-3 py-2">${mhs.name || 'N/A'}</td>
                                <td class="border border-gray-200 px-3 py-2">${mhs.nim || 'N/A'}</td>
                                <td class="border border-gray-200 px-3 py-2">${mhs.pivot.role || 'N/A'}</td>
                            `;
                    });
                } else {
                    const row = mahasiswaTableBody.insertRow();
                    row.innerHTML = `
                            <td colspan="3" class="border border-gray-200 px-3 py-2 text-center">Tidak ada data mahasiswa.</td>
                        `;
                }

                // Populate Data Dosen Pembimbing
                const dosenTableBody = document.getElementById('dosen-table-body');
                dosenTableBody.innerHTML = ''; // Clear existing content
                if (data.dosen && data.dosen.length > 0) { // Use data.dosen as per controller change
                    data.dosen.forEach(dsn => {
                        const row = dosenTableBody.insertRow();
                        row.innerHTML = `
                                <td class="border border-gray-200 px-3 py-2">${dsn.name || 'N/A'}</td>
                                <td class="border border-gray-200 px-3 py-2">${dsn.nidn || 'N/A'}</td>
                                <td class="border border-gray-200 px-3 py-2">${dsn.pivot.role || 'N/A'}</td>
                            `;
                    });
                } else {
                    const row = dosenTableBody.insertRow();
                    row.innerHTML = `
                            <td colspan="3" class="border border-gray-200 px-3 py-2 text-center">Tidak ada data dosen pembimbing.</td>
                        `;
                }

                // Populate Dokumen
                document.getElementById('detail-surat-tugas').querySelector('a').href = (data.file_assignment_letter ? '/' + data.file_assignment_letter : '#');
                document.getElementById('detail-sertifikat').querySelector('a').href = (data.file_certificate ? '/' + data.file_certificate : '#');
                document.getElementById('detail-poster').querySelector('a').href = (data.file_poster ? '/' + data.file_poster : '#');
                document.getElementById('detail-foto-kegiatan').querySelector('a').href = (data.file_activity_photo ? '/' + data.file_activity_photo : '#');

                openModal('modal-detail');
            } catch (error) {
                console.error('Error fetching achievement details:', error);
                alert('Gagal memuat detail achievement. Silakan coba lagi.');
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function (event) {
            const modals = ['modal-detail']; // Only detail modal remains
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