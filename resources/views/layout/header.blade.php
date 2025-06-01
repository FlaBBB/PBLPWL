<header class="flex-1 px-10 pt-5 sticky top-0 z-20 bg-white">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">
                {{ $headerTitle ?? 'Welcome Back, Dennis 👋' }}
            </h1>
            @if(!empty($headerDesc) || !isset($headerTitle))
                <p class="text-gray-400 mt-1 text-sm">
                    {{ $headerDesc ?? 'Here is the information about all your achievement' }}
                </p>
            @endif
        </div>
        <div class="flex items-center gap-6">
            <button class="relative">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 7.165 6 9.388 6 12v2.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="relative inline-block text-left">
                <button id="dropdownButton"
                    class="flex items-center gap-2 transition duration-500 px-2 py-2 rounded-lg hover:border border-blue-200 focus:ring-1 focus:ring-blue-400">
                    <img src="{{ asset('images/user-avatar.jpg') }}" alt="User"
                        class="w-9 h-9 rounded-full object-cover border-2 border-blue-200">
                    <span class="font-semibold text-gray-700">Dennis Adit</span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div id="dropdownMenu"
                    class="hidden absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50 py-2">
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Profil
                        saya</a>
                    <form method="POST" action="">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
  const button = document.getElementById('dropdownButton');
  const menu = document.getElementById('dropdownMenu');

  document.addEventListener('click', function (e) {
    const isClickInside = button.contains(e.target) || menu.contains(e.target);

    if (isClickInside) {
      if (button.contains(e.target)) {
        menu.classList.toggle('hidden');
      }
    } else {
      menu.classList.add('hidden');
    }
  });
</script>