@extends('layout.template')

@section('content')
    <main class="flex-1 px-10">
        <div class="w-full mx-auto p-6  border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold">Kelola Mahasiswa</h2>
            <div class="flex flex-wrap gap-4 pb-4 items-center">
                <div class="flex flex-wrap gap-4 py-4 items-center w-full">
                    <!-- Search Input -->
                    <form action="{{ route('admin.kelola-mahasiswa') }}" method="GET" class="flex items-center gap-4">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari disini" value="{{ $search }}"
                                class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                            </svg>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md text-sm hover:bg-blue-600">Cari</button>

                        <p class="text-sm text-gray-700 ml-4">Filter berdasarkan:</p>
                        <!-- Dropdown: Kategori -->
                        <div class="relative w-54">
                            <select name="program_studi" onchange="this.form.submit()"
                                class="appearance-none w-full py-2 pr-4 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" selected>Program Studi</option>
                                @foreach ($prodiOptions as $prodi)
                                    <option value="{{ $prodi->value }}" {{ $programStudi == $prodi->value ? 'selected' : '' }}>
                                        {{ $prodi->value }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <!-- Dropdown: Tingkat Lomba -->
                        <div class="relative w-40">
                            <select name="tingkat" onchange="this.form.submit()"
                                class="appearance-none w-full py-2 pr-10 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" selected>Tingkat</option>
                                <option value="1" {{ $tingkat == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $tingkat == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $tingkat == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $tingkat == '4' ? 'selected' : '' }}>4</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div class="relative w-54">
                            <select name="preference" onchange="this.form.submit()"
                                class="appearance-none w-full py-2 pr-4 pl-4 border border-gray-200 rounded-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" selected>Minat & Keahlian</option>
                                @foreach ($preferences as $pref)
                                    <option value="{{ $pref->id }}" {{ $selectedPreference == $pref->id ? 'selected' : '' }}>
                                        {{ $pref->name }}
                                    </option>
                                @endforeach
                            </select>
                    </form>
                    <!-- Dropdown: Minat & Keahlian -->
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
                    <div class="ml-auto">
                        <a href="{{ route('admin.kelola-mahasiswa.create') }}"
                            class="text-sm bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Mahasiswa
                        </a>
                    </div>
                </div>

                <script>
                    function changePerPage(value) {
                        // Get current URL
                        const currentUrl = new URL(window.location.href);

                        // Set new perPage value and reset page to 1
                        currentUrl.searchParams.set('perPage', value);
                        currentUrl.searchParams.set('page', 1);

                        // Preserve existing search and filter parameters
                        const searchInput = document.querySelector('input[name="search"]');
                        if (searchInput && searchInput.value) {
                            currentUrl.searchParams.set('search', searchInput.value);
                        }

                        const programStudiSelect = document.querySelector('select[name="program_studi"]');
                        if (programStudiSelect && programStudiSelect.value) {
                            currentUrl.searchParams.set('program_studi', programStudiSelect.value);
                        }

                        const tingkatSelect = document.querySelector('select[name="tingkat"]');
                        if (tingkatSelect && tingkatSelect.value) {
                            currentUrl.searchParams.set('tingkat', tingkatSelect.value);
                        }
 
                        const preferenceSelect = document.querySelector('select[name="preference"]');
                        if (preferenceSelect && preferenceSelect.value) {
                            currentUrl.searchParams.set('preference', preferenceSelect.value);
                        }
 
                        console.log('Redirecting to:', currentUrl.toString());
 
                        // Navigate to new URL
                        window.location.href = currentUrl.toString();
                    }
                </script>

                <table class="w-full text-left text-sm bg-white rounded-lg border border-gray-200 rounded-sm">
                    <thead class="text-gray-500">
                        <tr class="border-b border-gray-200">
                            <th class="w-[5%] px-4 py-2 text-left">No</th>
                            <th class="w-[15%] px-2 py-2 text-left">NIM</th>
                            <th class="w-[20%] px-2 py-2 text-left">Nama Mahasiswa</th>
                            <th class="w-[15%] px-2 py-2 text-left">Program Studi</th>
                            <th class="w-[10%] px-2 py-2 text-center">Tingkat</th>
                            <th class="w-[15%] px-2 py-2 text-left">Minat & Keahlian</th> {{-- New column --}}
                            <th class="w-[10%] px-2 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswa as $mhs)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-2 py-2">{{ $mhs->nim }}</td>
                                <td class="px-2 py-2">
                                    <a href="{{ route('user.profile.show', ['role' => 'mahasiswa', 'id' => $mhs->user->id]) }}" class="text-[#1e6aae] hover:underline">
                                        {{ $mhs->name }}
                                    </a>
                                </td>
                                <td class="px-2 py-2">{{ $mhs->prodi ?? '-' }}</td>
                                <td class="px-2 py-2 text-center">{{ $mhs->grade ?? '-' }}</td>
                                <td class="px-2 py-2">{{ $mhs->preferences->isNotEmpty() ? $mhs->preferences->pluck('name')->implode(', ') : '-' }}</td> {{-- New data --}}
                                <td class="px-2 py-2 flex justify-center gap-2">
                                    <div class="flex space-x-2">
                                        <button type="button"
                                            data-nim="{{ $mhs->nim }}"
                                            data-name="{{ $mhs->name }}"
                                            data-prodi="{{ $mhs->prodi ?? '-' }}"
                                            data-grade="{{ $mhs->grade ?? '-' }}"
                                            data-ipk="{{ $mhs->mark->ipk ?? '-' }}"
                                            data-email="{{ $mhs->user->email ?? '-' }}"
                                            data-phone="{{ $mhs->phone_number ?? '-' }}"
                                            data-address="{{ $mhs->address ?? '-' }}"
                                            data-district="{{ $mhs->district ?? '-' }}"
                                            data-subdistrict="{{ $mhs->subdistrict ?? '-' }}"
                                            data-city="{{ $mhs->city ?? '-' }}"
                                            data-preferences="{{ $mhs->preferences->isNotEmpty() ? $mhs->preferences->pluck('name')->implode(', ') : '-' }}"
                                            onclick="openDetailModalFromButton(this)"
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
                                        <a href="{{ route('admin.kelola-mahasiswa.edit', ['nim' => $mhs->nim]) }}"
                                            class="border border-amber-400 text-amber-400 hover:bg-amber-400 hover:text-white px-2 py-2 rounded text-xs flex items-center gap-1"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <button type="button" onclick="openDeleteModal('{{ $mhs->nim }}', '{{ $mhs->name }}', '{{ $mhs->prodi ?? '-' }}')"
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
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak ada data mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Navigasi halaman --}}
            <div class="flex justify-end mt-6">
                {{ $mahasiswa->appends(['search' => $search, 'program_studi' => $programStudi, 'tingkat' => $tingkat, 'preference' => $selectedPreference])->links('components.pagination-links') }}
            </div>
        </div>

        {{-- MODAL COMPONENTS --}}

        {{-- MODAL DETAIL MAHASISWA --}}
        <div id="modal-detail"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out py-8 item-center overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-md shadow-2xl max-w-2xl w-full p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button type="button" onclick="closeModal('modal-detail')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-6 text-gray-800">Detail Mahasiswa</h3>

                <div class="space-y-4">
                    <table class="w-full text-gray-800 text-left text-sm">
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium w-1/3 bg-gray-50">NIM</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-nim"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Nama Lengkap</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-name"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Program Studi</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-program_studi"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Semester</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-semester"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">IPK</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-ipk"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Email</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-email"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">No. Telepon</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-no_telepon"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Alamat</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-alamat"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Kecamatan</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-kecamatan"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Kelurahan</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-kelurahan"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Kota</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-kota"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 font-medium bg-gray-50">Preferensi</td>
                            <td class="border border-gray-200 px-3 py-2" id="detail-preferensi"></td>
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


        {{-- MODAL HAPUS MAHASISWA --}}
        <div id="modal-hapus"
            class="fixed inset-0 z-50 flex items-start justify-center bg-gray-900/70 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out pt-16 sm:pt-20 overflow-y-auto"
            data-state="closed">
            <div
                class="modal-dialog bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 sm:p-8 transform -translate-y-full scale-95 transition-all duration-500 ease-out">
                <button type="button" onclick="closeModal('modal-hapus')"
                    class="absolute top-3 right-3 p-1 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Data Mahasiswa</h3>
                    <div class="mb-4 space-y-4">
                        <p class="text-sm text-gray-500 mb-2">
                            Apakah Anda yakin ingin menghapus data mahasiswa berikut?
                        </p>
                        <div class="bg-gray-50 p-3 space-y-2 rounded-lg text-left">
                            <div class="text-sm"><strong>Nama:</strong> <span id="delete-mahasiswa-nama"></span></div>
                            <div class="text-sm"><strong>NIM:</strong> <span id="delete-mahasiswa-nim"></span></div>
                            <div class="text-sm"><strong>Program Studi:</strong> <span id="delete-mahasiswa-prodi"></span></div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-3 justify-end">
                        <button type="button" onclick="closeModal('modal-hapus')"
                            class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <form id="deleteForm" method="POST" action="{{ route('admin.kelola-mahasiswa.destroy', ['nim' => '__ID__']) }}" class="w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Remove MODAL EDIT MAHASISWA and MODAL TAMBAH MAHASISWA as they are now separate pages --}}
        <div id="modal-edit" style="display: none;"></div>
        <div id="modal-tambah" style="display: none;"></div>

    </main>
    <script>
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

        // Close modal when clicking outside
        document.addEventListener('click', function (event) {
            const modals = ['modal-detail', 'modal-hapus']; // Only these modals remain
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && modal.dataset.state === 'opened') {
                    if (event.target === modal) {
                        closeModal(modalId, event);
                    }
                }
            });
        });

        function openDetailModalFromButton(button) {
            const nim = button.dataset.nim;
            const name = button.dataset.name;
            const prodi = button.dataset.prodi;
            const grade = button.dataset.grade;
            const ipk = button.dataset.ipk;
            const email = button.dataset.email;
            const phone_number = button.dataset.phone;
            const address = button.dataset.address;
            const district = button.dataset.district;
            const subdistrict = button.dataset.subdistrict;
            const city = button.dataset.city;
            const preferences = button.dataset.preferences;

            document.getElementById('detail-nim').innerText = nim;
            document.getElementById('detail-name').innerText = name;
            document.getElementById('detail-program_studi').innerText = prodi;
            document.getElementById('detail-semester').innerText = grade;
            document.getElementById('detail-ipk').innerText = ipk;
            document.getElementById('detail-email').innerText = email;
            document.getElementById('detail-no_telepon').innerText = phone_number;
            document.getElementById('detail-alamat').innerText = address
            document.getElementById('detail-kecamatan').innerText = district;
            document.getElementById('detail-kelurahan').innerText = subdistrict;
            document.getElementById('detail-kota').innerText = city;
            document.getElementById('detail-preferensi').innerText = preferences === '-' ? 'Tidak ada preferensi' : preferences;
            openModal('modal-detail');
        }

        function openDeleteModal(id, name, program_studi) {
            document.getElementById('delete-mahasiswa-nama').innerText = name;
            document.getElementById('delete-mahasiswa-nim').innerText = id;
            document.getElementById('delete-mahasiswa-prodi').innerText = program_studi;
            const form = document.getElementById('deleteForm');
            form.action = form.action.replace('__ID__', id);
            openModal('modal-hapus');
        }
    </script>
@endsection