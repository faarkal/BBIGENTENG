<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Balai Usaha Perikanan Genteng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-hidden {
            transform: translateX(-100%);
        }

        .overlay {
            transition: opacity 0.3s ease-in-out;
        }

        #mainContent {
            transition: margin-left 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white fixed top-0 w-full shadow-md z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Sidebar Toggle Button -->
            <div id="sidebarToggle" class="text-2xl font-bold cursor-pointer hover:text-blue-300 transition">
                BUPG Admin
            </div>

            <ul class="flex space-x-6 text-sm md:text-base">
                <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-300">Dashboard</a></li>
                <li><a href="{{ route('admin.logout') }}" class="hover:text-red-400">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Overlay untuk mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-30 overlay"></div>

    <!-- Layout -->
    <div class="flex pt-20 min-h-screen relative">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar sidebar-hidden w-64 bg-white shadow-md fixed top-0 bottom-0 left-0 overflow-y-auto z-40 md:translate-x-0">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold text-blue-800">Menu Admin</h2>
            </div>
            <ul class="p-4 space-y-2">
                <!-- Data Master Benih Ikan -->
                <li class="font-bold text-gray-600 mt-2">Data Master</li>
                <li>
                    <a href="{{ route('admin.master-benih.index') }}"
                        class="block px-4 py-2 text-green-700 hover:bg-green-100 rounded">
                        + Tambah Data Master Benih Ikan
                    </a>
                </li>
                <!-- Tentang Balai -->
                <li class="font-bold text-gray-600 mt-2">Tentang Balai</li>
                <li><a href="{{ route('admin.sejarah') }}" class="block px-4 py-2 hover:bg-blue-100 rounded">Sejarah</a>
                </li>
                <li><a href="{{ route('admin.visi-misi.index') }}"
                        class="block px-4 py-2 hover:bg-blue-100 rounded">Visi & Misi</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-blue-100 rounded">Profil Balai</a></li>

                <!-- Pengelolaan Data -->
                <li class="font-bold text-gray-600 mt-4">Pengelolaan Data</li>
                <li>
                    <a href="{{ route('admin.monitoring.create') }}" class="block px-4 py-2 hover:bg-blue-100 rounded">
                        Monitoring
                    </a>
                    <a href="{{ route('admin.benih.index') }}" class="block px-4 py-2 hover:bg-blue-100 rounded">
                        Pengelolaan Benih Ikan
                    </a>
                    <a href="{{ route('admin.benih.index') }}" class="block px-4 py-2 hover:bg-blue-100 rounded">
                        Pengelolaan Induk Ikan
                    </a>
                </li>
                <li class="font-bold text-gray-600 mt-4"> Pelaporan</li>
                <li>
                    <a href="{{ route('admin.laporan-benih.index') }}"
                        class="block px-4 py-2 hover:bg-blue-100 rounded">
                        Laporan Benih Ikan
                    </a>
                    <a href="{{ route('admin.laporan-induk.index') }}"
                        class="block px-4 py-2 hover:bg-blue-100 rounded">
                        Laporan Induk Ikan
                    </a>
                </li>
                <li class="font-bold text-gray-600 mt-4"> Pemesanan</li>
                <li>
                    <a href="{{ route('admin.pemesanan.index') }}" class="block px-4 py-2 hover:bg-blue-100 rounded">
                        Pemesanan
                    </a>
                </li>
                <li>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main id="mainContent" class="flex-1 p-6 transition-all duration-300">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 text-center">
        <p class="text-sm">&copy; 2025 Balai Usaha Perikanan Genteng. All rights reserved.</p>
    </footer>

    <!-- Script -->
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const overlay = document.getElementById('overlay');

        // Fungsi buka/tutup sidebar
        sidebarToggle.addEventListener('click', () => {
            const isHidden = sidebar.classList.contains('sidebar-hidden');

            if (isHidden) {
                sidebar.classList.remove('sidebar-hidden');
                overlay.classList.remove('hidden');
                overlay.style.opacity = '1';

                // Geser konten hanya di layar besar
                if (window.innerWidth >= 768) {
                    mainContent.style.marginLeft = '16rem'; // 64 tailwind = 16rem
                }
            } else {
                sidebar.classList.add('sidebar-hidden');
                overlay.classList.add('hidden');
                overlay.style.opacity = '0';
                mainContent.style.marginLeft = '0';
            }
        });

        // Tutup sidebar saat klik overlay (mobile)
        overlay.addEventListener('click', () => {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.add('hidden');
            overlay.style.opacity = '0';
            mainContent.style.marginLeft = '0';
        });

        // Responsif otomatis saat resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                overlay.classList.add('hidden');
                sidebar.classList.remove('sidebar-hidden');
                mainContent.style.marginLeft = '16rem';
            } else {
                sidebar.classList.add('sidebar-hidden');
                mainContent.style.marginLeft = '0';
            }
        });
    </script>

</body>

</html>
