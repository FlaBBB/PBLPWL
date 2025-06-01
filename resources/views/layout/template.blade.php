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

<body class="bg-gray-50 min-h-screen">
@php
use App\Enums\UserRoleEnum;
@endphp
<section>
    <!-- Navbar -->
    <nav class="fixed lg:flex lg:flex-grow lg:justify-between lg:items-center overflow-y-auto">
        <div class="w-full h-screen">
            @auth
                @if(Auth::user()->role->value === UserRoleEnum::ADMIN->value)
                    @include('layout.navbar-admin')
                @elseif(Auth::user()->role->value === UserRoleEnum::MAHASISWA->value)
                    @include('layout.navbar-mahasiswa')
                @elseif(Auth::user()->role->value === UserRoleEnum::DOSEN->value)
                    @include('layout.navbar-dosen')
                @endif
            @endauth
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
     function toggleDropdown() {
    const dropdown = document.getElementById('dropdown');
    dropdown.classList.toggle('hidden');
  }

  // Optional: close dropdown when clicked outside
  document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('dropdown');
    const button = e.target.closest('button');
    if (!dropdown.contains(e.target) && !button) {
      dropdown.classList.add('hidden');
    }
  });
</script>
</body>

</html>
