@extends('layout.template')

@section('content')
    <main class="flex-1 px-6">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg relative">
            <div class="mb-4 flex space-x-4 border-b border-gray-200">
                <a href="{{ route('dosen.tambah-lomba') }}">
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
                            @for ($i = 1; $i <= 4; $i++)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-2 ">{{ $i }}</td>
                                    <td class="px-6 py-2 ">Lomba Inovasi Digital</td>
                                    <td class="px-6 py-2 ">2024-06-01</td>
                                    <td class="px-6 py-2 ">
                                        <span
                                            class="inline-flex px-3 py-2 text-xs font-semibold rounded-md bg-green-100 text-green-600">Terverifikasi</span>
                                    </td>
                                    <td class="px-6 py-2">
                                        <div class="flex space-x-2">
                                            <button onclick="openModal('modal-detail')"
                                                class="border border-[#1e6aae] text-[#1e6aae] hover:bg-[#1e6aae] hover:text-white  px-2 py-2 rounded text-xs flex items-center gap-1"
                                                title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </button>
                                            <button onclick="openModal('modal-edit')"
                                                class="border border-amber-400 text-amber-400 hover:bg-amber-400 hover:text-white px-2 py-2 rounded text-xs flex items-center gap-1"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <button onclick="openModal('modal-hapus')"
                                                class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-2 py-2 rounded text-xs flex items-center gap-1"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                {{-- MODAL --}}

                <div id="modal-detail"
                    class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-16 item-center overflow-y-auto"
                    data-state="closed">
                    <div
                        class="modal-dialog bg-white rounded-md shadow-2xl max-w-3xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                        <button onclick="closeModal('modal-detail')"
                            class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-semibold mb-6 text-gray-800">Detail Lomba</h3>

                        <div class="overflow-x-auto">
                            <table class="w-full max-w-auto text-gray-800 text-left text-sm">
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium">Nama Lomba</td>
                                    <td class="border border-gray-200 px-3 py-2">Lomba Inovasi Digital</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Penyelenggara
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Institut Teknologi Malang</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tingkat Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Nasional</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Bidang Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">Web Development</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal Mulai
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-01</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tanggal
                                        Berakhir</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-06-03</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Tenggat
                                        Pendaftaran</td>
                                    <td class="border border-gray-200 px-3 py-2">2024-05-29</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">Jumlah
                                        Peserta</td>
                                    <td class="border border-gray-200 px-3 py-2">3</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium whitespace-nowrap">URL Lomba
                                    </td>
                                    <td class="border border-gray-200 px-3 py-2">www.tidaktahu.com</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 font-medium">Status</td>
                                    <td class="border border-gray-200 px-3 py-2">
                                        <span
                                            class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-sm">Terverifikasi</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-3 py-2 align-top font-medium">Deskripsi</td>
                                    <td class="border border-gray-200 px-3 py-2 max-w-xs align-top">
                                        <div class="line-clamp-2 break-words text-ellipsis overflow-hidden"
                                            style="max-width: 24rem;"
                                            title="Deskripsi lomba akan ditampilkan di sini. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Deskripsi lomba akan ditampilkan di sini. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Deskripsi lomba akan ditampilkan di sini. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Deskripsi lomba akan ditampilkan di sini. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Deskripsi lomba akan ditampilkan di sini. Lorem ipsum dolor sit amet, consectetur adipiscing elit">
                                            Deskripsi lomba akan ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Deskripsi lomba akan
                                            ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.Deskripsi lomba akan
                                            ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Deskripsi lomba akan
                                            ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Deskripsi lomba akan
                                            ditampilkan di sini.
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                        </div>
                                    </td>
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

                <div id="modal-edit"
                    class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-16 overflow-y-auto"
                    data-state="closed">
                    <div
                        class="modal-dialog bg-white rounded-md shadow-2xl w-full max-w-3xl p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                        <button onclick="closeModal('modal-edit')"
                            class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <h3 class="text-xl font-semibold mb-6 text-gray-800">Edit Lomba</h3>
                        <form class="space-y-2">
                            <!-- Nama Lomba -->
                            <div class="flex items-center space-x-4">
                                <label for="nama" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama
                                    Lomba</label>
                                <input type="text" id="nama" name="nama"
                                    class="flex-1 block border border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- Penyelenggara -->
                            <div class="flex items-center space-x-4">
                                <label for="nama"
                                    class="block text-sm font-medium text-gray-700 w-50 mb-0">Penyelenggara</label>
                                <input type="text" id="nama" name="nama"
                                    class="flex-1 block border border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- Tingkat Lomba -->
                            <div class="flex items-center space-x-4">
                                <label for="partisipasi" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tingkat
                                    Lomba</label>
                                <div class="relative">
                                    <select id="partisipasi" name="partisipasi"
                                        class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-md p-2 text-xs pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
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
                            </div>
                            <!-- Bidang Lomba -->
                            <div class="flex items-center space-x-4">
                                <label for="partisipasi" class="block text-sm font-medium text-gray-700 w-50 mb-0">Bidang
                                    Lomba</label>
                                <div class="relative">
                                    <select id="partisipasi" name="partisipasi"
                                        class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-md p-2 text-xs pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                                        <option disabled selected hidden>Pilih Bidang</option>
                                        <option>Cyber Security</option>
                                        <option>IoT</option>
                                        <option>Software Development</option>
                                        <option>UI/UX Design</option>
                                        <option>Essay</option>
                                    </select>
                                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <!-- Tanggal Mulai -->
                            <div class="flex items-center space-x-4">
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal
                                    Mulai</label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- Tanggal Berakhir -->
                            <div class="flex items-center space-x-4">
                                <label for="tanggal_berakhir"
                                    class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal
                                    Berakhir</label>
                                <input type="date" id="tanggal_berakhir" name="tanggal_berakhir"
                                    class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- Tanggal Pendaftaran -->
                            <div class="flex items-center space-x-4">
                                <label for="tenggat_pendaftaran"
                                    class="block text-sm font-medium text-gray-700 w-50 mb-0">Tenggat
                                    Pendaftaran</label>
                                <input type="date" id="tenggat_pendaftaran" name="tenggat_pendaftaran"
                                    class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- Jumlah Peserta -->
                            <div class="flex items-center space-x-4">
                                <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 w-50 mb-0">Jumlah
                                    Peserta</label>
                                <input type="text" id="jumlah_peserta" name="jumlah_peserta"
                                    class="flex-1 block border border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- URL Lomba -->
                            <div class="flex items-center space-x-4">
                                <label for="url_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">URL
                                    Lomba</label>
                                <input type="text" id="url_lomba" name="url_lomba"
                                    class="flex-1 block border border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <!-- Deskripsi -->
                            <div class="flex items-center space-x-4">
                                <label for="deskripsi_lomba"
                                    class="block text-sm font-medium text-gray-700 w-50 mb-0">Deskripsi
                                    Singkat</label>
                                <textarea type="text" id="deskripsi_lomba" name="deskripsi_lomba"
                                    class="flex-1 block border p-4 h-32 border-gray-300 rounded-md p-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Tuliskan deskripsi singkat mengenai lomba"></textarea>
                            </div>
                            <!-- Poster Lomba -->
                            <div class="flex items-center space-x-4">
                                <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">Poster
                                    Lomba</label>
                                <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                                    class="block w-full max-w-xs text-xs text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4  file:border-0 file:text-xs file:font-base file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>
                    </div>
                </div>

                <div id="modal-hapus"
                    class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out pt-16 sm:pt-20"
                    data-state="closed">
                    <div
                        class="modal-dialog bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                        <button onclick="closeModal('modal-hapus')"
                            class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <div class="text-center">
                            <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold mb-3 text-gray-800">Hapus Lomba</h3>
                            <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus lomba <br
                                    class="hidden sm:inline" />"<span class="font-semibold text-gray-700">Lomba Inovasi
                                    Digital</span>"?<br class="hidden sm:inline" /></p>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-center mt-8 space-y-3 sm:space-y-0 sm:space-x-3">
                            <button type="button" onclick="closeModal('modal-hapus')"
                                class="w-full text-sm px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400">
                                Batal
                            </button>
                            <button type="button"
                                class="w-full px-4 py-2 text-sm rounded-lg bg-red-600 text-white hover:bg-red-700 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                                Ya, Hapus
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

        // Event listeners untuk tombol yang sudah ada (jika Anda menggunakan title untuk seleksi)
        // Jika tombol Anda sudah memiliki onclick="openModal(...)" maka ini tidak diperlukan lagi.
        // Namun, jika Anda ingin memisahkan event listener:
        // document.querySelectorAll('button[title="Lihat Detail"]').forEach(btn => {
        //     btn.addEventListener('click', () => openModal('modal-detail'));
        // });
        // document.querySelectorAll('button[title="Edit"]').forEach(btn => {
        //     btn.addEventListener('click', () => openModal('modal-edit'));
        // });
        // document.querySelectorAll('button[title="Hapus"]').forEach(btn => {
        //     btn.addEventListener('click', () => openModal('modal-hapus'));
        // });
    </script>



@endsection