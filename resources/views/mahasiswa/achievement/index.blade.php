@extends('layout.template')

@section('content')
    <main class="flex-1">
        <div class="fixed"
            style="width:1260px; min-height:590px; top:100px; left:295px; border-radius:10px; border:1px solid #d1d5db; padding:40px; gap:24px;">
            <h2 class="text-xl font-bold mb-4">Daftar Achievement</h2>
            <p class="text-gray-400">Lihat dan pantau seluruh achievement yang telah Anda unggah selama masa studi.
                Pastikan setiap achievement disertai bukti sah seperti sertifikat atau surat keterangan resmi.</p>
            <table class="w-full text-left text-sm bg-white rounded-lg overflow-hidden">
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
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-2 px-3">1</td>
                        <td class="py-2 px-3">GEMASTIK</td>
                        <td class="py-2 px-3">Puspresnas</td>
                        <td class="py-2 px-3">25 Agustus 2021</td>
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td>             
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-2 px-3">2</td>
                        <td class="py-2 px-3">Hackathon Merdeka</td>
                        <td class="py-2 px-3">Institut Merdeka</td>
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td> 
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-3">3</td>
                        <td class="py-2 px-3">IoT Competition</td>
                        <td class="py-2 px-3">Kementerian Pendidikan</td>
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        <td class="py-2 px-3">11 Januari 2022</td> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection