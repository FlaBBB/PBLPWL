@extends('layout.template')

@section('content')
<div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow border border-gray-200 p-6 space-y-6">
        <h2 class="text-xl font-semibold mb-2">Tambah Lomba Baru</h2>
        <p class="text-sm text-gray-600 mb-6">
            Lengkapi data prestasi yang telah kamu raih selama masa studi. Pastikan kamu mengunggah bukti yang valid seperti sertifikat atau surat keterangan resmi.
        </p>

        <form>
            <div style="background-color: #1E6AAE; color: white;" class="px-4 py-2 rounded-t-md font-semibold">Data Kompetisi</div>
                <div class="space-y-6 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lomba</label>
                    <input type="text" name="nama_lomba" placeholder="Input your nama lomba"
                           class="mt-1 block w-full font-normal text-gray-600 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tingkat Lomba</label>
                    <div class="relative">
                    <select id="partisipasi" name="partisipasi"
                           class="mt-1 block w-full font-normal text-gray-400 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                           <option disabled selected hidden>Pilih Tingkat</option>
                                <option>Internasional</option>
                                <option>Nasional</option>
                                <option>Provinsi</option>
                                <option>Kota/Kabupaten</option>
                                <option>Internal</option>
                            </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                    <input type="text" name="penyelenggara" placeholder="Input your kategori"
                           class="mt-1 block w-full font-normal text-gray-600 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Bidang Lomba (Tag)</label>
                    <input type="text" name="bidang_lomba" placeholder="Input your kategori"
                           class="mt-1 block w-full font-normal text-gray-600 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Lomba</label>
                        <input type="date" name="tanggal_mulai"
                               class="mt-1 block w-full font-normal text-gray-400 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Berakhir Lomba</label>
                        <input type="date" name="tanggal_berakhir"
                               class="mt-1 block w-full font-normal text-gray-400 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deadline Pendaftaran</label>
                    <input type="date" name="deadline"
                           class="mt-1 block w-full font-normal text-gray-400 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Peserta</label>
                    <input type="url" name="jumlah_peserta" placeholder="Input jumlah peserta"
                           class="mt-1 block w-full font-normal text-gray-600 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">URL Kompetisi</label>
                    <input type="url" name="url_kompetisi" placeholder="Input your kategori"
                           class="mt-1 block w-full font-normal text-gray-600 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" placeholder="Input deskripsi lomba..."
                              class="mt-1 block w-full font-normal text-gray-600 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100"></textarea>
                </div>

                <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Poster</label>

    <label for="poster" 
        class="mt-1 block w-full font-normal text-gray-600 border  border-gray-300 rounded-md shadow-sm p-2  focus:ring focus:ring-blue-100">
        <div class="text-center text-sm">
            Drag your certificate or 
            <span class="inline-block px-3 py-1 ml-2 bg-white border border-gray-300 rounded-md shadow-sm text-gray-700 text-sm hover:bg-gray-100">
                Browse
            </span>
        </div>
        <input id="poster" name="poster" type="file" accept=".jpg,.jpeg,.png,.pdf" class="hidden">
    </label>
</div>


                <div class="text-right">
                    <button type="submit"
                            class="w-32 bg-blue-500 text-white py-2 px-4 rounded-sm hover:bg-blue-700 transition duration-200">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection