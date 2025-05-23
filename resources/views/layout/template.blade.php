<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPRESTA')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50 min-h-screen">

    <!-- Sidebar/Navbar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-20 overflow-y-auto hidden lg:block">
        @include('layout.navbar-admin')
    </aside>

    <!-- Main Content -->
    <div class="bg-white lg:ml-64">
        <!-- Header -->
        <header class="">
            <div class="container mx-auto px-6 py-4">
                @include('layout.header')
            </div>
        </header>

        <!-- Breadcrumb -->
        <div class="container mx-auto px-6 mt-2 pb-2">
            @include('layout.breadcrumb')
        </div>

        <!-- Main -->
        <main class="container mx-auto px-6">
            @yield('content')
        </main>
    </div>
<<<<<<< HEAD
</section>

<script>
    let activeDropdown = null;
    let activeChevron = null;

    function toggleDropdown(dropdownId, chevronId){
        const dropdown = document.getElementById(dropdownId);
        const chevron = document.getElementById(chevronId);

        // If another dropdown is open, close it
        if (activeDropdown && activeDropdown !== dropdown) {
            activeDropdown.classList.add('hidden');
            if (activeChevron) {
                activeChevron.style.transform = 'rotate(0deg)';
            }
        }

        // Toggle current dropdown
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            chevron.style.transform = 'rotate(180deg)';
            activeDropdown = dropdown;
            activeChevron = chevron;
        } else {
            dropdown.classList.add('hidden');
            chevron.style.transform = 'rotate(0deg)';
            activeDropdown = null;
            activeChevron = null;
        }
    }
</script>
=======

>>>>>>> f7ed2d99cafe0514b21365ae177e10ea8b7803c2
</body>

</html>