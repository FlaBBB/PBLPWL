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
                <form class="space-y-6">
                    <!-- Nama Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lomba</label>
                        <input type="text" id="nama" name="nama"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Penyelenggara -->
                    <div class="flex items-center space-x-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 w-50 mb-0">Penyelenggara</label>
                        <input type="text" id="nama" name="nama"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                     <!-- Juara Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="partisipasi" class="block text-sm font-medium text-gray-700 w-50 mb-0">Ranking Lomba</label>
                        <div class="relative">
                            <select id="partisipasi" name="partisipasi"
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-[#1e6aae] appearance-none">
                                <option disabled selected hidden>Pilih Tingkat</option>
                                <option>Juara 1</option>
                                <option>Juara 2</option>
                                <option>Juara 3</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Tingkat Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="partisipasi" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tingkat
                            Lomba</label>
                        <div class="relative">
                            <select id="partisipasi" name="partisipasi"
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-[#1e6aae] appearance-none">
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
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-[#1e6aae] appearance-none">
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
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>
                    <!-- Tanggal Berakhir -->
                    <div class="flex items-center space-x-4">
                        <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal
                            Berakhir</label>
                        <input type="date" id="tanggal_berakhir" name="tanggal_berakhir"
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Tanggal Pendaftaran -->
                    <div class="flex items-center space-x-4">
                        <label for="tenggat_pendaftaran" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tenggat
                            Pendaftaran</label>
                        <input type="date" id="tenggat_pendaftaran" name="tenggat_pendaftaran"
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="flex items-center space-x-4">
                        <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 w-50 mb-0">Jumlah
                            Peserta</label>
                        <input type="text" id="jumlah_peserta" name="jumlah_peserta"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- URL Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="url_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">URL Lomba</label>
                        <input type="text" id="url_lomba" name="url_lomba"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#1e6aae]">
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex items-center space-x-4">
                        <label for="deskripsi_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">Deskripsi
                            Singkat</label>
                        <textarea type="text" id="deskripsi_lomba" name="deskripsi_lomba"
                            class="flex-1 block border p-4 h-32 border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1e6aae]"
                            placeholder="Tuliskan deskripsi singkat mengenai lomba"></textarea>
                    </div>

                    <!-- Choose Browser -->
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">File Surat
                            Tugas</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">File
                            Sertifikat</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">File
                            Poster</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">Foto
                            Kegiatan</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class=" block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#1e6aae] file:mr-4 file:py-2 file:px-4  file:border-r-1 file:rounded-l-lg file:border-[#1e6aae]/8  file:text-xs file:font-semibold file:bg-white file:text-[#1e6aae] hover:file:bg-[#1e6aae]/8" />
                    </div>
                </form>
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
                                    <input type="text" name="nama_mahasiswa[]"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-2 border-r border-gray-300">
                                    <select name="peran_mahasiswa[]"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                        <option value="peserta">Peserta</option>
                                        <option value="ketua">Ketua</option>
                                        <option value="anggota">Anggota</option>
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

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const addMahasiswaButton = document.getElementById('addMahasiswa');
                    const mahasiswaTableBody = document.getElementById('mahasiswaTableBody');

                    addMahasiswaButton.addEventListener('click', function () {
                        const newRow = document.createElement('tr');
                        newRow.classList.add('bg-white', 'border-b', 'border-gray-300');

                        const rowCount = mahasiswaTableBody.children.length + 1;

                        newRow.innerHTML = `
                                          <td class="w-1/24 text-gray-900 px-6 py-2 border-r border-gray-300">
                                                         ${rowCount}
                                                    </td>
                                                    <td class="px-6 py-2 border-r border-gray-300">
                                                         <input type="text" name="nama_mahasiswa[]"
                                                              class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                                    </td>
                                                    <td class="px-6 py-2 border-r border-gray-300">
                                                         <select name="peran_mahasiswa[]"
                                                              class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                                              <option value="peserta">Peserta</option>
                                                              <option value="ketua">Ketua</option>
                                                              <option value="anggota">Anggota</option>
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

                        // Add event listener for the remove button
                        const removeButton = newRow.querySelector('.removeMahasiswa');
                        removeButton.addEventListener('click', function () {
                            newRow.remove();
                            updateRowNumbers();
                        });
                    });

                    mahasiswaTableBody.addEventListener('click', function (event) {
                        if (event.target.classList.contains('removeMahasiswa')) {
                            event.target.closest('tr').remove();
                            updateRowNumbers();
                        }
                    });

                    function updateRowNumbers() {
                        const rows = mahasiswaTableBody.querySelectorAll('tr');
                        rows.forEach((row, index) => {
                            row.querySelector('td:first-child').textContent = index + 1;
                        });
                    }
                });
            </script>

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
                                <td class="px-6 py-2 border-r border-gray-300">
                                    <input type="text" name="nama_dosen[]"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-2 border-r border-gray-300">
                                    <select name="peran_dosen[]"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                                        <option value="pembimbing">Pembimbing</option>
                                        <option value="penguji">Penguji</option>
                                        <option value="koordinator">Koordinator</option>
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

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const addDosenButton = document.getElementById('addDosen');
                    const dosenTableBody = document.getElementById('dosenTableBody');

                    addDosenButton.addEventListener('click', function () {
                        const newRow = document.createElement('tr');
                        newRow.classList.add('bg-white', 'border-b', 'border-gray-300');

                        const rowCount = dosenTableBody.children.length + 1;

                        newRow.innerHTML = `
                    <td class="w-1/24 text-gray-900 px-6 py-2 border-r border-gray-300">
                        ${rowCount}
                    </td>
                    <td class="px-6 py-2 border-r border-gray-300">
                        <input type="text" name="nama_dosen[]"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-2 border-r border-gray-300">
                        <select name="peran_dosen[]"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-gray-50 sm:text-xs focus:ring focus:ring-blue-500">
                            <option value="pembimbing">Pembimbing</option>
                            <option value="penguji">Penguji</option>
                            <option value="koordinator">Koordinator</option>
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
                `;

                        dosenTableBody.appendChild(newRow);

                        const removeButton = newRow.querySelector('.removeDosen');
                        removeButton.addEventListener('click', function () {
                            newRow.remove();
                            updateRowNumbers();
                        });
                    });

                    dosenTableBody.addEventListener('click', function (event) {
                        if (event.target.classList.contains('removeDosen')) {
                            event.target.closest('tr').remove();
                            updateRowNumbers();
                        }
                    });

                    function updateRowNumbers() {
                        const rows = dosenTableBody.querySelectorAll('tr');
                        rows.forEach((row, index) => {
                            row.querySelector('td:first-child').textContent = index + 1;
                        });
                    }
                });
            </script>


            <!-- Tombol Submit -->
            <div class="mt-8 text-right ">
                <a href="">
                    <button type="Cancel"
                        class="w-32 mr-2 bg-gray-300 text-gray-700 py-2 px-4 rounded-sm hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="w-32 bg-[#1e6aae] text-white py-2 px-4 rounded-sm hover:bg-[#17497C]  transition duration-200">
                        Submit
                    </button>
            </div>
        </div>
    </main>
@endsection