@php
use App\Enums\UserRoleEnum;
@endphp
<header class="flex-1 px-10 pt-5 sticky top-0 z-20 bg-white" style="margin-top:0;">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">
                {{ $headerTitle ?? 'Welcome Back, ' . Auth::user()->name . ' 👋' }}
            </h1>
            @if(!empty($headerDesc) || !isset($headerTitle))
            <p class="text-gray-400 mt-1">
                {{ $headerDesc ?? 'The description will appeared if you are login' }}
            </p>
            @endif
        </div>
        <div class="flex items-center gap-6">
            <a href="#" class="relative">
                <svg class="w-6 h-6 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 7.165 6 9.388 6 12v2.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>

            <div x-data="{ isOpen: false }" class="relative">
                <a
                    @click="isOpen = !isOpen"
                    @keydown.escape.window="isOpen = false"
                    class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-gray-100 focus:outline-none focus:ring focus:ring-[#1e6aae] transition-colors duration-150">
                    <img src="{{ Auth::user()->photo_profile ? asset(Auth::user()->photo_profile) : asset('images/user-avatar.jpg') }}" alt="User" class="w-9 h-9 rounded-full object-cover">
                    <!-- <span class="font-semibold text-gray-700 hidden sm:inline max-w-[150px] truncate">P</span> -->
                    <svg
                        class="w-4 h-4 text-gray-400 transition-transform duration-200 ease-in-out"
                        :class="{'rotate-180': isOpen}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <div
                    x-show="isOpen"
                    @click.away="isOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg py-1 ring ring-gray-300 ring-opacity-5 focus:outline-none z-50"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu-button">
                    @if(Auth::user()->role === UserRoleEnum::MAHASISWA)
                    <a href="{{ route('mahasiswa.edit-profile') }}" class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                        Edit Profil
                    </a>
                    @elseif(Auth::user()->role === UserRoleEnum::ADMIN)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                        Edit Profil
                    </a>
                    @elseif(Auth::user()->role === UserRoleEnum::DOSEN)
                    <a href="{{ route('dosen.profil-dosen') }}" class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                        Edit Profil
                    </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>