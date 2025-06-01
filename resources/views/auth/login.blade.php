<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - SIPRESTA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
</head>


<body class="bg-gray-50 min-h-screen flex items-center justify-between">
    <div class="w-screen flex flex-col md:flex-row justify-between">
        <!-- Left Side -->
        <div class="w-full md:w-1/2 flex flex-col items-start pl-10 ">
            <img src="{{ asset('images/Logo-Blue.svg') }}" alt="SIPRESTA Logo" class="h-10 items-start mt-10">
            <div class="w-full max-w-md mx-auto mt-10 p-8 ">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back!</h2>
                    <p class="text-gray-500 mb-8">Enter your username and password to access your account</p>
                </div>
                <form action="" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">NIM / NIDN /
                            NIP</label>
                        <input type="username" name="username" id="username" required autofocus
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Input your NIM / NIDN / NIP ">
                    </div>
                    <div class="relative">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"
                            placeholder="Input your password">
                        <button type="button" onclick="togglePassword()"
                            class="right-0 flex items-center px-3 text-gray-500">
                            <button type="button" onclick="togglePassword()" tabindex="-1"
                                class="absolute right-4 top-9 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-3.582 7-8 7s-8-3.134-8-7 3.582-7 8-7 8 3.134 8 7z" />
                                </svg>
                            </button>
                        </button>
                    </div>
                    <div class="flex justify-end mt-1">
                        <a href="#" class="text-xs text-blue-600 hover:underline">Forgot your password?</a>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200">Login</button>
                </form>
            </div>
            <div class="w-full flex justify-between items-center mt-30 text-xs text-gray-400">
                <span>Copyright &copy;2025 Kelompok 2 Enterprise</span>
                <a href="#" class="hover:underline">Privacy Policy</a>
            </div>
        </div>
        <!-- Right Side -->
        <div class="hidden md:flex w-130 relative">
            <div class="relative flex flex-col items-right justify-end w-full right-0">
                <img src="{{ asset('images/log-image.svg') }}" alt="Login Illustration" class="w-screen">
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.418 0-8-3.134-8-7a6.978 6.978 0 012.092-4.908m1.414-1.414A9.956 9.956 0 0112 5c4.418 0 8 3.134 8 7 0 1.306-.417 2.527-1.125 3.537M15 12a3 3 0 11-6 0 3 3 0 016 0zm-6.364 6.364l12-12" />`;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-3.582 7-8 7s-8-3.134-8-7 3.582-7 8-7 8 3.134 8 7z" />`;
        }
    }
</script>