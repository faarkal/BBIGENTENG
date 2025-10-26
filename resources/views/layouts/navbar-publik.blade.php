<nav class="bg-blue-900 text-white fixed top-0 w-full shadow-md z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl font-bold">
            <a href="{{ url('/') }}" class="hover:text-blue-300">BUPG</a>
        </div>

        <!-- Menu -->
        <ul class="flex space-x-6 text-sm md:text-base">
            <!-- Home -->
            <li>
                <a href="{{ url('/') }}"
                   class="hover:text-blue-300 {{ request()->is('/') ? 'text-blue-300 font-semibold' : '' }}">
                   Home
                </a>
            </li>

            <!-- Tentang -->
            <li class="relative group">
                <a href="#" class="hover:text-blue-300">Tentang</a>
                <ul
                    class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white text-gray-800 rounded-xl mt-3 py-3 text-center shadow-lg
                    opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out w-max min-w-[11rem]">
                    <li>
                        <a href="{{ route('sejarah') }}"
                           class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">
                           Sejarah
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('visi-misi') }}"
                           class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">
                           Visi & Misi
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('profil-balai') }}"
                           class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">
                           Profil Balai
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Pemesanan -->
            <li>
                <a href="{{ route('pemesanan') }}"
                   class="hover:text-blue-300 {{ request()->is('pemesanan') ? 'text-blue-300 font-semibold' : '' }}">
                   Pemesanan
                </a>
            </li>

            <!-- Laporan -->
            <li class="relative group">
                <a href="#" class="hover:text-blue-300">Laporan</a>
                <ul
                    class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white text-gray-800 rounded-xl mt-3 py-3 text-center shadow-lg
                    opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out w-max min-w-[11rem]">
                    <li>
                        <a href="{{ route('login') }}"
                           class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">
                           Laporan Bibit
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                           class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">
                           Laporan Induk
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Login -->
            <li>
                <a href="{{ route('admin.login') }}"
                   class="hover:text-blue-300 {{ request()->is('admin/login') ? 'text-blue-300 font-semibold' : '' }}">
                   Login
                </a>
            </li>
        </ul>
    </div>
</nav>
