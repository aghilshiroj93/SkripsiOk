<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/sma1.png') }}" type="image/png">
    <title>Web Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
<!-- Global Loading Overlay -->
{{-- <div id="globalLoading" class="fixed inset-0 bg-white bg-opacity-70 flex items-center justify-center z-50 hidden">
    <div class="relative w-20 h-20">
        <!-- 12 Dots -->
        <div class="dot" style="--i: 0;"></div>
        <div class="dot" style="--i: 1;"></div>
        <div class="dot" style="--i: 2;"></div>
        <div class="dot" style="--i: 3;"></div>
        <div class="dot" style="--i: 4;"></div>
        <div class="dot" style="--i: 5;"></div>
        <div class="dot" style="--i: 6;"></div>
        <div class="dot" style="--i: 7;"></div>
        <div class="dot" style="--i: 8;"></div>
        <div class="dot" style="--i: 9;"></div>
        <div class="dot" style="--i: 10;"></div>
        <div class="dot" style="--i: 11;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-gray-700 text-sm">loading...</div>
    </div>
</div> --}}

<style>
    .dot {
        position: absolute;
        width: 8px;
        height: 8px;
        background-color: black;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: rotate(calc(var(--i) * 30deg)) translate(36px) rotate(calc(var(--i) * -30deg));
        animation: spinFade 1.2s linear infinite;
        animation-delay: calc(var(--i) * 0.1s);
        opacity: 0.2;
    }

    @keyframes spinFade {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0.2;
        }
    }
