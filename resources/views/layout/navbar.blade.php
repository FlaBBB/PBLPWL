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
                    dashboard
                </a>
                <a href="{{ url('/prestasi') }}" class="flex items-center gap-3 px-4 py-2 {{ ($activeMenu == 'prestasi') ? ' text-blue-700 font-semibold bg-blue-50' : ' hover:bg-blue-50 text-gray-700' }} ">
                    Prestasi
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 {{ ($activeMenu == 'lomba') ? ' text-blue-700 font-semibold' : ' hover:bg-blue-50 text-gray-700' }} relative ">
                    Lomba
                    <span class="absolute right-4 top-3 bg-red-500 text-white text-xs rounded-full px-2">2</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 {{ ($activeMenu == 'laporan') ? ' text-blue-700 font-semibold' : ' hover:bg-blue-50 text-gray-700' }} ">
                    Laporan
                </a>
            </nav>
        </div>
        <div class="flex flex-col gap-2 ml-4">
            <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-blue-600 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Contact us
            </a>
            <a href="#" class="flex items-center gap-2 text-red-500 hover:text-red-700 text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Log out
            </a>
        </div>
    </aside>
</div>