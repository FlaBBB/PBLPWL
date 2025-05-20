<nav class="w-full md:w-1/4 lg:w-1/5 bg-gray-100 h-auto md:h-screen shadow-lg flex flex-col">
    <div class="flex items-center pl-10 py-6">
        <img src="{{ asset('images/Logo-Blue.svg') }}" alt="Logo" class="h-10 w-auto">
    </div>
    <ul class="flex flex-row md:flex-col gap-2 md:gap-4 pb-4 md:pb-0">
        <li>
            <a href="overviewMahasiswa"
                class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition text-blue-600 font-semibold">
                <!-- Rank Icon -->
                <svg class="w-5 h-5 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4.5V19a1  1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207" />
                </svg>
                Overview
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition">
                <!-- Bookmark Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                </svg>
                Prestasi
                <svg class="w-4 h-4 text-gray-500 ml-20" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
        </li>
        <li>
            <a href="lomba" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition">
                <!-- Trophy Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 21h8M12 17v4m0-4a7 7 0 01-7-7V5a2 2 0 012-2h10a2 2 0 012 2v5a7 7 0 01-7 7z" />
                </svg>
                Lomba
            </a>
        </li>
        <li>
            <a href="laporan" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition text-[#7c8db5]">
                <!-- Checkout Icon -->
                <svg class="w-5 h-5 text-[#7c8db5]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7h1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h11.5M7 14h6m-6 3h6m0-10h.5m-.5 3h.5M7 7h3v3H7V7Z" />
                </svg>
                Laporan
            </a>
        </li>
    </ul>
    <div class="mt-auto">
        <ul class="flex flex-row md:flex-col gap-2 md:gap-4 pb-4 md:pb-0">
            <li>
                <a href="#" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition">
                    <!-- Chat Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 21l1.8-4A8.96 8.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Contact Us
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition text-red-600">
                    <!-- Logout/Exit Icon (Red) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>