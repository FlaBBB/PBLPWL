@php
use App\Enums\UserRoleEnum;
@endphp
<header x-data="headerData()" class="flex-1 px-10 pt-5 sticky top-0 z-20 bg-white" style="margin-top:0;">
    <div class="flex justify-between items-center">
        <div>
            @if(Auth::user()->role === UserRoleEnum::MAHASISWA)
            <a href="{{ route('mahasiswa.dashboard') }}" class="text-2xl font-bold">
            @elseif(Auth::user()->role === UserRoleEnum::ADMIN)
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold">
            @elseif(Auth::user()->role === UserRoleEnum::DOSEN)
            <a href="{{ route('dosen.dashboard') }}" class="text-2xl font-bold">
            @endif
                {{ $headerTitle ?? 'Welcome Back, ' }}<a href="{{ route('user.profile.show', ['role' => strtolower(Auth::user()->role->value), 'id' => Auth::user()->id]) }}" class="text-[#1e6aae] hover:underline">{{ Auth::user()->name }}</a> 👋
            </a>
            @if(!empty($headerDesc) || !isset($headerTitle))
            <p class="text-gray-400 mt-1">
                {{ $headerDesc ?? 'The description will appeared if you are login' }}
            </p>
            @endif
        </div>
        <div class="flex items-center gap-6">
            <div class="relative">
                <a href="#" @click.prevent="notificationsOpen = !notificationsOpen; if (notificationsOpen) fetchNotifications();" class="relative">
                    <svg class="w-6 h-6 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 7.165 6 9.388 6 12v2.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center"></span>
                </a>

                <!-- Notifications Dropdown -->
                <div x-show="notificationsOpen" @click.away="notificationsOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-80 origin-top-right bg-white rounded-md shadow-lg py-1 ring ring-gray-300 ring-opacity-5 focus:outline-none z-50">
                    <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200 flex justify-between items-center">
                        <span>Notifications</span>
                        <button @click="markAllAsRead()" x-show="unreadCount > 0" class="text-xs text-[#1e6aae] hover:underline">Mark all as read</button>
                    </div>
                    <div x-show="notifications.length === 0" class="px-4 py-2 text-sm text-gray-500">No new notifications.</div>
                    <template x-for="notification in notifications" :key="notification.id">
                        <a href="#" @click.prevent="markAsRead(notification.id)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <p x-text="notification.content"></p>
                            <p class="text-xs text-gray-500" x-text="new Date(notification.created_at).toLocaleString()"></p>
                        </a>
                    </template>
                </div>
            </div>

            <div x-data="{ isOpen: false }" class="relative">
                <a
                    @click="isOpen = !isOpen"
                    @keydown.escape.window="isOpen = false"
                    class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-gray-100 focus:outline-none focus:ring focus:ring-[#1e6aae] transition-colors duration-150">
                    <img src="{{ Auth::user()->photo_profile ? asset(Auth::user()->photo_profile) : asset('images/profile-default.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('images/profile-default.jpg') }}';" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    <!-- <span class="font-semibold text-gray-700 hidden sm:inline max-w-[150px] truncate">P</span> -->
                    <svg
                        class="w-4 h-4 text-gray-400 transition-transform duration-200 ease-in-out"
                        :class="{'rotate-180': isOpen}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <div
                    x-show="isOpen"
                    @click.away="isOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg py-1 ring ring-gray-300 ring-opacity-5 focus:outline-none z-50"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu-button">
                    @if(Auth::user()->role === UserRoleEnum::MAHASISWA)
                    <a href="{{ route('mahasiswa.edit-profile') }}" class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                        Edit Profil
                    </a>
                    @elseif(Auth::user()->role === UserRoleEnum::ADMIN)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                        Edit Profil
                    </a>
                    @elseif(Auth::user()->role === UserRoleEnum::DOSEN)
                    <a href="{{ route('dosen.edit-profile') }}" class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                        Edit Profil
                    </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    const notificationIndexRoute = "{{ route('notifications.index') }}";
    const markAsReadRoute = "/notifications/"; // Will append ID and /mark-as-read
    const markAllAsReadRoute = "{{ route('notifications.markAllAsRead') }}";

    document.addEventListener('alpine:init', () => {
        Alpine.data('headerData', () => ({
            notifications: [],
            unreadCount: 0,
            notificationsOpen: false,

            init() {
                this.fetchNotificationsCount();
                setInterval(() => this.fetchNotificationsCount(), 60000); // Refresh count every minute
            },

            async fetchNotificationsCount() {
                try {
                    const response = await axios.get(notificationIndexRoute);
                    this.unreadCount = response.data.length;
                } catch (error) {
                    console.error('Error fetching notification count:', error);
                }
            },

            async fetchNotifications() {
                try {
                    const response = await axios.get(notificationIndexRoute);
                    this.notifications = response.data;
                    this.unreadCount = response.data.length;
                } catch (error) {
                    console.error('Error fetching notifications:', error);
                }
            },

            async markAsRead(notificationId) {
                try {
                    await axios.post(`${markAsReadRoute}${notificationId}/mark-as-read`);
                    this.notifications = this.notifications.filter(n => n.id !== notificationId);
                    this.unreadCount = this.notifications.length;
                } catch (error) {
                    console.error('Error marking notification as read:', error);
                }
            },

            async markAllAsRead() {
                try {
                    await axios.post(markAllAsReadRoute);
                    this.notifications = [];
                    this.unreadCount = 0;
                } catch (error) {
                    console.error('Error marking all notifications as read:', error);
                }
            }
        }))
    });
</script>