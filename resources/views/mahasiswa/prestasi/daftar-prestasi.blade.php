@extends('layout.template')

@section('content')
    <main class="flex-1 px-10 pb-96">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">Daftar Prestasi</h2>
            <p class="text-sm text-gray-400">Lihat dan pantau seluruh prestasi yang telah Anda unggah selama masa studi.
                Pastikan setiap prestasi disertai bukti sah seperti sertifikat atau surat keterangan resmi.</p>
            <form id="filterForm" class="flex flex-wrap gap-4 py-4 items-center">
                <div class="flex flex-wrap gap-4 py-4 items-center w-full">
                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" id="search" name="search" placeholder="Cari disini"
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            value="{{ $currentSearch }}" />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                        </svg>
                    </div>

                    <!-- Dropdown: Kategori -->
                    <div class="relative w-54">
                        <select id="kategori" name="kategori"
                            class="appearance-none w-full py-2 pr-4 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" default>Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}" {{ $currentKategori == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- Dropdown: Tingkat prestasi -->
                    <div class="relative w-40">
                        <select id="tingkat" name="tingkat"
                            class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" default>Semua Tingkat</option>
                            <option value="INTERNATIONAL" {{ $currentTingkat == 'INTERNATIONAL' ? 'selected' : '' }}>Internasional</option>
                            <option value="NATIONAL" {{ $currentTingkat == 'NATIONAL' ? 'selected' : '' }}>Nasional</option>
                            <option value="PROVINCE" {{ $currentTingkat == 'PROVINCE' ? 'selected' : '' }}>Provinsi</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <!-- Dropdown: Partisipan -->
                    <div class="relative w-44">
                        <select id="status" name="status"
                            class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" default>Semua Status</option>
                            <option value="ACCEPTED" {{ $currentStatus == 'ACCEPTED' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="WAITING" {{ $currentStatus == 'WAITING' ? 'selected' : '' }}>Menunggu</option>
                            <option value="REJECTED" {{ $currentStatus == 'REJECTED' ? 'selected' : '' }}>Ditolak</option>
                            <option value="REVISION" {{ $currentStatus == 'REVISION' ? 'selected' : '' }}>Revisi</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <!-- Button: Tambah prestasi -->
                    <div class="ml-auto">
                        <a href="{{route('mahasiswa.tambah-prestasi')}}">
                            <button type="button"
                                class="text-sm bg-[#1e6aae] text-white px-5 py-2 rounded-md hover:bg-[#17497C] transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Prestasi
                            </button>
                        </a>
                    </div>
                </div>
            </form>
                <table id="achievements-table" class="w-full text-left text-sm bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3">Nama Lomba</th>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Ranking</th>
                            <th class="py-2 px-3">Tingkat</th>
                            <th class="py-2 px-3">Status</th>
                            <th class="py-2 px-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- DataTables will populate this --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL --}}

        <div id="modal-detail"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-7xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out ">
                <button onclick="closeModal('modal-detail')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800 inline-block mr-2">Detail Prestasi</h3>
                <span id="detail-status-badge"
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 align-middle">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Terverifikasi
                </span>

                <div class="overflow-x-auto grid grid-cols-2 gap-8 mt-6">
                    <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium">Nama Lomba</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-competition-name"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Penyelenggara
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-organizer"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tingkat prestasi
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-level"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Bidang prestasi
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-type"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                            </td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-start-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                Berakhir</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-end-date"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Tenggat
                                Pendaftaran</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-registration-deadline"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">Jumlah
                                Peserta</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-participants"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium whitespace-nowrap">URL prestasi
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-url" href="#" target="_blank" class="text-blue-600 hover:underline"></a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 align-top font-medium">Deskripsi</td>
                            <td class="border border-gray-200 px-3 py-2 max-w-xs align-top">
                                <div id="detail-description" class="line-clamp-2 break-words text-ellipsis overflow-hidden"
                                    style="max-width: 24rem;"
                                    title="">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium">File Surat Tugas</td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-assignment-letter" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">File Sertifikat
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-certificate" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">File Foto Kegiatan
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-activity-photo" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">File Poster
                            </td>
                            <td class="border border-gray-200 px-3 py-2"><a id="detail-file-poster" href="#" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></td>
                        </tr>
                    </table>
                </div>

                <div class="mt-8 text-right">
                    <button type="button" onclick="closeModal('modal-detail')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <div id="modal-waiting"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button onclick="closeModal('modal-waiting')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800 inline-block mr-2">Detail Prestasi</h3>
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Sedang diproses
                </span>
                <div id="waiting-detail-content">
                </div>
                <div class="mt-8 text-right flex justify-end gap-4">
                    <button type="button"
                        class="px-4 py-2 rounded-lg bg-blue-200 text-blue-800 hover:bg-blue-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Edit
                    </button>
                    <button type="button"
                        class="px-4 py-2 rounded-lg bg-red-200 text-red-800 hover:bg-red-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-red-400">
                        Hapus
                    </button>
                    <button type="button" onclick="closeModal('modal-waiting')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <div id="modal-rejected"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button onclick="closeModal('modal-rejected')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800 inline-block mr-2">Detail Prestasi</h3>
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Ditolak
                </span>
                <div id="rejected-detail-content"></div>
                <div class="mt-8 text-right flex justify-end gap-4">
                    <button type="button"
                        class="px-4 py-2 rounded-lg bg-blue-200 text-blue-800 hover:bg-blue-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Lakukan Revisi
                    </button>
                    <button type="button" onclick="closeModal('modal-rejected')"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script>
            const DIALOG_TRANSITION_DURATION = 500; // Corresponds to duration-500 in Tailwind for the dialog
            const OVERLAY_TRANSITION_DURATION = 300; // Corresponds to duration-300 in Tailwind for the overlay

            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'opened' || modal.dataset.state === 'opening') {
                    return;
                }
                const modalDialog = modal.querySelector('.modal-dialog');

                modal.dataset.state = 'opening';
                modal.classList.remove('opacity-0', 'pointer-events-none');
                void modal.offsetWidth; // Force reflow
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

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal || modal.dataset.state === 'closed' || modal.dataset.state === 'closing') {
                    return;
                }
                const modalDialog = modal.querySelector('.modal-dialog');

                modal.dataset.state = 'closing';
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
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
                        modal.classList.add('pointer-events-none');
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                };
                targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                targetElement.addEventListener('transitionend', onCloseTransitionEnd);

                setTimeout(() => {
                    if (modal.dataset.state === 'closing' && !closeTransitionEnded) {
                        closeTransitionEnded = true;
                        modal.classList.add('pointer-events-none');
                        modal.dataset.state = 'closed';
                        targetElement.removeEventListener('transitionend', onCloseTransitionEnd);
                    }
                }, duration + 70);
            }

            async function openDetailModal(achievementId) {
                try {
                    const response = await fetch(`/prestasi/detail/${achievementId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const achievement = await response.json();

                    // Populate modal-detail
                    const modalDetail = document.getElementById('modal-detail');
                    modalDetail.querySelector('#detail-competition-name').textContent = achievement.competition_name;
                    modalDetail.querySelector('#detail-organizer').textContent = achievement.competition_location; // Assuming location is organizer
                    modalDetail.querySelector('#detail-level').textContent = achievement.level;
                    modalDetail.querySelector('#detail-type').textContent = achievement.competition_type;
                    modalDetail.querySelector('#detail-start-date').textContent = achievement.start_at;
                    modalDetail.querySelector('#detail-end-date').textContent = achievement.end_at;
                    modalDetail.querySelector('#detail-registration-deadline').textContent = achievement.assignment_letter_date; // Assuming this is the closest field
                    modalDetail.querySelector('#detail-participants').textContent = achievement.partition_number; // Assuming this is the closest field
                    modalDetail.querySelector('#detail-url').textContent = achievement.competition_url;
                    modalDetail.querySelector('#detail-url').href = achievement.competition_url;
                    modalDetail.querySelector('#detail-description').textContent = achievement.note; // Assuming note is description

                    // Update status badge in modal-detail
                    const statusBadgeDetail = modalDetail.querySelector('#detail-status-badge');
                    let statusText = '';
                    let statusClass = '';
                    let statusDotClass = '';

                    switch (achievement.status) {
                        case 'ACCEPTED':
                            statusText = 'Terverifikasi';
                            statusClass = 'bg-green-100 text-green-700';
                            statusDotClass = 'bg-green-500';
                            break;
                        case 'WAITING':
                            statusText = 'Menunggu';
                            statusClass = 'bg-yellow-100 text-yellow-700';
                            statusDotClass = 'bg-yellow-500';
                            break;
                        case 'REJECTED':
                            statusText = 'Ditolak';
                            statusClass = 'bg-red-100 text-red-700';
                            statusDotClass = 'bg-red-500';
                            break;
                        case 'REVISION':
                            statusText = 'Revisi';
                            statusClass = 'bg-blue-100 text-blue-700';
                            statusDotClass = 'bg-blue-500';
                            break;
                        default:
                            statusText = 'Unknown';
                            statusClass = 'bg-gray-100 text-gray-700';
                            statusDotClass = 'bg-gray-500';
                    }
                    statusBadgeDetail.setAttribute('class', 'inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold align-middle ' + statusClass);
                    statusBadgeDetail.innerHTML = `<span class="w-2 h-2 rounded-full ${statusDotClass}"></span>${statusText}`;


                    // Open the correct modal based on status
                    if (achievement.status === 'WAITING') {
                        // Populate modal-waiting if needed, then open
                        const modalWaiting = document.getElementById('modal-waiting');
                        modalWaiting.querySelector('#waiting-detail-content').textContent = `Detail untuk prestasi "${achievement.competition_name}" sedang menunggu verifikasi.`;
                        openModal('modal-waiting');
                    } else if (achievement.status === 'REJECTED' || achievement.status === 'REVISION') {
                        // Populate modal-rejected if needed, then open
                        const modalRejected = document.getElementById('modal-rejected');
                        modalRejected.querySelector('#rejected-detail-content').textContent = achievement.note; // Assuming 'note' contains rejection reason
                        openModal('modal-rejected');
                    } else {
                        openModal('modal-detail');
                    }

                } catch (error) {
                    console.error('Error fetching achievement details:', error);
                    alert('Failed to load achievement details.');
                }
            }

            $(document).ready(function() {
                var table = $('#achievements-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false, // Disable default search bar
                    lengthChange: false, // Disable "Show X entries" dropdown
                    ajax: {
                        url: "{{ route('mahasiswa.prestasi.data') }}",
                        data: function (d) {
                            d.search = $('#search').val();
                            d.kategori = $('#kategori').val();
                            d.tingkat = $('#tingkat').val();
                            d.status = $('#status').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'competition_name', name: 'competition_name' },
                        { data: 'tag_name', name: 'tag_name' },
                        { data: 'place', name: 'place' },
                        { data: 'level', name: 'level' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ]
                });

                $('#filterForm select, #search').on('change keyup', function() {
                    table.draw();
                });
            });
        </script>
@endsection
