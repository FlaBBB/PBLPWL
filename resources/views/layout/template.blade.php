<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPRESTA')</title>
    <link rel="icon" href="{{ asset('images/icon.svg') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-white min-h-screen mb-12">
    @php
    use App\Enums\UserRoleEnum;
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    @endphp
    <!-- Sidebar/Navbar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white z-20 overflow-y-auto hidden lg:block">
        @auth
        @if(Auth::user()->role->value === UserRoleEnum::ADMIN->value)
        @include('layout.navbar-admin')
        @elseif(Auth::user()->role->value === UserRoleEnum::MAHASISWA->value)
        @include('layout.navbar-mahasiswa')
        @elseif(Auth::user()->role->value === UserRoleEnum::DOSEN->value)
        @include('layout.navbar-dosen')
        @endif
        @endauth
    </aside>

    <!-- Main Content -->
    <div class="bg-white lg:ml-64">
        <!-- Header -->
        <header class="sticky top-0 z-20 bg-white">
            <div class="container mx-auto px-6 py-4">
                @include('layout.header')
            </div>
        </header>

        <!-- Breadcrumb -->
        <div class="container mx-auto px-6 mt-2">
            @include('layout.breadcrumb')
        </div>

        <!-- Main -->
        <main class="container mx-auto px-6 bg-white">
            @yield('content')
        </main>
    </div>

    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    @stack('scripts')
    @include('components.notyf')
</body>

</html>