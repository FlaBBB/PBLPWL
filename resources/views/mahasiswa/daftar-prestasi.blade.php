@extends('layout.template')

@section('content')
    <div class="flex">
        {{-- Sidebar --}}
        @include('layout.navbarmahasiswa')
        <div class="flex-grow">
            <div class="flex justify-between items-center mt-4 mb-4">
                <h1 class="text-2xl font-bold">Prestasi</h1>
                <div class="flex items-center gap-4">
                    <!-- Icon Notif -->
                    <button class="relative focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <!-- Profile & Name -->
                    <div class="flex items-center gap-2">
                        <img src="https://ui-avatars.com/api/?name=Luthfi+Angga" alt="Profile"
                            class="w-8 h-8 rounded-full object-cover">
                        <span class="font-medium text-gray-700">Luthfi Angga</span>
                        <!-- Angle Down Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            {{-- Main Content --}}
            <div class="mx-auto mt-[120px] mb-10 w-full" style="max-width:100vw; margin-left:50px; margin-right:30px;">
                <div class="border border-gray-200 rounded-[10px] p-5 flex flex-col gap-6" style="min-height:500px;">
                    <h2 class="text-xl font-semibold mb-2">Daftar Prestasi Mahasiswa</h2>
                    <p class="text-gray-400">Lihat dan pantau seluruh prestasi yang telah Anda unggah selama masa studi.
                        Pastikan setiap prestasi disertai bukti sah seperti sertifikat atau surat keterangan resmi.</p>
                </div>
            </div>
        </div>
@endsection