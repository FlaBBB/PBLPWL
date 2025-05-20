<nav class="w-full md:w-1/4 lg:w-1/5 bg-gray-100 h-auto md:h-screen shadow-lg flex flex-col">
    <div class="flex items-center justify-center py-6">
        <img src="{{ asset('images/Logo-Blue.svg') }}" alt="Logo" class="h-10 w-auto">
    </div>
    <ul class="flex flex-row md:flex-col gap-2 md:gap-4 pb-4 md:pb-0">
        <li>
            <a href="#" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 font-semibold transition">
                <!-- Rank Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
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
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition">
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
            <a href="#" class="flex items-center gap-2 hover:bg-gray-200 pl-10 py-2 transition">
                <!-- Checkout Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6m-6 0a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2m-6 0v2a2 2 0 002 2h2a2 2 0 002-2v-2" />
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