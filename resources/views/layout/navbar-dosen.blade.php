@php
use App\Enums\UserRoleEnum;
$activeMenu = $activeMenu ?? '';
@endphp
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-white flex flex-col justify-between py-8 border-r-blue-200 border-r-2">

        <div>
            <div class="flex items-center justify-center mb-10">
                <img src="{{ asset('images/Logo-blue.svg') }}" alt="SIPRESTA Logo" class="h-8">
            </div>

            <nav class="flex flex-col gap-2">
                <!-- Dashboard -->
                <a href="{{ route('dosen.dashboard') }}"
                    class="flex items-center gap-3 pl-7 py-2 {{ ($activeMenu == 'dashboard') ? ' text-blue-700 font-semibold bg-blue-50 border-r-blue-500 border-r-3' : ' hover:bg-blue-50 transition text-gray-700' }} ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    Dashboard
                </a>

                <!-- Kelola Prestasi Dosen -->
                <a href="{{ route('dosen.verifikasi-prestasi') }}"
                    class="flex items-center gap-3 pl-7 py-2 {{ ($activeMenu == 'verifikasi-prestasi') ? ' text-blue-700 font-semibold bg-blue-50 border-r-blue-500 border-r-3' : ' hover:bg-blue-50 text-gray-700' }} ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                    Verifikasi Prestasi
                </a>
            </nav>
        </div>
        <div class="flex flex-col gap-5 ml-7 mb-5 mt-10 overflow-y-auto">
            <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-blue-600 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
                Contact us
            </a>
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-red-500 hover:text-red-700 text-sm font-semibold w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Log out
                </button>
            </form>
        </div>
    </aside>
</div>
