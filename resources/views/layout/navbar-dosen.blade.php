@php
$activeMenu = $activeMenu ?? '';
@endphp
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside
        x-data="{ openDropdown: '' }"
        x-init="() => {
            if (['daftar-lomba', 'tambah-lomba'].includes('{{ $activeMenu }}')) {
                openDropdown = 'lomba-group';
            }
        }"
        class="w-64 bg-white flex flex-col py-8 h-screen"
    >
        <div class="flex pl-10">
            <img src="{{ asset('images/Logo-blue.svg') }}" alt="SIPRESTA Logo" class="h-11">
        </div>
        <div class="flex flex-col justify-between h-screen border-r-[#E6EDFF] border-r-2">
            <div class="flex flex-col gap-2">
                <nav class="flex flex-col gap-2 mt-10">
                    <!-- Dashboard -->
                    <a href="{{ route('dosen.dashboard') }}"
                        class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 {{ ($activeMenu == 'dashboard') ? 'text-[#1E6AAE] font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        Dashboard
                    </a>
                    <!-- Manajemen Mahasiswa Bimbingan -->
                    <a href="{{ route('dosen.manajemen-mahasiswa') }}"
                        class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 {{ ($activeMenu == 'manajemen-mahasiswa') ? 'text-[#1E6AAE] font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Z" />
                        </svg>
                        <p class="w-25">
                            Mahasiswa Bimbingan
                            </p>
                    </a>
                    <!-- Dropdown: Kelola Lomba -->
                    <div>
                        <a href="#" @click.prevent="openDropdown = (openDropdown === 'lomba-group' ? '' : 'lomba-group')"
                            class="flex text-sm font-semibold items-center gap-3 pl-10 py-2 pr-3 {{ in_array($activeMenu, ['daftar-lomba','tambah-lomba']) ? 'text-[#1E6AAE] font-semibold bg-blue-50 border-r-[#1E6AAE] border-r-3' : 'hover:bg-blue-50 transition text-[#7C8DB5]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                            </svg>
                            Kelola Lomba
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 ml-auto mr-2 transition-transform duration-200"
                                :class="openDropdown === 'lomba-group' ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>
                        <div x-show="openDropdown === 'lomba-group'" x-transition class="ml-10 my-3 flex flex-col gap-3">
                            <a href="{{ route('dosen.daftar-lomba') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'daftar-lomba' ? 'text-[#1E6AAE] font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                Daftar Lomba
                            </a>
                            <a href="{{ route('dosen.tambah-lomba') }}"
                                class="px-3 py-1 rounded-l-2xl {{ $activeMenu == 'tambah-lomba' ? 'text-[#1E6AAE] font-medium hover:bg-blue-50 transition border-r-[#1E6AAE] border-r-3' : 'text-[#7C8DB5] font-medium text-sm hover:bg-blue-50 transition' }}">
                                Tambah Lomba Baru
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="flex flex-col gap-5 ml-10 mt-10">
                <a href="#" class="flex font-semibold items-center gap-2 text-gray-400 hover:text-blue-600 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                    Contact us
                </a>
                <a href="#" class="flex font-semibold items-center gap-2 text-red-500 hover:text-red-700 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Log out
                </a>
            </div>
        </div>
    </aside>
</div>