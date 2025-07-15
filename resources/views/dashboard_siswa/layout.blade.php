<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/sma1.png') }}" type="image/png">
    <title>Web Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan di file layout utama, misalnya di layouts/app.blade.php -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }

        #sidebar {
            z-index: 40;
        }

        #sidebarOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
        }

        /* Active menu indicator */
        .active-menu {
            position: relative;
        }

        .active-menu:after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #3b82f6;
            border-radius: 0 4px 4px 0;
        }
    </style>
</head>

<body class="flex flex-col md:flex-row h-screen bg-gray-50">
    <!-- Mobile Header -->
    <header class="md:hidden flex items-center justify-between p-4 bg-white shadow-sm z-30">
        <button id="mobileMenuButton" class="text-gray-600">
            <iconify-icon icon="mdi:menu" width="24"></iconify-icon>
        </button>
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <iconify-icon icon="mdi:school" class="text-blue-600" width="24"></iconify-icon>
            <span class="bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">Aplikasi
                Absensi</span>
        </h2>
        <div class="w-6"></div>
    </header>

    <!-- Overlay for mobile -->
    <div id="sidebarOverlay" class="md:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="hidden md:flex md:w-64 p-4 flex-col border-r border-gray-200 bg-white shadow-sm transform transition-all duration-300 fixed md:static inset-y-0 left-0 w-64">
        <div class="flex justify-between items-center mb-8 md:block">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <img src="{{ asset('images/sma1.png') }}" alt="Logo"
                    class="w-8 h-8 rounded-full object-cover border-2 border-blue-100">
                <span class="bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">Aplikasi
                    Absensi</span>
            </h2>
            <button id="closeSidebar" class="md:hidden text-gray-600 p-1">
                <iconify-icon icon="mdi:close" width="24"></iconify-icon>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto">
            <ul class="space-y-1">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard_siswa.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 group @if (Request::is('dashboard_siswa')) bg-blue-50 text-blue-600 active-menu @endif">
                        <div
                            class="bg-blue-100 text-blue-600 p-2 rounded-lg group-hover:bg-blue-200 transition-colors duration-200 @if (Request::is('dashboard_siswa')) bg-blue-200 @endif">
                            <iconify-icon icon="mdi:view-dashboard" width="20"></iconify-icon>
                        </div>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Mata Pelajaran -->
                <li>
                    <a href="{{ route('dashboard_siswa.mapel') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 hover:text-green-600 text-gray-700 transition-all duration-200 group @if (Request::is('dashboard_siswa/mapel*')) bg-green-50 text-green-600 active-menu @endif">
                        <div
                            class="bg-green-100 text-green-600 p-2 rounded-lg group-hover:bg-green-200 transition-colors duration-200 @if (Request::is('dashboard_siswa/mapel*')) bg-green-200 @endif">
                            <iconify-icon icon="mdi:book-open" width="20"></iconify-icon>
                        </div>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>

                <!-- Profil -->
                <li>
                    <a href="{{ route('dashboard_siswa.profile') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 text-gray-700 transition-all duration-200 group @if (Request::is('dashboard_siswa/profile*')) bg-purple-50 text-purple-600 active-menu @endif">
                        <div
                            class="bg-purple-100 text-purple-600 p-2 rounded-lg group-hover:bg-purple-200 transition-colors duration-200 @if (Request::is('dashboard_siswa/profile*')) bg-purple-200 @endif">
                            <iconify-icon icon="mdi:account-circle" width="20"></iconify-icon>
                        </div>
                        <span>Profil</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Profile and Logout Section -->
        <div class="mt-auto border-t border-gray-200 pt-4">
            <form method="POST" action="{{ route('logout') }}" class="w-full mt-2">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full p-3 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-200 active:scale-95">
                    <iconify-icon icon="mdi:logout" width="20"></iconify-icon>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <main class="p-6">@yield('content')</main>
    </div>



    <script>
        // Mobile sidebar toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('hidden');
            sidebarOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeSidebarFunc() {
            sidebar.classList.add('hidden');
            sidebarOverlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        mobileMenuButton.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarFunc);
        sidebarOverlay.addEventListener('click', closeSidebarFunc);

        // Modal control functions
        function openProfileModal() {
            const modal = document.getElementById('profileModal');
            const content = document.getElementById('modalContent');

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.style.opacity = '1';
                content.style.transform = 'scale(1)';
                content.style.opacity = '1';
            }, 10);

            document.body.style.overflow = 'hidden';
        }

        function closeProfileModal() {
            const modal = document.getElementById('profileModal');
            const content = document.getElementById('modalContent');

            content.style.transform = 'scale(0.95)';
            content.style.opacity = '0';
            modal.style.opacity = '0';

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);

            document.body.style.overflow = 'auto';
        }

        function saveProfile() {
            const saveBtn = document.querySelector('#profileModal button[onclick="saveProfile()"]');
            saveBtn.innerHTML = 'Menyimpan...';
            saveBtn.disabled = true;

            setTimeout(() => {
                alert('Perubahan profil berhasil disimpan!');
                saveBtn.innerHTML = 'Simpan Perubahan';
                saveBtn.disabled = false;
                closeProfileModal();
            }, 1000);
        }

        // Close modal when clicking outside
        document.getElementById('profileModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProfileModal();
            }
        });

        // Handle window resize
        function handleResize() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('hidden');
                sidebarOverlay.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Initial check and event listener
        handleResize();
        window.addEventListener('resize', handleResize);
    </script>

    @yield('scripts')
</body>

</html>
