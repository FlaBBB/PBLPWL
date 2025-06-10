@php
use App\Enums\UserRoleEnum;
@endphp
<header class="flex-1 px-10 pt-5 sticky top-0 z-20 bg-white" style="margin-top:0;">
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
                <a href="#" id="notification-bell" class="relative">
                    <svg class="w-6 h-6 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 7.165 6 9.388 6 12v2.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span id="unread-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center hidden"></span>
                </a>

                <!-- Notifications Dropdown -->
                <div id="notifications-dropdown" class="absolute right-0 mt-2 w-80 origin-top-right bg-white rounded-md shadow-lg py-1 ring ring-gray-300 ring-opacity-5 focus:outline-none z-50 hidden">
                    <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200 flex justify-between items-center">
                        <span>Notifications</span>
                        <button id="mark-all-as-read-btn" class="text-xs text-[#1e6aae] hover:underline">Mark all as read</button>
                    </div>
                    <div id="no-notifications-message" class="px-4 py-2 text-sm text-gray-500 hidden">No notifications.</div>
                    <div id="notifications-list">
                        <!-- Notifications will be inserted here by JavaScript -->
                    </div>
                </div>
            </div>

            <div id="user-dropdown-container" class="relative">
                <a
                    href="#" id="user-menu-button"
                    class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-gray-100 focus:outline-none focus:ring focus:ring-[#1e6aae] transition-colors duration-150">
                    <img src="{{ Auth::user()->photo_profile ? asset(Auth::user()->photo_profile) : asset('images/profile-default.jpg') }}" onerror="this.onerror=null;this.src='/images/profile-default.jpg';" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    <svg
                        id="user-menu-arrow"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200 ease-in-out"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <div
                    id="user-dropdown-menu"
                    class="absolute right-0 mt-2 w-48 origin-top-right bg-white rounded-md shadow-lg py-1 ring ring-gray-300 ring-opacity-5 focus:outline-none z-50 hidden"
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

    

    document.addEventListener('DOMContentLoaded', function() {
        const notificationBell = document.getElementById('notification-bell');
        const notificationsDropdown = document.getElementById('notifications-dropdown');
        const unreadCountSpan = document.getElementById('unread-count');
        const notificationsList = document.getElementById('notifications-list');
        const noNotificationsMessage = document.getElementById('no-notifications-message');
        const markAllAsReadBtn = document.getElementById('mark-all-as-read-btn');

        let notifications = [];

        // User dropdown elements
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdownMenu = document.getElementById('user-dropdown-menu');
        const userMenuArrow = document.getElementById('user-menu-arrow');

        // Toggle user dropdown
        userMenuButton.addEventListener('click', function(event) {
            event.preventDefault();
            userDropdownMenu.classList.toggle('hidden');
            userMenuArrow.classList.toggle('rotate-180');
        });

        // Close user dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userDropdownMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userDropdownMenu.classList.add('hidden');
                userMenuArrow.classList.remove('rotate-180');
            }
        });

        async function fetchNotifications() {
            try {
                const response = await axios.get(notificationIndexRoute);
                notifications = response.data;
                renderNotifications();
                updateUnreadCount();
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        }

        function updateUnreadCount() {
            const unread = notifications.filter(n => !n.read_at).length;
            if (unread > 0) {
                unreadCountSpan.textContent = unread;
                unreadCountSpan.classList.remove('hidden');
            } else {
                unreadCountSpan.classList.add('hidden');
            }
        }

        function renderNotifications() {
            notificationsList.innerHTML = ''; // Clear existing notifications
            if (notifications.length === 0) {
                noNotificationsMessage.classList.remove('hidden');
            } else {
                noNotificationsMessage.classList.add('hidden');
                notifications.forEach(notification => {
                    const notificationItem = document.createElement('a');
                    notificationItem.href = '#';
                    notificationItem.classList.add('block', 'px-4', 'py-2', 'text-sm', 'text-gray-700', 'hover:bg-gray-100', 'notification-item');
                    if (notification.read_at) {
                        notificationItem.classList.add('bg-gray-100');
                    } else {
                        notificationItem.classList.add('font-bold');
                    }

                    const truncatedContent = notification.content.substring(0, 100) + (notification.content.length > 100 ? '...' : '');
                    notificationItem.innerHTML = `
                        <p class="notification-content">${truncatedContent}</p>
                        <p class="text-xs text-gray-500">${new Date(notification.created_at).toLocaleString()}</p>
                    `;
                    notificationItem.dataset.fullContent = notification.content; // Store full content

                    notificationItem.addEventListener('click', function(event) {
                        event.preventDefault();
                        const contentParagraph = this.querySelector('.notification-content');
                        const isTruncated = contentParagraph.textContent.length === truncatedContent.length;

                        if (isTruncated) {
                            // If currently truncated, expand
                            contentParagraph.textContent = this.dataset.fullContent;
                        } else {
                            // If currently expanded, truncate
                            contentParagraph.textContent = truncatedContent;
                        }

                        if (!notification.read_at) {
                            markAsRead(notification.id, this); // Pass the element to update its style
                        }
                    });
                    notificationsList.appendChild(notificationItem);
                });
            }
        }

        async function markAsRead(notificationId, notificationItemElement) {
            try {
                await axios.post(`${markAsReadRoute}${notificationId}/mark-as-read`);
                const index = notifications.findIndex(n => n.id === notificationId);
                if (index !== -1) {
                    notifications[index].read_at = new Date().toISOString();
                    notifications[index].is_read = true;
                }
                // Update the UI directly without re-rendering all notifications
                if (notificationItemElement) {
                    notificationItemElement.classList.remove('font-bold');
                    notificationItemElement.classList.add('bg-gray-100');
                }
                updateUnreadCount();
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        }

        async function markAllAsRead() {
            try {
                await axios.post(markAllAsReadRoute);
                notifications.forEach(n => {
                    n.read_at = new Date().toISOString();
                    n.is_read = true;
                });
                renderNotifications(); // Re-render to update styles
                updateUnreadCount();
            } catch (error) {
                console.error('Error marking all notifications as read:', error);
            }
        }

        

        // Event listeners for notification dropdown
        notificationBell.addEventListener('click', function(event) {
            event.preventDefault();
            notificationsDropdown.classList.toggle('hidden');
            if (!notificationsDropdown.classList.contains('hidden')) {
                fetchNotifications(); // Fetch notifications when opening dropdown
            }
        });

        document.addEventListener('click', function(event) {
            setTimeout(() => {
                if (!notificationsDropdown.contains(event.target) && !notificationBell.contains(event.target)) {
                    notificationsDropdown.classList.add('hidden');
                }
            }, 0);
        });
        
        // Initial fetch
        fetchNotifications();
        setInterval(fetchNotifications, 60000); // Refresh every minute
    });
</script>
