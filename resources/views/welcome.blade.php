<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUPG - Balai Usaha Perikanan Genteng</title>
    <meta name="description" content="Balai Usaha Perikanan Genteng" />
    <meta name="keywords" content="Balai Usaha Perikanan Genteng" />
    <meta name="author" content="Balai Usaha Perikanan Genteng" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,600,400italic,700' rel='stylesheet'
        type='text/css'>

    <style>
        /* Kustom CSS tambahan */
        .gtco-video a {
            z-index: 1001;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -45px;
            margin-left: -45px;
            width: 90px;
            height: 90px;
            display: table;
            text-align: center;
            background: #fff;
            box-shadow: 0px 14px 30px -15px rgba(0, 0, 0, 0.75);
            border-radius: 50%;
        }

        .gtco-video a i {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            font-size: 40px;
        }

        .gtco-video .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            transition: 0.5s;
        }

        .gtco-video:hover .overlay {
            background: rgba(0, 0, 0, 0.7);
        }

        .gtco-video:hover a {
            transform: scale(1.2);
        }
    </style>
</head>

<body class="font-sans">
    <!-- Loader -->
    <div class="gtco-loader"></div>

    <div id="page">
        <!-- Navigasi -->
        <nav class="flex items-center justify-between flex-wrap p-6 absolute w-full z-50">
            <div class="container mx-auto">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="w-1/6">
                        <div class="text-white text-2xl font-bold">
                            <a href="{{ url('/') }}">BUPG</a>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div class="w-5/6 text-right">
                        <ul class="flex justify-end space-x-8">
                            <!-- Home -->
                            <li><a href="{{ url('/') }}" class="text-white hover:text-gray-300">Home</a></li>

                            <!-- Tentang (dropdown tanpa panah) -->
                            <li class="relative group">
                                <a href="#" class="text-white hover:text-gray-300">Tentang</a>
                                <ul
                                    class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white shadow-lg rounded-xl mt-3 py-3 text-center
                                   opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out
                                   w-max min-w-[11rem]">
                                    <li><a href="{{ route('sejarah') }}"
                                            class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Sejarah</a>
                                    </li>
                                    <li><a href="{{ url('visi-misi') }}"
                                            class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Visi
                                            dan Misi</a></li>
                                    <li><a href="{{ url('profil-balai') }}"
                                            class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Profil
                                            Balai</a></li>
                                </ul>
                            </li>

                            <!-- Pemesanan -->
                            <li><a href="{{ route('pemesanan') }}" class="text-white hover:text-gray-300">Pemesanan</a>
                            </li>

                            <!-- Laporan (dropdown tanpa panah, auto-width + animasi) -->
                            <li class="relative group">
                                <a href="#" class="text-white hover:text-gray-300">Laporan</a>
                                <ul
                                    class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white shadow-lg rounded-xl mt-3 py-3 text-center
                                   opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out
                                   w-max min-w-[12rem]">
                                    <li><a href="{{ route('laporan-benih') }}"
                                            class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Laporan
                                            Benih Ikan</a></li>
                                    <li><a href="{{ route('laporan-induk') }}"
                                            class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Laporan
                                            Induk Ikan</a></li>
                                </ul>
                            </li>

                            <!-- Login -->
                            <li><a href="{{ route('admin.login') }}" class="text-white hover:text-gray-300">Login</a>
                            </li>
                        </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header class="relative h-screen bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('backend/assets/images/balai.jpg') }}');">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="container mx-auto h-full flex items-center justify-center text-center relative z-10">
                <div class="text-white">
                    <h1 class="text-5xl md:text-7xl font-bold mb-4">Balai Usaha Perikanan Genteng</h1>
                </div>
            </div>
        </header>

        <!-- Features -->
        <section id="gtco-features" class="py-20">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <!-- Pemesanan -->
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="text-center p-8">
                            <span
                                class="icon w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fa-solid fa-cart-shopping text-blue-500 text-3xl"></i>
                            </span>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Pemesanan</h3>
                            <p class="text-gray-600 mb-6">Lakukan pemesanan benih ikan langsung melalui
                                website kami, praktis tanpa harus datang ke balai.</p>
                            <a href="{{ route('pemesanan') }}"
                                class="inline-block px-6 py-3 border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white transition">Pesan
                                Sekarang</a>
                        </div>
                    </div>

                    <!-- Laporan -->
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="text-center p-8">
                            <span
                                class="icon w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fa-solid fa-file-lines text-blue-500 text-3xl"></i>
                            </span>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Laporan</h3>
                            <p class="text-gray-600 mb-6">Lihat data laporan produksi dan penjualan ikan secara
                                transparan dan terperinci di sini.</p>
                            <a href="{{ route('laporan-benih') }}"
                                class="inline-block px-6 py-3 border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white transition">Lihat</a>
                        </div>
                    </div>

                    <!-- Tentang -->
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="text-center p-8">
                            <span
                                class="icon w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fa-solid fa-circle-info text-blue-500 text-3xl"></i>
                            </span>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Tentang</h3>
                            <p class="text-gray-600 mb-6">Kenali lebih dekat Balai Usaha Perikanan Genteng melalui
                                sejarah, visi-misi, serta profil kami di fitur Tentang.</p>
                            <a href="{{ route('sejarah') }}"
                                class="inline-block px-6 py-3 border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white transition">Info
                                Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Laporan Aktivitas -->
        <section class="py-10 bg-gray-100">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Video Aktivitas</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach (\App\Models\Video::latest()->take(3)->get() as $video)
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                            <video controls class="w-full h-64 object-cover">
                                <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                Browser kamu tidak mendukung pemutaran video.
                            </video>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg text-gray-800">{{ $video->judul }}</h3>
                                @if ($video->deskripsi)
                                    <p class="text-gray-600 mt-2">{{ $video->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="gtco-footer" class="bg-blue-900 text-white py-12 mt-20">
            <div class="container mx-auto px-6 text-center">
                <h4 class="text-2xl font-semibold mb-4">Lokasi Balai Usaha Perikanan Genteng (BBI Genteng)</h4>
                <div class="relative pb-[56.25%] h-0 overflow-hidden rounded-lg shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.3552842112444!2d114.133!3d-8.216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd154ded9c821b9%3A0x8a8828d3568764d4!2sBalai%20Benih%20Ikan%20(BBI)%20Genteng!5e0!3m2!1sid!2sid!4v1699284425000!5m2!1sid!2sid"
                        width="600" height="450" class="absolute top-0 left-0 w-full h-full border-0"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p class="mt-4 text-gray-200">J5W7+H3H, Jl. Temuguruh, Dusun Krajan, Genteng Wetan, Banyuwangi,
                    Kabupaten Banyuwangi, Jawa Timur 68465</p>

                <div
                    class="border-t border-gray-700 pt-6 mt-8 flex flex-col md:flex-row items-center justify-between text-center md:text-left">
                    <p class="text-gray-300 text-sm">&copy; 2025 Balai Usaha Perikanan Genteng. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="https://id-id.facebook.com/KabupatenBanyuwangi"
                            class="text-white hover:text-blue-400"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/disperikananbwi?igsh=M2VmbHZlNGowbmJk"
                            class="text-white hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtube.com/@dinasperikanankabupatenban7311?si=6LJA04m9lYGJqc1c"
                            class="text-white hover:text-blue-400"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Inisialisasi AOS -->
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
        });
    </script>
</body>

</html>
