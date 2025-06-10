@php
    $activeMenu = $activeMenu ?? '';
@endphp
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside x-data="{ openDropdown: '' }" x-init="() => {
    if (['kelola-mahasiswa', 'kelola-dosen', 'kelola-admin'].includes('{{ $activeMenu }}')) {
        openDropdown = 'kelola-mahasiswa-group';
    } else if (['verifikasi-achievement', 'daftar-achievement'].includes('{{ $activeMenu }}')) {
        openDropdown = 'kelola-achievement-group';
    } else if (['tambah-lomba', 'daftar-lomba', 'verifikasi-lomba'].includes('{{ $activeMenu }}')) {
        openDropdown = 'kelola-lomba-group';
    } else if (['program-studi', 'periode'].includes('{{ $activeMenu }}')) {
        openDropdown = 'kelola-akademik-group';
    } else if (['rekomendasi-vikor', 'rekomendasi-smart'].includes('{{ $activeMenu }}')) {
        openDropdown = 'rekomendasi-group';
    }
}" class="w-64 bg-white flex flex-col py-8 h-screen">
        <div class="flex pl-10">
            <img src="{{ asset('images/Logo-Blue.svg') }}" alt="SIPRESTA Logo" class="h-11">
        </div>
        <div class="flex flex-col justify-between h-screen border-r-[#E6EDFF] border-r-2">
            <div class="flex flex-col gap-2">
                <nav class="flex flex-col gap-2 mt-10">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 {{ ($activeMenu == 'dashboard') ? ' text-[#1E6AAE] font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }} ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        Dashboard
                    </a>
                    <!-- Dropdown 1: Kelola mahasiswa -->
                    <div>
                        <a href="#"
                            @click.prevent="openDropdown = (openDropdown === 'kelola-pengguna-group' ? '' : 'kelola-pengguna-group')"
                            class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 pr-3 {{ in_array($activeMenu, ['kelola-mahasiswa', 'kelola-dosen', 'kelola-admin']) ? 'text-[#1E6AAE] font-semibold bg-blue-50 border-r-[#1E6AAE] border-r-3' : 'hover:bg-blue-50 transition text-[#7C8DB5]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            Kelola Pengguna
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 ml-auto mr-2 transition-transform duration-200"
                                :class="openDropdown === 'kelola-pengguna-group' ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>

                        </a>
                        <div x-show="openDropdown === 'kelola-pengguna-group'" x-transition
                            class="ml-10 my-3 flex flex-col gap-3">
                            <a href="{{ route('admin.kelola-mahasiswa') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'kelola-mahasiswa' ? 'text-[#1E6AAE] text-sm font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] text-sm font-medium hover:bg-blue-50 transition' }}">
                                Mahasiswa
                            </a>
                            <a href="{{ route('admin.kelola-dosen') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'kelola-dosen' ? 'text-[#1E6AAE] text-sm font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] text-sm font-medium hover:bg-blue-50 transition' }}">
                                Dosen
                            </a>
                            <a href="{{ route('admin.kelola-admin') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'kelola-admin' ? 'text-[#1E6AAE] text-sm font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] text-sm font-medium hover:bg-blue-50 transition' }}">
                                Admin
                            </a>
                        </div>
                    </div>
                    <!-- Dropdown 2: Kelola Prestasi -->
                    <div>
                        <a href="#"
                            @click.prevent="openDropdown = (openDropdown === 'kelola-achievement-group' ? '' : 'kelola-achievement-group')"
                            class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 pr-3 {{ in_array($activeMenu, ['verifikasi-achievement', 'daftar-achievement']) ? 'text-[#1E6AAE] font-semibold bg-blue-50 border-r-[#1E6AAE] border-r-3' : 'hover:bg-blue-50 transition text-[#7C8DB5]' }}">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                             </svg>
                             Kelola Prestasi
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor" class="size-4 ml-auto mr-2 transition-transform duration-200"
                                 :class="openDropdown === 'kelola-achievement-group' ? 'rotate-180' : ''">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                             </svg>
                         </a>
                         <div x-show="openDropdown === 'kelola-achievement-group'" x-transition
                             class="ml-10 my-3 flex flex-col gap-3">
                             <a href="{{ route('admin.verifikasi-achievement') }}"
                                 class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'verifikasi-achievement' ? 'text-[#1E6AAE] text-sm font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                 Verifikasi Prestasi
                             </a>
                             <a href="{{ route('admin.daftar-achievement') }}"
                                 class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'daftar-achievement' ? 'text-[#1E6AAE] text-sm font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                 Daftar Prestasi
                             </a>
                         </div>
                    </div>
                    <!-- Dropdown 3: Kelola Lomba -->
                    <div>
                        <a href="#"
                            @click.prevent="openDropdown = (openDropdown === 'kelola-lomba-group' ? '' : 'kelola-lomba-group')"
                            class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 pr-3 {{ in_array($activeMenu, ['daftar-lomba', 'tambah-lomba']) ? 'text-[#1E6AAE] font-semibold bg-blue-50 border-r-[#1E6AAE] border-r-3' : 'hover:bg-blue-50 transition text-[#7C8DB5]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                            </svg>
                            Kelola Lomba
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 ml-auto mr-2 transition-transform duration-200"
                                :class="openDropdown === 'kelola-lomba-group' ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>
                        <div x-show="openDropdown === 'kelola-lomba-group'" x-transition
                            class="ml-10 my-3 flex flex-col gap-3">
                            <a href="{{ route('admin.verifikasi-lomba') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'verifikasi-lomba' ? 'text-[#1E6AAE] font-medium text-sm  hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                Verifikasi Lomba
                            </a>
                            <a href="{{ route('admin.daftar-lomba') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'daftar-lomba' ? 'text-[#1E6AAE] font-medium text-sm hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                Daftar Lomba
                            </a>
                        </div>
                    </div>
                    <!-- Menu Laporan -->
                    <a href="{{ route('admin.laporan') }}"
                        class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 {{ ($activeMenu == 'laporan') ? ' text-[#1E6AAE] font-semibold bg-blue-50 border-r-[#1E6AAE] border-r-3' : ' hover:bg-blue-50 text-[#7C8DB5]' }} ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                        Laporan
                    </a>
                    <!-- Menu Rekomendasi -->
                    <!-- Menu Rekomendasi -->
                    <div>
                        <a href="#"
                            @click.prevent="openDropdown = (openDropdown === 'rekomendasi-group' ? '' : 'rekomendasi-group')"
                            class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 pr-3 {{ in_array($activeMenu, ['rekomendasi-vikor', 'rekomendasi-smart']) ? 'text-[#1E6AAE] font-semibold bg-blue-50 border-r-[#1E6AAE] border-r-3' : 'hover:bg-blue-50 transition text-[#7C8DB5]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                            </svg>
                            Rekomendasi
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 ml-auto mr-2 transition-transform duration-200"
                                :class="openDropdown === 'rekomendasi-group' ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>
                        <div x-show="openDropdown === 'rekomendasi-group'" x-transition
                            class="ml-10 my-3 flex flex-col gap-3">
                            <a href="{{ route('admin.rekomendasi-vikor') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'rekomendasi-vikor' ? 'text-[#1E6AAE] font-medium text-sm  hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                Rekomendasi VIKOR
                            </a>
                            <a href="{{ route('admin.rekomendasi-smart') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'rekomendasi-smart' ? 'text-[#1E6AAE] font-medium text-sm  hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                Rekomendasi SMART
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="flex flex-col gap-5 ml-10 mt-10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex font-semibold items-center cursor-pointer gap-2 text-red-500 hover:text-red-700 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        Log out
                    </button>
            </div>
        </div>
    </aside>
</div>