<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemesanan | Balai Usaha Perikanan Genteng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="font-sans bg-gray-50">

    <!-- 🔹 Navbar (disamakan dengan welcome.blade.php) -->
    <nav class="flex items-center justify-between flex-wrap p-6 bg-blue-900 fixed w-full z-50 shadow-md">
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

                        <!-- Tentang -->
                        <li class="relative group">
                            <a href="#" class="text-white hover:text-gray-300">Tentang</a>
                            <ul
                                class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white shadow-lg rounded-xl mt-3 py-3 text-center
                                opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out
                                w-max min-w-[11rem]">
                                <li><a href="{{ url('sejarah') }}"
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
                        <li><a href="{{ route('pemesanan.form') }}" class="text-white hover:text-gray-300">Pemesanan</a>
                        </li>

                        <!-- Laporan -->
                        <li class="relative group">
                            <a href="#" class="text-white hover:text-gray-300">Laporan</a>
                            <ul
                                class="absolute left-1/2 transform -translate-x-1/2 hidden group-hover:block bg-white shadow-lg rounded-xl mt-3 py-3 text-center
                                opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 ease-in-out
                                w-max min-w-[12rem]">
                                <li><a href="{{ route('login') }}"
                                        class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Laporan
                                        Bibit</a></li>
                                <li><a href="{{ route('login') }}"
                                        class="block px-6 py-2 text-gray-800 hover:bg-blue-500 hover:text-white rounded-lg transition-colors">Laporan
                                        Induk</a></li>
                            </ul>
                        </li>

                        <!-- Login -->
                        <li><a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- 🔹 Form Pemesanan -->
    <main class="container mx-auto px-6 py-32" id="formPemesanan">
        <h2 class="text-3xl font-bold mb-8 text-center text-blue-800">Formulir Pemesanan Ikan</h2>

        <form id="formOrder" action="{{ route('pemesanan') }}" method="POST"
            class="bg-white shadow-lg rounded-lg p-8 max-w-2xl mx-auto space-y-6">
            @csrf
            <div>
                <label for="jenis_bibit" class="block font-semibold mb-2">Jenis Ikan</label>
                <select id="jenis_bibit" name="jenis_bibit" required class="w-full border rounded-lg px-4 py-2">
                    <option value="">-- Pilih Jenis Ikan --</option>
                    <option value="Nila Gift">Nila Gift</option>
                    <option value="Nila Hitam">Nila Hitam</option>
                    <option value="Gurame">Gurame</option>
                    <option value="Tombro">Tombro</option>
                    <option value="Koi">Koi</option>
                </select>
            </div>

            <div>
                <label for="namaPemesan" class="block font-semibold mb-2">Nama Pemesan</label>
                <input type="text" id="namaPemesan" name="nama_pemesan" required
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
                <label for="noTelpon" class="block font-semibold mb-2">No. Telpon</label>
                <input type="text" id="noTelpon" name="no_Telpon" required
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
                <label for="jumlahIkan" class="block font-semibold mb-2">Jumlah Ikan</label>
                <input type="number" id="jumlahIkan" name="jumlah_ikan" required min="1"
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
                <label for="totalHarga" class="block font-semibold mb-2">Total Harga</label>
                <input type="text" id="totalHarga" name="total_harga" readonly
                    class="w-full border rounded-lg px-4 py-2 bg-gray-100 font-semibold">
            </div>

            <div>
                <p class="font-semibold mb-2">Kirim Pesanan Via:</p>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="metode_kirim" value="wa" checked>
                    <span>WhatsApp</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-blue-700 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition">
                Kirim Pesanan
            </button>
        </form>
    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-blue-900 text-white text-center text-sm py-4 mt-10">
        <p>©️ 2025 Perikanan Kab. Banyuwangi - All rights reserved. | Created by PBL Kelompok 1.</p>
    </footer>

    <!-- 🔹 SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const hargaIkan = {
            "Nila Gift": 15000,
            "Nila Hitam": 12000,
            "Gurame": 25000,
            "Tombro": 18000,
            "Koi": 50000
        };

        const jenisBibit = document.getElementById("jenis_bibit");
        const jumlahIkan = document.getElementById("jumlahIkan");
        const totalHarga = document.getElementById("totalHarga");

        function hitungTotal() {
            const ikan = jenisBibit.value;
            const jumlah = parseInt(jumlahIkan.value) || 0;
            if (ikan && hargaIkan[ikan]) {
                const total = hargaIkan[ikan] * jumlah;
                totalHarga.value = "Rp " + total.toLocaleString("id-ID");
            } else {
                totalHarga.value = "";
            }
        }

        jenisBibit.addEventListener("change", hitungTotal);
        jumlahIkan.addEventListener("input", hitungTotal);

        document.getElementById("formOrder").addEventListener("submit", function(e) {
            e.preventDefault();
            const nama = document.getElementById("namaPemesan").value;
            const telp = document.getElementById("noTelpon").value;
            const ikan = jenisBibit.value;
            const jumlah = jumlahIkan.value;
            const total = totalHarga.value;
            const nomorWA = "6281237878334";

            const pesan =
                `Halo, saya ingin memesan ikan:\n\n👤 Nama: ${nama}\n📞 No. Telp: ${telp}\n🐟 Jenis Ikan: ${ikan}\n🔢 Jumlah: ${jumlah}\n💰 Total: ${total}\n\nMohon konfirmasinya.`;
            const url = `https://wa.me/${nomorWA}?text=${encodeURIComponent(pesan)}`;
            window.open(url, "_blank");

            Swal.fire({
                icon: 'success',
                title: 'Pesanan berhasil dikirim via WhatsApp!',
                timer: 2500,
                showConfirmButton: false
            });
        });
    </script>
</body>

</html>
