@extends('layout.template')

@section('content')
<main class="flex-1 px-6">
    <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg relative">
        <div class="mb-4 flex space-x-4 border-b border-gray-200">
            <button id="tab-tambah" data-tab="tambah"
                class="tab-btn text-sm font-medium py-2 px-3  border-b-4 text-[#1E6AAE] border-[#1E6AAE]" data-tab="tambah"
                type="button">
                Tambah Lomba
            </button>
            <a href="{{ route('mahasiswa.histori-tambah-lomba') }}">
                <button id="tab-histori"
                    class=" tab-btn text-sm font-medium py-2 px-3 border-b-4 text-gray-500 border-transparent hover:text-[#1E6AAE]"
                    data-tab="histori" type="button">
                    Riwayat Tambah Lomba
                </button>
            </a>
        </div>

        <div id="content-tambah" class="tab-content p-6">
            <h2 class="text-xl font-semibold mb-2">Tambah Lomba Baru</h2>
            <p class="text-sm text-gray-400">Lengkapi data prestasi yang telah kamu raih selama masa studi. Pastikan
                kamu
                mengunggah bukti yang valid seperti sertifikat atau surat keterangan resmi.</p>
            <div class="relative p-8 pt-14 mt-8 border border-gray-200 rounded-sm">
                <div class="absolute inset-x-0 top-0 h-10 w-full bg-[#1E6AAE] flex rounded-t-md items-center">
                    <span class="text-white font-medium pl-4">Data Lomba</span>
                </div>
                <form class="space-y-6" method="POST" action="{{ route('mahasiswa.store-lomba') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 w-50 mb-0">Nama Lomba</label>
                        <input type="text" id="nama" name="name"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <!-- Penyelenggara -->
                    <div class="flex items-center space-x-4">
                        <label for="organizer" class="block text-sm font-medium text-gray-700 w-50 mb-0">Penyelenggara</label>
                        <input type="text" id="organizer" name="organizer"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <!-- Tingkat Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="level" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tingkat Lomba</label>
                        <div class="relative">
                            <select id="level" name="level"
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none" required>
                                <option disabled selected hidden>Pilih Tingkat</option>
                                <option value="INTERNATIONAL">Internasional</option>
                                <option value="NATIONAL">Nasional</option>
                                <option value="PROVINCE">Provinsi</option>
                                <option value="CITY">Kota/Kabupaten</option>
                                <option value="INTERNAL">Internal</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <!-- Bidang Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 w-50 mb-0">Bidang Lomba</label>
                        <div class="relative">
                            <select id="category" name="category"
                                class="block w-64 text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none" required>
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
                        <label for="start_at" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal Mulai</label>
                        <input type="date" id="start_at" name="start_at"
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <!-- Tanggal Berakhir -->
                    <div class="flex items-center space-x-4">
                        <label for="end_at" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tanggal Berakhir</label>
                        <input type="date" id="end_at" name="end_at"
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <!-- Tanggal Pendaftaran -->
                    <div class="flex items-center space-x-4">
                        <label for="registration_deadline" class="block text-sm font-medium text-gray-700 w-50 mb-0">Tenggat Pendaftaran</label>
                        <input type="date" id="registration_deadline" name="registration_deadline"
                            class="w-64 block text-sm font-normal text-gray-700 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <!-- Jumlah Peserta -->
                    <div class="flex items-center space-x-4">
                        <label for="max_participation_amount" class="block text-sm font-medium text-gray-700 w-50 mb-0">Jumlah Peserta</label>
                        <input type="number" id="max_participation_amount" name="max_participation_amount"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" required>
                    </div>
                    <!-- URL Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="url" class="block text-sm font-medium text-gray-700 w-50 mb-0">URL Lomba</label>
                        <input type="url" id="url" name="url"
                            class="flex-1 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <!-- Deskripsi -->
                    <div class="flex items-center space-x-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 w-50 mb-0">Deskripsi Singkat</label>
                        <textarea id="description" name="description"
                            class="flex-1 block border p-4 h-32 border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Tuliskan deskripsi singkat mengenai lomba"></textarea>
                    </div>
                    <!-- Poster Lomba -->
                    <div class="flex items-center space-x-4">
                        <label for="poster" class="block text-sm font-medium text-gray-700 w-50 mb-0">Poster Lomba</label>
                        <input type="file" id="poster" name="poster" accept="image/*"
                            class="block w-full max-w-xs text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4  file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                    <!-- Tombol Submit -->
                    <div class="mt-8 text-right">
                        <button type="submit"
                            class="w-32 bg-[#1E6AAE] text-white py-2 px-2 rounded-sm hover:bg-[#17497C] transition duration-200">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
</main>


@endsection