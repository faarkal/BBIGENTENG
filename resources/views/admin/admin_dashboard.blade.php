<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | Balai Usaha Perikanan Genteng</title>
    <meta name="description" content="Halaman Dashboard Admin Balai Usaha Perikanan Genteng" />
    <meta name="keywords" content="Dashboard Admin, Balai Usaha Perikanan Genteng" />
    <meta name="author" content="Balai Usaha Perikanan Genteng" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,600,400italic,700' rel='stylesheet'
        type='text/css'>
</head>

<body class="font-sans bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-900 text-white fixed top-0 w-full shadow-md z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold">
                <a href="{{ route('admin.dashboard') }}">BUPG Admin</a>
            </div>
            <ul class="flex space-x-6 text-sm md:text-base">
                <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-300">Dashboard</a></li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-gray-300">Tentang</a>
                    <ul
                        class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white shadow-lg rounded-xl mt-3 py-3 text-center
                                   opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out
                                   w-max min-w-[11rem]">
                        <li><a href="{{ url('admin/sejarah') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Sejarah</a>
                        </li>
                        <li><a href="{{ url('admin/visi-misi') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Visi
                                dan Misi</a></li>
                        <li><a href="{{ url('admin/profil-balai') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Profil
                                Balai</a></li>
                    </ul>
                </li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-gray-300">Pengelolaan</a>
                    <ul
                        class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white shadow-lg rounded-xl mt-3 py-3 text-center
                                   opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out
                                   w-max min-w-[11rem]">
                        <li><a href="{{ route('admin.monitoring.create') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Monitoring</a>
                        </li>
                        <li><a href="{{ route('sejarah') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Pengelolaan
                                Induk</a>
                        </li>
                        <li><a href="{{ route('admin.benih.index') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Pengelolaan
                                Benih Ikan</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('admin.pemesanan.index') }}" class="hover:text-blue-300">Pemesanan</a>
                </li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-gray-300">Pelaporan</a>
                    <ul
                        class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white shadow-lg rounded-xl mt-3 py-3 text-center
                                   opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out
                                   w-max min-w-[11rem]">
                        <li><a href="{{ url('admin/laporan-benih') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Pelaporan
                                Benih Ikan</a>
                        </li>
                        <li><a href="{{ url('admin/laporan-induk') }}"
                                class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Pelaporan
                                Induk Ikan</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ url('admin/logout') }}" class="hover:text-red-400">Logout</a></li>
            </ul>
        </div>
    </nav>

                    <!-- Login -->
                    <li><a href="{{ route('admin.login') }}" class="text-white hover:text-gray-300">Logout</a></li>
                </ul>

    <!-- Header Section -->
    <header class="relative h-screen bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('backend/assets/images/balai.jpg') }}'); margin-top:64px;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto h-full flex items-center justify-center text-center relative z-10">
            <div class="text-white">
                <h1 class="text-5xl md:text-7xl font-bold mb-4">Selamat Datang, Admin!</h1>
                <p class="text-lg md:text-xl">Kelola data Balai Usaha Perikanan Genteng dengan mudah di dashboard ini.
                </p>
            </div>
        </div>
    </header>

    <!-- Dashboard Overview -->
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Menu Utama</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Produksi -->
                <div class="bg-white shadow-lg rounded-2xl text-center p-8 hover:shadow-2xl transition">
                    <i class="fa-solid fa-fish text-blue-500 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Laporan Benih</h3>
                    <p class="text-gray-600 mb-4">Lihat dan kelola data produksi benih ikan.</p>
                    <a href="{{ url('admin/laporan-produksi') }}"
                        class="inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Lihat</a>
                </div>

                <!-- Induk -->
                <div class="bg-white shadow-lg rounded-2xl text-center p-8 hover:shadow-2xl transition">
                    <i class="fa-solid fa-water text-blue-500 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Laporan Induk</h3>
                    <p class="text-gray-600 mb-4">Pantau data induk ikan dan hasil pembiakan.</p>
                    <a href="{{ url('admin/laporan-induk') }}"
                        class="inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Lihat</a>
                </div>

                <!-- Penjualan -->
                <div class="bg-white shadow-lg rounded-2xl text-center p-8 hover:shadow-2xl transition">
                    <i class="fa-solid fa-file-invoice-dollar text-blue-500 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Laporan Penjualan</h3>
                    <p class="text-gray-600 mb-4">Kelola data penjualan dan nota transaksi pelanggan.</p>
                    <a href="{{ url('admin/laporan-penjualan') }}"
                        class="inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Lihat</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-10 mt-20">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2025 Balai Usaha Perikanan Genteng. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