</style>


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
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 group @if (Request::is('dashboard')) bg-blue-50 text-blue-600 active-menu @endif">
                        <div
                            class="bg-blue-100 text-blue-600 p-2 rounded-lg group-hover:bg-blue-200 transition-colors duration-200 @if (Request::is('dashboard')) bg-blue-200 @endif">
                            <iconify-icon icon="mdi:view-dashboard" width="20"></iconify-icon>
                        </div>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Absensi -->
                <li>
                    <a href="{{ route('absensi.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-50 hover:text-green-600 text-gray-700 transition-all duration-200 group @if (Request::is('absensi*')) bg-green-50 text-green-600 active-menu @endif">
                        <div
                            class="bg-green-100 text-green-600 p-2 rounded-lg group-hover:bg-green-200 transition-colors duration-200 @if (Request::is('absensi*')) bg-green-200 @endif">
                            <iconify-icon icon="mdi:clipboard-check" width="20"></iconify-icon>
                        </div>
                        <span>Absensi</span>
                    </a>
                </li>

                @if (Auth::user()->role == 'admin')
                    <!-- Data Master Dropdown -->
                    <li class="relative">
                        @php
                            $isDataMasterActive =
                                Request::is('siswa*') ||
                                Request::is('kelas-jurusan*') ||
                                Request::is('user*') ||
                                Request::is('mata_pelajaran*') ||
                                Request::is('guru*') ||
                                Request::is('tahun-akademik*');
                        @endphp
                        <details class="group" @if ($isDataMasterActive) open @endif>
                            <summary
                                class="flex items-center justify-between gap-3 p-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 text-gray-700 cursor-pointer transition-all duration-200 @if ($isDataMasterActive) bg-purple-50 text-purple-600 active-menu @endif">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-purple-100 text-purple-600 p-2 rounded-lg group-hover:bg-purple-200 transition-colors duration-200 @if ($isDataMasterActive) bg-purple-200 @endif">
                                        <iconify-icon icon="mdi:database" width="20"></iconify-icon>
                                    </div>
                                    <span>Data Master</span>
                                </div>
                                <iconify-icon icon="mdi:chevron-down"
                                    class="group-open:rotate-180 transition-transform duration-200"
                                    width="18"></iconify-icon>
                            </summary>
                            <ul class="ml-12 mt-1 space-y-1 animate-fadeIn">
                                <li>
                                    <a href="{{ url('/siswa') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 @if (Request::is('siswa*')) bg-blue-50 text-blue-600 @endif">
                                        <iconify-icon icon="mdi:account-school" width="18"
                                            class="text-blue-500"></iconify-icon>
                                        <span>Data Siswa</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/kelas-jurusan') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-green-50 hover:text-green-600 text-gray-700 transition-all duration-200 @if (Request::is('kelas-jurusan*')) bg-green-50 text-green-600 @endif">
                                        <iconify-icon icon="mdi:google-classroom" width="18"
                                            class="text-green-500"></iconify-icon>
                                        <span>Data Kelas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/user') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-purple-50 hover:text-purple-600 text-gray-700 transition-all duration-200 @if (Request::is('user*')) bg-purple-50 text-purple-600 @endif">
                                        <iconify-icon icon="mdi:account-group" width="18"
                                            class="text-purple-500"></iconify-icon>
                                        <span>Data User</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mata_pelajaran.index') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 @if (Request::is('mata_pelajaran*')) bg-blue-50 text-blue-600 @endif">
                                        <iconify-icon icon="fluent:book-20-filled" width="18"
                                            class="text-blue-500"></iconify-icon>
                                        <span>Mata Pelajaran</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/guru') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 @if (Request::is('guru*')) bg-blue-50 text-blue-600 @endif">
                                        <iconify-icon icon="mdi:account-tie" width="18"
                                            class="text-blue-500"></iconify-icon>
                                        <span>Data Guru</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('tahun-akademik.index') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-red-50 hover:text-red-600 text-gray-700 transition-all duration-200 @if (Request::is('tahun-akademik*')) bg-red-50 text-red-600 @endif">
                                        <iconify-icon icon="material-symbols:school-outline" width="18"
                                            class="text-red-500"></iconify-icon>
                                        <span>Tahun Akademik</span>
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>

                    <!-- Setting Dropdown -->
                    <li class="relative">
                        @php
                            $isSettingActive =
                                Request::is('siswa-tidak-aktif*') ||
                                Request::is('pembagian-kelas*') ||
                                Request::is('hasil-pembagian*') ||
                                Request::is('jadwal*');
                        @endphp
                        <details class="group" @if ($isSettingActive) open @endif>
                            <summary
                                class="flex items-center justify-between gap-3 p-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 text-gray-700 cursor-pointer transition-all duration-200 @if ($isSettingActive) bg-orange-50 text-orange-600 active-menu @endif">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-orange-100 text-orange-600 p-2 rounded-lg group-hover:bg-orange-200 transition-colors duration-200 @if ($isSettingActive) bg-orange-200 @endif">
                                        <iconify-icon icon="fluent:settings-20-regular" width="20"></iconify-icon>
                                    </div>
                                    <span>Setting</span>
                                </div>
                                <iconify-icon icon="mdi:chevron-down"
                                    class="group-open:rotate-180 transition-transform duration-200"
                                    width="18"></iconify-icon>
                            </summary>
                            <ul class="ml-12 mt-1 space-y-1 animate-fadeIn">
                                <li>
                                    <a href="{{ route('siswa-tidak-aktif.index') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-red-50 hover:text-red-600 text-gray-700 transition-all duration-200 @if (Request::is('siswa-tidak-aktif*')) bg-red-50 text-red-600 @endif">
                                        <iconify-icon icon="mdi:account-remove" width="18"
                                            class="text-red-500"></iconify-icon>
                                        <span>Siswa Tidak Aktif</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pembagian.kelas.index') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-all duration-200 @if (Request::is('pembagian-kelas*')) bg-blue-50 text-blue-600 @endif">
                                        <iconify-icon icon="mdi:account-group" width="18"
                                            class="text-blue-500"></iconify-icon>
                                        <span>Pembagian Kelas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('hasil.pembagian.index') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-green-50 hover:text-green-600 text-gray-700 transition-all duration-200 @if (Request::is('hasil-pembagian*')) bg-green-50 text-green-600 @endif">
                                        <iconify-icon icon="mdi:clipboard-check-outline" width="18"
                                            class="text-green-500"></iconify-icon>
                                        <span>Hasil Pembagian Kls</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/jadwal') }}"
                                        class="flex items-center gap-3 p-2 text-sm rounded-lg hover:bg-purple-50 hover:text-purple-600 text-gray-700 transition-all duration-200 @if (Request::is('jadwal*')) bg-purple-50 text-purple-600 @endif">
                                        <iconify-icon icon="mdi:calendar-clock" width="18"
                                            class="text-purple-500"></iconify-icon>
                                        <span>Jadwal</span>
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                @endif

                <!-- Rekapitulasi -->
                <li>
                    <a href="{{ url('/rekapabsensi') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-amber-50 hover:text-amber-600 text-gray-700 transition-all duration-200 group @if (Request::is('rekapitulasi*')) bg-amber-50 text-amber-600 active-menu @endif">
                        <div
                            class="bg-amber-100 text-amber-600 p-2 rounded-lg group-hover:bg-amber-200 transition-colors duration-200 @if (Request::is('rekapitulasi*')) bg-amber-200 @endif">
                            <iconify-icon icon="mdi:chart-bar" width="20"></iconify-icon>
                        </div>
                        <span>Rekapitulasi</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Profile and Logout Section -->
        <div class="mt-auto border-t border-gray-200 pt-4 pb-4 px-2">
            <!-- Profile Link -->
            <div class="mb-2">
                <a href="{{ url('/profile') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200 
                  hover:bg-amber-50 hover:text-amber-600 text-gray-600
                  @if (Request::is('profile*')) bg-amber-50 text-amber-600 @endif">
                    <div
                        class="p-2 rounded-lg transition-colors duration-200
                       @if (Request::is('profile*')) bg-amber-100 text-amber-600
                       @else bg-gray-100 text-gray-500 group-hover:bg-amber-100 group-hover:text-amber-600 @endif">
                        <iconify-icon icon="mdi:account-cog" width="20"></iconify-icon>
                    </div>
                    <span class="font-medium">Profil Saya</span>
                    @if (Request::is('profile*'))
                        <div class="ml-auto w-1 h-6 bg-amber-500 rounded-full"></div>
                    @endif
                </a>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full p-3 rounded-lg transition-all duration-200
                       text-gray-600 hover:bg-red-50 hover:text-red-600
                       active:scale-95 active:bg-red-100">
                    <div
                        class="p-2 rounded-lg bg-gray-100 text-gray-500 
                       group-hover:bg-red-100 group-hover:text-red-600 transition-colors duration-200">
                        <iconify-icon icon="mdi:logout-variant" width="20"></iconify-icon>
                    </div>
                    <span class="font-medium">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <main class="p-6">@yield('content')</main>
    </div>

    <!-- Profile Modal -->
    {{-- <div id="profileModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-30 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0"
            id="modalContent">
            <div class="p-6">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Profil</h3>
                    <button onclick="closeProfileModal()"
                        class="text-gray-500 hover:text-gray-700 rounded-full p-1 transition-colors duration-200 hover:bg-gray-100">
                        <iconify-icon icon="mdi:close" width="24"></iconify-icon>
                    </button>
                </div>

                <div class="p-6">
                    <div class="flex justify-center mb-6">
                        <div class="relative group">
                            <div
                                class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 transition-all duration-300 group-hover:bg-blue-200">
                                <iconify-icon icon="mdi:account-circle" width="48"></iconify-icon>
                            </div>
                            <button
                                class="absolute bottom-0 right-0 bg-white p-1.5 rounded-full shadow-sm border border-gray-200 hover:bg-blue-50 transition-colors duration-200">
                                <iconify-icon icon="mdi:camera" width="16" class="text-gray-600"></iconify-icon>
                            </button>
                        </div>
                    </div>

                    <form class="space-y-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" value="{{ Auth::user()->name }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" />
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" />
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" placeholder="Masukkan password baru"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" />
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                            <input type="password" placeholder="Konfirmasi password baru"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" />
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeProfileModal()"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200 active:scale-95">
                                Batal
                            </button>
                            <button type="button" onclick="saveProfile()"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 active:scale-95 shadow-md hover:shadow-lg">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

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

        // Handle dropdown menu clicks - Independent behavior
        document.querySelectorAll('details').forEach((detail) => {
            const summary = detail.querySelector('summary');

            summary.addEventListener('click', function(e) {
                // Only prevent default for summary clicks
                if (e.target === summary || summary.contains(e.target)) {
                    e.preventDefault();

                    // Toggle only the clicked dropdown
                    const isOpen = detail.hasAttribute('open');
                    if (isOpen) {
                        detail.removeAttribute('open');
                    } else {
                        detail.setAttribute('open', '');
                    }
                }
            });
        });

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loading = document.getElementById('globalLoading');

            // Saat klik link
            document.querySelectorAll('a[href]').forEach(el => {
                el.addEventListener('click', function(e) {
                    const href = el.getAttribute('href');
                    if (href && !href.startsWith('#') && !el.hasAttribute('target')) {
                        loading.classList.remove('hidden');
                    }
                });
            });

            // Saat form submit
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    loading.classList.remove('hidden');
                });
            });
        });
    </script>



    @yield('scripts')
</body>

</html>
