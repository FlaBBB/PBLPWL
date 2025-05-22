<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPRESTA')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css'])
</head>

<body>

<section>
    <!-- Navbar -->
    <nav class="fixed lg:flex lg:flex-grow lg:justify-between lg:items-center overflow-y-auto">
        <div class="w-full h-screen">
            @include('layout.navbar')
        </div>
    </nav>
    <div class="flex-grow ml-64">
        <!-- Header -->
        <header>
            <div class="container">
                @include('layout.header')
            </div>
        </header>
    
        <main>
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
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
</body>

</html>