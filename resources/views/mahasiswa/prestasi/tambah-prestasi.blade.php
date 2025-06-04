@extends('layout.template')

@section('content')
    <main class="flex-1 px-10 pb-16">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">Tambah Prestasi Baru</h2>
            <p class="text-sm text-gray-400">Lengkapi data prestasi yang telah kamu raih selama masa studi. Pastikan kamu
                mengunggah bukti yang valid seperti sertifikat atau surat keterangan resmi.</p>

            <div class="relative p-8 pt-14 mt-4 border border-gray-200 rounded-sm">
                <div class="absolute inset-x-0 top-0 h-10 w-full bg-[#1e6aae] flex rounded-t-md items-center">
                    <span class="text-white font-medium pl-4">Data Kompetisi</span>
                </div>
                <form action="{{ route('mahasiswa.store-prestasi') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <!-- Nama Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="competition_name" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lomba</label>
                        <input type="text" id="competition_name" name="competition_name" required
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Nama Lomba (English) -->
                    <div class="flex items-center space-x-4">
                        <label for="competition_name_english" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lomba (English)</label>
                        <input type="text" id="competition_name_english" name="competition_name_english"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>


                    <!-- Lokasi Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="competition_location" class="block text-sm font-medium text-gray-700 w-50 mb-0">Lokasi Lomba</label>
                        <input type="text" id="competition_location" name="competition_location" required
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Lokasi Lomba (English) -->
                    <div class="flex items-center space-x-4">
                        <label for="competition_location_english" class="block text-sm font-medium text-gray-700 w-50 mb-0">Lokasi Lomba (English)</label>
                        <input type="text" id="competition_location_english" name="competition_location_english"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Nomor Surat Tugas -->
                    <div class="flex items-center space-x-4">
                        <label for="assignment_letter_number" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nomor Surat Tugas</label>
                        <input type="text" id="assignment_letter_number" name="assignment_letter_number" required
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Tanggal Surat Tugas -->
                    <div class="flex items-center space-x-4">
                        <label for="assignment_letter_date" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal Surat Tugas</label>
                        <input type="date" id="assignment_letter_date" name="assignment_letter_date" required
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- PT Partition Number -->
                    <div class="flex items-center space-x-4">
                        <label for="pt_partition_number" class="block text-sm font-medium text-gray-700 w-50 mb-0">Total Partisi PT</label>
                        <input type="number" id="pt_partition_number" name="pt_partition_number" required
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Partition Number -->
                    <div class="flex items-center space-x-4">
                        <label for="partition_number" class="block text-sm font-medium text-gray-700 w-50 mb-0">Total Partisi</label>
                        <input type="number" id="partition_number" name="partition_number" required
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                     <!-- Juara Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="place" class="block text-sm font-medium text-gray-700 w-50 mb-0">Ranking Lomba</label>
                        <div class="relative">
                            <select id="place" name="place"
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-[#1e6aae] appearance-none" required>
                                <option disabled selected hidden>Pilih Rangking</option>
                                <option value="1">Juara 1</option>
                                <option value="2">Juara 2</option>
                                <option value="3">Juara 3</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Tingkat Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="level" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tingkat
                            Lomba</label>
                        <div class="relative">
                            <select id="level" name="level"
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-[#1e6aae] appearance-none" required>
                                <option disabled selected hidden>Pilih Tingkat</option>
                                <option value="INTERNATIONAL">Internasional</option>
                                <option value="NATIONAL">Nasional</option>
                                <option value="PROVINCE">Provinsi</option>
                                <option value="KOTA_KABUPATEN">Kota/Kabupaten</option>
                                <option value="INTERNAL">Internal</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Competition Type (Hidden Field) -->
                    <input type="hidden" id="competition_type" name="competition_type" value="Lomba">

                    <!-- Tanggal Mulai -->
                    <div class="flex items-center space-x-4">
                        <label for="start_at" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal
                            Mulai</label>
                        <input type="date" id="start_at" name="start_at" required
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>
                    <!-- Tanggal Berakhir -->
                    <div class="flex items-center space-x-4">
                        <label for="end_at" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal
                            Berakhir</label>
                        <input type="date" id="end_at" name="end_at" required
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- URL Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="competition_url" class="block text-sm font-medium text-gray-700 w-50 mb-0">URL Lomba</label>
                        <input type="text" id="competition_url" name="competition_url"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex items-center space-x-4">
                        <label for="note" class="block text-sm font-medium text-gray-700 w-50 mb-0">Deskripsi
                            Singkat</label>
                        <textarea type="text" id="note" name="note"
                            class="flex-1 block border p-4 h-32 border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e6aae]"
                            placeholder="Tuliskan deskripsi singkat mengenai lomba"></textarea>
                    </div>

                    <!-- File Uploads -->
                    <div class="flex items-center space-x-4">
                        <label for="file_assignment_letter" class="block text-sm font-medium text-gray-700 w-50 mb-0">File Surat
                            Tugas</label>
                        <input type="file" id="file_assignment_letter" name="file_assignment_letter" accept="application/pdf" required
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="file_certificate" class="block text-sm font-medium text-gray-700 w-50 mb-0">File
                            Sertifikat</label>
                        <input type="file" id="file_certificate" name="file_certificate" accept="application/pdf" required
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="file_poster" class="block text-sm font-medium text-gray-700 w-50 mb-0">File
                            Poster</label>
                        <input type="file" id="file_poster" name="file_poster" accept="image/*"
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="file_activity_photo" class="block text-sm font-medium text-gray-700 w-50 mb-0">Foto
                            Kegiatan</label>
                        <input type="file" id="file_activity_photo" name="file_activity_photo" accept="image/*"
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                    <!-- Data Mahasiswa -->
                    <div class="relative p-8 pt-14 mt-4 border border-gray-200 rounded-sm">
                        <div class="absolute inset-x-0 top-0 h-10 w-full bg-[#1e6aae] flex rounded-t-md items-center">
                            <span class="text-white font-medium pl-4">Data Mahasiswa</span>
                        </div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 border border-gray-300">
                                <thead class="text-xs text-gray-700 border-b border-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300">
                                            Nama Mahasiswa
                                        </th>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300">
                                            Peran
                                        </th>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300">
                                            Tags
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="mahasiswaTableBody">
                                    <tr class="bg-white border-b border-gray-300">
                                        <td class="w-1/24 text-gray-900 px-6 py-2 border-r border-gray-300">
                                            1
                                        </td>
                                        <td class="px-6 py-2 border-r border-gray-300">
                                            <select name="nim_mahasiswa[]" class="mahasiswa-select block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500" required>
                                                <option value="">Pilih Mahasiswa</option>
                                                @foreach ($mahasiswaList as $mhs)
                                                    <option value="{{ $mhs->nim }}">{{ $mhs->nim }} - {{ $mhs->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-6 py-2 border-r border-gray-300">
                                            <select name="peran_mahasiswa[]"
                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                                <option value="peserta">Personal</option>
                                                <option value="ketua">Ketua</option>
                                                <option value="anggota">Anggota</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-2 border-r border-gray-300">
                                            <select name="tags_mahasiswa[]" class="tag-select block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                                <option value="">Pilih Tag</option>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="w-1/8 px-4 py-2">
                                            <button type="button"
                                                class="removeMahasiswa border border-red-600 text-red-600 hover:bg-red-600 hover:text-white py-1 px-2 flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 text-left">
                            <button id="addMahasiswa"
                                class="text-sm bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700  transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Mahasiswa
                            </button>
                        </div>
                    </div>

                    <!-- Data Dosen -->
                    <div class="relative p-8 pt-14 mt-4 border border-gray-200 rounded-sm">
                        <div class="absolute inset-x-0 top-0 h-10 w-full bg-[#1e6aae] flex rounded-t-md items-center">
                            <span class="text-white font-medium pl-4">Data Dosen</span>
                        </div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 border border-gray-300">
                                <thead class="text-xs text-gray-700 border-b border-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300">No</th>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300">Nama Dosen</th>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300">Peran</th>
                                        <th scope="col" class="px-6 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dosenTableBody">
                                    <tr class="bg-white border-b border-gray-300">
                                        <td class="w-1/24 text-gray-900 px-6 py-2 border-r border-gray-300">1</td>
                                        {{-- kalau nurut SIAKAD, ini nanti select nama mahasiswa, coba lihat yang tambah kompetisi di SIAKAD --}}
                                        <td class="px-6 py-2 border-r border-gray-300">
                                            <select name="nidn_dosen[]" class="dosen-select block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500" required>
                                                <option value="">Pilih Dosen</option>
                                                @foreach ($dosenList as $dosen)
                                                    <option value="{{ $dosen->nidn }}">{{ $dosen->nidn }} - {{ $dosen->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        {{-- FIk iki aku bingung peran e opo wae --}}
                                        <td class="px-6 py-2 border-r border-gray-300">
                                            <select name="peran_dosen[]"
                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500" required>
                                                <option disabled selected hidden>Pilih Peran</option>
                                                @foreach ($roleSupervisorList as $role)
                                                    <option value="{{ $role->id }}">{{ $role->description }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="w-1/8 px-4 py-2">
                                            <button type="button"
                                                class="removeDosen border border-red-600 text-red-600 hover:bg-red-600 hover:text-white py-1 px-2 flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 text-left">
                            <button id="addDosen"
                                class="text-sm bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Dosen
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-[#1e6aae] text-white px-6 py-2 rounded-md hover:bg-[#17568a] transition">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        // @formatter:off
        const tagsData = @json($tags);
        const mahasiswaListData = @json($mahasiswaList);
        const dosenListData = @json($dosenList);
        const roleSupervisorListData = @json($roleSupervisorList);
        // @formatter:on

        document.addEventListener('DOMContentLoaded', function () {
            const addMahasiswaButton = document.getElementById('addMahasiswa');
            const mahasiswaTableBody = document.getElementById('mahasiswaTableBody');
            const addDosenButton = document.getElementById('addDosen');
            const dosenTableBody = document.getElementById('dosenTableBody');

            // Initialize Select2 for existing elements
            $('.mahasiswa-select').select2({
                placeholder: "Pilih Mahasiswa",
                allowClear: true,
                dropdownParent: $('#mahasiswaTableBody').closest('.relative') // Ensure dropdown is within the form
            });
            $('.dosen-select').select2({
                placeholder: "Pilih Dosen",
                allowClear: true,
                dropdownParent: $('#dosenTableBody').closest('.relative') // Ensure dropdown is within the form
            });
            $('.tag-select').select2({
                placeholder: "Pilih Tag",
                allowClear: true,
                dropdownParent: $('#mahasiswaTableBody').closest('.relative') // Ensure dropdown is within the form
            });


            addMahasiswaButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default form validation
                const newRow = document.createElement('tr');
                newRow.classList.add('bg-white', 'border-b', 'border-gray-300');

                const rowCount = mahasiswaTableBody.children.length + 1;

                newRow.innerHTML = `
                    <td class="w-1/24 text-gray-900 px-6 py-2 border-r border-gray-300">
                        ${rowCount}
                    </td>
                    <td class="px-6 py-2 border-r border-gray-300">
                        <select name="nim_mahasiswa[]" class="mahasiswa-select block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500" required>
                            <option value="">Pilih Mahasiswa</option>
                            ${mahasiswaListData.map(mhs => `<option value="${mhs.nim}">${mhs.nim} - ${mhs.name}</option>`).join('')}
                        </select>
                    </td>
                    <td class="px-6 py-2 border-r border-gray-300">
                        <select name="peran_mahasiswa[]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                            <option value="PERSONAL">Personal</option>
                            <option value="LEADER">Ketua</option>
                            <option value="MEMBER">Anggota</option>
                        </select>
                    </td>
                    <td class="px-6 py-2 border-r border-gray-300">
                        <select name="tags_mahasiswa[]" class="tag-select block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                            <option value="">Pilih Tag</option>
                            ${tagsData.map(tag => `<option value="${tag.id}">${tag.name}</option>`).join('')}
                        </select>
                    </td>
                    <td class="w-1/8 px-4 py-2">
                        <button type="button" class="removeMahasiswa border border-red-600 text-red-600 hover:bg-red-600 hover:text-white py-1 px-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hapus
                        </button>
                    </td>
                `;

                mahasiswaTableBody.appendChild(newRow);

                // Initialize Select2 for the newly added row
                $(newRow).find('.mahasiswa-select').select2({
                    placeholder: "Pilih Mahasiswa",
                    allowClear: true,
                    dropdownParent: $(newRow).find('.mahasiswa-select').closest('td')
                });
                $(newRow).find('.tag-select').select2({
                    placeholder: "Pilih Tag",
                    allowClear: true,
                    dropdownParent: $(newRow).find('.tag-select').closest('td')
                });

            });

            mahasiswaTableBody.addEventListener('click', function (event) {
                const removeButton = event.target.closest('.removeMahasiswa');
                if (removeButton) {
                    event.preventDefault(); // Prevent default button action
                    if (mahasiswaTableBody.children.length > 1) {
                        removeButton.closest('tr').remove();
                        updateRowNumbers(mahasiswaTableBody);
                    } else {
                        notyf.error('Minimal harus ada satu data Mahasiswa.');
                    }
                }
            });


            addDosenButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default form validation
                const newRow = document.createElement('tr');
                newRow.classList.add('bg-white', 'border-b', 'border-gray-300');

                const rowCount = dosenTableBody.children.length + 1;

                newRow.innerHTML = `
                    <td class="w-1/24 text-gray-900 px-6 py-2 border-r border-gray-300">
                        ${rowCount}
                    </td>
                    <td class="px-6 py-2 border-r border-gray-300">
                        <select name="nidn_dosen[]" class="dosen-select block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500" required>
                            <option value="">Pilih Dosen</option>
                            ${dosenListData.map(dosen => `<option value="${dosen.nidn}">${dosen.nidn} - ${dosen.name}</option>`).join('')}
                        </select>
                    </td>
                    <td class="px-6 py-2 border-r border-gray-300">
                        <select name="peran_dosen[]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500" required>
                            <option disabled selected hidden>Pilih Peran</option>
                            ${roleSupervisorListData.map(role => `<option value="${role.id}">${role.description}</option>`).join('')}
                        </select>
                    </td>
                    <td class="w-1/8 px-4 py-2">
                        <button type="button" class="removeDosen border border-red-600 text-red-600 hover:bg-red-600 hover:text-white py-1 px-2 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hapus
                        </button>
                    </td>
                `;

                dosenTableBody.appendChild(newRow);

                // Initialize Select2 for the newly added row
                $(newRow).find('.dosen-select').select2({
                    placeholder: "Pilih Dosen",
                    allowClear: true,
                    dropdownParent: $(newRow).find('.dosen-select').closest('td')
                });

            });

            dosenTableBody.addEventListener('click', function (event) {
                const removeButton = event.target.closest('.removeDosen');
                if (removeButton) {
                    event.preventDefault(); // Prevent default button action
                    if (dosenTableBody.children.length > 1) {
                        removeButton.closest('tr').remove();
                        updateRowNumbers(dosenTableBody);
                    } else {
                        notyf.error('Minimal harus ada satu data Dosen.');
                    }
                }
            });

            function updateRowNumbers(tableBody) {
                const rows = tableBody.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    row.querySelector('td:first-child').textContent = index + 1;
                });
            }
        });
    </script>
@endpush

