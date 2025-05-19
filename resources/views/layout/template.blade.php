<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPRESTA')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css'])
</head>

<body>
    <!-- Navbar -->

        <!-- Header -->
        <header>
            <div class="container">
                @include('layout.header')
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
</body>

</html>