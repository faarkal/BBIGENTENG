@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-blue-800 mb-6">
            {{ $benih->exists ? 'Edit Data Benih' : 'Tambah Data Benih' }}
        </h1>

        <form action="{{ $benih->exists ? route('admin.benih.update', $benih->id) : route('admin.benih.store') }}"
            method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf
            @if ($benih->exists)
                @method('PUT')
            @endif

            {{-- Input Jenis & Bulan --}}
            <div>
                <label class="block text-gray-700 font-semibold">Jenis Benih</label>
                <select name="jenis_benih" id="jenis_benih"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                    <option value="">-- Pilih Jenis Ikan --</option>
                    @foreach ($masterBenih as $m)
                        <option value="{{ $m->jenis_ikan }}" data-ukuran="{{ $m->ukuran }}"
                            data-harga="{{ $m->harga_perekor }}" data-kematian="{{ $m->kematian_benih }}"
                            {{ old('jenis_benih', $benih->jenis_benih) == $m->jenis_ikan ? 'selected' : '' }}>
                            {{ $m->jenis_ikan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Bulan Menetas</label>
                <input type="date" name="bulan_menetas" value="{{ old('bulan_menetas', $benih->bulan_menetas) }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
            </div>

            {{-- Grid kolom utama --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Ukuran (cm)</label>
                    <input type="number" step="0.1" name="ukuran_benih"
                        value="{{ old('ukuran_benih', $benih->ukuran_benih) }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Jumlah (ekor)</label>
                    <input type="number" name="jumlah_benih" id="jumlah_benih"
                        value="{{ old('jumlah_benih', $benih->jumlah_benih) }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Restocking (ekor)</label>
                    <input type="number" name="restocking" id="restocking"
                        value="{{ old('restocking', $benih->restocking) }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Kematian (%)</label>
                    <input type="number" step="0.01" name="kematian_benih" id="kematian_benih"
                        value="{{ old('kematian_benih', $benih->kematian_benih) }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Harga per Ekor (Rp)</label>
                    <input type="number" name="harga_benih" id="harga_benih"
                        value="{{ old('harga_benih', $benih->harga_benih) }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                </div>
            </div>

            {{-- Hasil perhitungan otomatis --}}
            <div class="mt-6 border-t pt-4">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">📊 Hasil Perhitungan Otomatis</h2>
                <div class="grid grid-cols-3 gap-4 text-gray-800">
                    <div class="p-3 bg-blue-50 rounded">
                        <p class="text-sm text-gray-500">Benih Hidup Setelah Kematian</p>
                        <p id="hasil_hidup" class="text-xl font-bold">0 ekor</p>
                    </div>
                    <div class="p-3 bg-green-50 rounded">
                        <p class="text-sm text-gray-500">Total Setelah Restocking</p>
                        <p id="hasil_restock" class="text-xl font-bold">0 ekor</p>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded">
                        <p class="text-sm text-gray-500">Total Harga Keseluruhan</p>
                        <p id="hasil_total" class="text-xl font-bold">Rp 0</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.benih.index') }}"
                    class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ $benih->exists ? 'Update Data' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>

    {{-- SCRIPT PERHITUNGAN OTOMATIS --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const jumlahInput = document.getElementById("jumlah_benih");
            const kematianInput = document.getElementById("kematian_benih");
            const restockInput = document.getElementById("restocking");
            const hargaInput = document.getElementById("harga_benih");

            const hasilHidup = document.getElementById("hasil_hidup");
            const hasilRestock = document.getElementById("hasil_restock");
            const hasilTotal = document.getElementById("hasil_total");

            function hitung() {
                const jumlah = parseFloat(jumlahInput.value) || 0;
                const kematian = parseFloat(kematianInput.value) || 0;
                const restock = parseFloat(restockInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;

                const hidup = jumlah - (jumlah * (kematian / 100));
                const totalAkhir = hidup + restock;
                const totalHarga = totalAkhir * harga;

                hasilHidup.textContent = `${Math.round(hidup).toLocaleString()} ekor`;
                hasilRestock.textContent = `${Math.round(totalAkhir).toLocaleString()} ekor`;
                hasilTotal.textContent = `Rp ${Math.round(totalHarga).toLocaleString('id-ID')}`;
            }

            [jumlahInput, kematianInput, restockInput, hargaInput].forEach(el => {
                el.addEventListener('input', hitung);
            });

            hitung(); // jalankan saat halaman pertama kali dibuka
        });
    </script>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const jenisSelect = document.getElementById("jenis_benih");
        const ukuranInput = document.querySelector("input[name='ukuran_benih']");
        const hargaInput = document.querySelector("input[name='harga_benih']");
        const kematianInput = document.querySelector("input[name='kematian_benih']");

        jenisSelect.addEventListener("change", () => {
            const selected = jenisSelect.options[jenisSelect.selectedIndex];
            ukuranInput.value = selected.getAttribute("data-ukuran") || "";
            hargaInput.value = selected.getAttribute("data-harga") || "";
            kematianInput.value = selected.getAttribute("data-kematian") || "";
        });
    });
</script>
