<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - SIPRESTA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<section class="flex flex-row gap-4 w-full justify-between items-center">

    <div class="w-100 p-8 items-center">
        <h3 class="mb-6 text-2xl font-bold text-center text-gray-800">Login</h3>
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email address</label>
                <input type="email"
                       class="w-full px-3 py-2 border @error('email') rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       required autofocus>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2">Password</label>
                <input type="password"
                       class="w-full px-3 py-2 border @error('password') rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                       id="password"
                       name="password"
                       required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded" id="remember" name="remember">
                <label class="ml-2 block text-gray-700" for="remember">Remember Me</label>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-150">Login</button>
        </form>
        <div class="mt-4 text-center">
            <a href="" class="text-blue-600 hover:underline">Forgot Your Password?</a>
        </div>
    </div>

    <div class="w-full h-auto flex items-center justify-end">
        <img src="{{ asset(url('images/log-image.svg')) }}" alt="" class="w-[55%] h-auto">
    </div>
</section>
</body>
</html>