<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPRESTA')</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="flex flex-row">
        <div class="w-1/4">
            @include('template.navbar')
        </div>
    
        <div class="">
            @include('template.header')
        </div>
    </div>

    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>