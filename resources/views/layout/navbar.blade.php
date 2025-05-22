@php
    $activeMenu = $activeMenu ?? '';
@endphp
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-navbar flex flex-col justify-between py-8">
        <div>
            <div class="flex items-center justify-center mb-10">
                <img src="{{ asset('images/Logo-blue.svg') }}" alt="SIPRESTA Logo" class="h-8">
            </div>
            <nav class="flex flex-col gap-2">
                <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-4 py-2 {{ ($activeMenu == 'dashboard') ? ' text-blue-700 font-semibold bg-blue-50' : ' hover:bg-blue-50 text-gray-700' }} ">
                    Dashboard
                </a>
                <div>
                    <a href="{{ url('/prestasi') }}"
                        class="flex items-center gap-3 px-4 py-2 {{ ($activeMenu == 'prestasi') ? ' text-blue-700 font-semibold bg-blue-50' : ' hover:bg-blue-50 text-gray-700' }} ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        Prestasi
                        <!-- Chevron Icon -->
                        @if($activeMenu == 'prestasi')
                            <!-- Chevron Up Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 ml-auto">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        @else
                            <!-- Chevron Down Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 ml-auto">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        @endif
                    </a>
                    @if($activeMenu == 'prestasi')
                        <div class="ml-10 mt-1 flex flex-col gap-1">
                            <a href="{{ url('/prestasi') }}"
                                class="px-3 py-1 rounded text-blue-700 bg-blue-100 font-medium text-sm hover:bg-blue-200 transition">
                                Daftar Prestasi
                            </a>
                            <a href="{{ url('/prestasi/tambah') }}"
                                class="px-3 py-1 rounded text-gray-600 font-medium text-sm hover:bg-gray-100 transition">
                                Tambah Prestasi Baru
                            </a>
                        </div>
                    @endif
                </div>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-2 {{ ($activeMenu == 'lomba') ? ' text-blue-700 font-semibold' : ' hover:bg-blue-50 text-gray-700' }} relative ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                    </svg>
                    Lomba
                    <span class="absolute right-4 top-3 bg-red-500 text-white text-xs rounded-full px-2">2</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-2 {{ ($activeMenu == 'laporan') ? ' text-blue-700 font-semibold' : ' hover:bg-blue-50 text-gray-700' }} ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    Laporan
                </a>
            </nav>
        </div>
        <div class="flex flex-col gap-2 ml-4">
            <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-blue-600 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
                Contact us
            </a>
            <a href="#" class="flex items-center gap-2 text-red-500 hover:text-red-700 text-sm font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>

                Log out
            </a>
        </div>
    </aside>
</div>