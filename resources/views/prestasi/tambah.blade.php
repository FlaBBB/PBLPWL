@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Tambah Prestasi Baru</h2>
            <p class="text-sm text-gray-400">Lengkapi data prestasi yang telah kamu raih selama masa studi. Pastikan kamu
                mengunggah bukti yang valid seperti sertifikat atau surat keterangan resmi.</p>

            <div class="relative p-8 pt-14 mt-4 border border-gray-200 rounded-sm">
                <div class="absolute inset-x-0 top-0 h-10 w-full bg-blue-500 flex rounded-t-md items-center">
                    <span class="text-white font-medium pl-4">Data Kompetisi</span>
                </div>
                <form class="space-y-6">
                    <!-- Nama Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lomba</label>
                        <input type="text" id="nama" name="nama"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Penyelenggara -->
                    <div class="flex items-center space-x-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 w-50 mb-0">Penyelenggara</label>
                        <input type="text" id="nama" name="nama"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Tingkat Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="partisipasi" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tingkat
                            Lomba</label>
                        <div class="relative">
                            <select id="partisipasi" name="partisipasi"
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
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
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
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
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <!-- Tanggal Berakhir -->
                    <div class="flex items-center space-x-4">
                        <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal
                            Berakhir</label>
                        <input type="date" id="tanggal_berakhir" name="tanggal_berakhir"
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Tanggal Pendaftaran -->
                    <div class="flex items-center space-x-4">
                        <label for="tenggat_pendaftaran" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tenggat
                            Pendaftaran</label>
                        <input type="date" id="tenggat_pendaftaran" name="tenggat_pendaftaran"
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="flex items-center space-x-4">
                        <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 w-50 mb-0">Jumlah
                            Peserta</label>
                        <input type="text" id="jumlah_peserta" name="jumlah_peserta"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- URL Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="url_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">URL Lomba</label>
                        <input type="text" id="url_lomba" name="url_lomba"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex items-center space-x-4">
                        <label for="deskripsi_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">Deskripsi
                            Singkat</label>
                        <textarea type="text" id="deskripsi_lomba" name="deskripsi_lomba"
                            class="flex-1 block border p-4 h-32 border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Tuliskan deskripsi singkat mengenai lomba"></textarea>
                    </div>

                    <!-- Choose Browser -->
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">File Surat
                            Tugas</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class="block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4  file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">File
                            Sertifikat</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class="block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4  file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">File
                            Poster</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class="block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4  file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <label for="poster_lomba" class="block text-sm font-medium text-gray-700 w-50 mb-0">Foto
                            Kegiatan</label>
                        <input type="file" id="poster_lomba" name="poster_lomba" accept="image/*"
                            class="block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4  file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>

                    <!-- Data Dosen -->
                    

                    <!-- Tombol Submit -->
                    <div class="mt-8 text-right">
                        <button type="submit"
                            class="w-32 bg-blue-500 text-white py-2 px-4 rounded-sm hover:bg-blue-700 transition duration-200">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
@endsection