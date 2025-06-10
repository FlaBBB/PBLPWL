<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - SIPRESTA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/icon.svg') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
    <!-- Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

</head>



<body class="bg-gray-50 min-h-screen  flex flex-col">
    <div class="w-screen flex flex-col md:flex-row flex-grow">
        <!-- Left Side -->
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center p-4 md:p-10">
            <img src="{{ asset('images/Logo-Blue.svg') }}" alt="SIPRESTA Logo"
                class="h-10 mb-10 self-start md:self-auto">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back!</h2>
                    <p class="text-gray-500 mb-8">Enter your username and password to access your account</p>
                </div>
                <!-- @if(session('error') || $errors->has('error') || $errors->has('email'))
                    <div id="login-error"
                        class="fixed inset-0 flex items-center justify-center z-50 transition-opacity duration-500 opacity-0"
                        style="background: rgba(0,0,0,0.2);">
                        <div
                            class="bg-red-100 border border-red-400 text-red-700 px-8 py-4 rounded shadow-lg text-center max-w-md w-full">
                            <span class="font-semibold text-lg">Login Gagal</span>
                            <div class="mt-2">
                                {{ session('error') ?? $errors->first('error') ?? $errors->first('email') }}
                            </div>
                        </div>
                    </div>
                @endif -->
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
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=siprestajti@gmail.com&su=Lupa%20Password%20SIPRESTA&body=Halo%20Admin%2C%20saya%20lupa%20password%20akun%20SIPRESTA%20saya.%20Mohon%20bantuannya%20untuk%20reset%20password.%0ANama%3A%20%0AUsername%3A%20%0A"
                            target="_blank" rel="noopener noreferrer"
                            class="text-xs text-[#1e6aae] hover:underline relative group cursor-pointer">
                            Forgot your password?
                            <span
                                class="absolute left-full top-1/2 -translate-y-1/2 ml-2 w-56 px-3 py-2 bg-gray-900 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 group-hover:visible invisible transition-opacity duration-200 z-20 pointer-events-none">
                                Anda akan diarahkan ke email untuk mengirim pesan permintaan reset password.
                            </span>
                        </a>
                    </div>
                    <button type="submit"
                        class="w-full bg-[#1E6AAE] text-white font-semibold py-2 rounded-md hover:bg-[#17497C] transition duration-200">Login</button>
                </form>
            </div>
            {{-- <div class="w-full flex justify-between items-center mt-30 text-xs text-gray-400">
                <span>Copyright &copy;2025 Kelompok 2 Enterprise</span>
                <a href="#" class="hover:underline">Privacy Policy</a>
            </div> --}}
        </div>
        <!-- Right Side -->
        <div
            class="hidden md:flex md:w-1/2 relative justify-center items-center overflow-hidden bg-gradient-to-br from-[#0C2C48] to-[#1E6AAE]">
            <div
                class="absolute top-0 left-0 w-64 h-64 bg-sky-400/10 rounded-full -translate-x-1/3 -translate-y-1/3 blur-2xl z-[2]">
            </div>
            <div
                class="absolute bottom-0 right-0 w-72 h-72 bg-blue-500/10 rounded-tl-full translate-x-1/4 translate-y-1/4 blur-2xl z-[2]">
            </div>
            <div class="absolute inset-x-1/4 top-10 h-32 bg-white/5 rounded-full blur-xl z-[2]"></div>
            <div
                class="absolute top-1/4 right-1/4 w-48 h-48 bg-cyan-400/8 rounded-full translate-x-1/2 -translate-y-1/2 blur-xl z-[2]">
            </div>
            <div
                class="absolute bottom-1/3 left-1/4 w-56 h-56 bg-indigo-400/12 rounded-full -translate-x-1/2 translate-y-1/3 blur-2xl z-[2]">
            </div>
            <div class="absolute inset-y-1/2 right-10 w-24 h-40 bg-white/8 rounded-full blur-lg z-[2]"></div>


            <div class="relative z-20 flex flex-col items-center text-left max-w-xl">
                <div id="animated-group" class="transition-all duration-700 group">
                    <div
                        class="relative z-30 transition-transform duration-700 group-[.is-active]:-translate-y-4 group-[.is-active]:scale-105">
                        <h6 class="text-sm font-bold text-white leading-relax">SIPRESTA</h6>

                        <h1 class="text-5xl font-bold text-white leading-tight">
                            Prestasi Tercatat,
                        </h1>

                        <div class="relative h-[4rem] overflow-hidden">
                            <h1
                                class="text-5xl font-base text-white leading-tight absolute inset-0 transition-all duration-700 transform group-[.is-active]:-translate-y-full group-[.is-active]:opacity-0 group-[.is-active]:scale-110">
                                Peluang Mendekat.
                            </h1>
                            <h1
                                class="text-5xl font-bold bg-gradient-to-r from-yellow-200 to-yellow-300 via-yellow-100 bg-clip-text text-transparent leading-tight absolute inset-0 transform translate-y-full opacity-0 transition-all duration-700 group-[.is-active]:translate-y-0 group-[.is-active]:opacity-100">
                                Mimpi Didapat!
                            </h1>
                        </div>
                    </div>

                    <div id="img-content"
                        class="-mt-16 opacity-0 invisible max-h-0 group-[.is-active]:opacity-100 group-[.is-active]:visible group-[.is-active]:max-h-120 transition-all duration-700 ease-in-out">

                        <img id="animated-image" src="{{ asset('images/login-asset.svg') }}" alt="Mahasiswa Berprestasi"
                            class="w-full max-w-xl object-contain transition-transform duration-700 hover:scale-110 hover:-rotate-1">

                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
    // Ambil elemen kontainer utama DAN elemen gambar
    const animatedGroup = document.getElementById('animated-group');
    const animatedImage = document.getElementById('animated-image');

    // Fungsi untuk menjalankan seluruh sekuens animasi
    function playAnimation() {
        // --- TAHAP 1: Animasi Utama Dimulai ---
        // Tambahkan class 'is-active' untuk memulai animasi slide & fade-in gambar.
        animatedGroup.classList.add('is-active');

        // --- TAHAP 2: Rotasi Gambar Dimulai (Setelah animasi utama selesai) ---
        // Setelah 1 detik (1000ms), gambar diasumsikan sudah muncul.
        // Kita mulai rotasi sekarang.
        setTimeout(() => {
            animatedImage.classList.add('scale-95');
        }, 500); // Mulai rotasi pada detik ke-1

        // --- TAHAP 3: Rotasi Gambar Berhenti ---
        // Rotasi hanya berjalan 1 detik. Jadi kita hapus class-nya 1 detik setelah ditambahkan.
        // 1000ms (mulai rotasi) + 1000ms (durasi rotasi) = 2000ms.
        setTimeout(() => {
            animatedImage.classList.remove('scale-95');
        }, 1000); // Hentikan rotasi pada detik ke-2

        // --- TAHAP 4: Reset Seluruh Animasi ---
        // Ini adalah timeout utama untuk mengembalikan semuanya ke kondisi awal.
        // Kita beri waktu 3 detik, cukup untuk semua animasi di atas selesai.
        setTimeout(() => {
            animatedGroup.classList.remove('is-active');
        }, 3000); // Reset semuanya pada detik ke-3
    }

    // Jalankan seluruh sekuens animasi di atas setiap 5 detik.
    // (3 detik untuk animasi berjalan + 2 detik jeda)
    setInterval(playAnimation, 5000); 

    // Jalankan animasi sekali saat halaman pertama kali dimuat
    playAnimation();
</script>
</body>

</html>
<!-- Notyf JS -->
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

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


@include('components.notyf')