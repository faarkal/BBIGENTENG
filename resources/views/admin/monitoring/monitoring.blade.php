@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Monitoring Mingguan - {{ $monitoring->masterBenih->jenis_ikan ?? '-' }}</h1>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Monitoring Baru --}}
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200 mb-8">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">Monitoring Data Mingguan</h2>

        <form action="{{ route('admin.monitoring.update', $monitoring->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Tanggal Monitoring --}}
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Tanggal Monitoring</label>
                    <input type="date" name="tanggal"
                        value="{{ old('tanggal', \Carbon\Carbon::parse($monitoring->tanggal)->format('Y-m-d')) }}"
                        class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400 @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Jenis Ikan --}}
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Jenis Ikan</label>
                    <select name="master_benih_id"
                            class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400 @error('master_benih_id') border-red-500 @enderror"
                            required>
                        <option value="">-- Pilih Jenis Ikan --</option>
                        @foreach ($jenisIkan as $ikan)
                            <option value="{{ $ikan->id }}"
                                {{ (old('master_benih_id', $monitoring->master_benih_id) == $ikan->id) ? 'selected' : '' }}>
                                {{ $ikan->jenis_ikan }}
                            </option>
                        @endforeach
                    </select>
                    @error('master_benih_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Kolam --}}
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Kolam</label>
                    <input type="text" name="kolam"
                        value="{{ old('kolam', $monitoring->kolam) }}"
                        class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400 @error('kolam') border-red-500 @enderror"
                        required>
                    @error('kolam')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Bibit Awal --}}
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Bibit Awal</label>
                    <input type="number" name="bibit_awal"
                        value="{{ old('bibit_awal', $monitoring->bibit_awal) }}"
                        class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400 @error('bibit_awal') border-red-500 @enderror"
                        required>
                    @error('bibit_awal')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Ukuran (cm) --}}
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Ukuran (cm)</label>
                    <input type="text" name="ukuran"
                        value="{{ old('ukuran', $monitoring->ukuran) }}"
                        placeholder="Contoh: 3.5"
                        class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400">
                </div>

                {{-- Kematian Bibit --}}
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Kematian Bibit</label>
                    <input type="number" name="kematian_bibit"
                        value="{{ old('kematian_bibit', $monitoring->kematian_bibit ?? 0) }}"
                        min="0"
                        class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400 @error('kematian_bibit') border-red-500 @enderror">
                    @error('kematian_bibit')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Jumlah Akhir --}}
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Jumlah Akhir</label>
                    <input type="number" name="jumlah_akhir"
                        value="{{ old('jumlah_akhir', ($monitoring->bibit_awal ?? 0) - ($monitoring->kematian_bibit ?? 0)) }}"
                        readonly
                        class="border rounded w-full p-2 bg-gray-100 text-green-700 font-bold">
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex items-center gap-3">
                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition font-semibold">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </button>
                <a href="{{ route('admin.monitoring.index') }}"
                   class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500 transition font-semibold">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>

    {{-- 🔹 Tabel Hasil Monitoring Berdasarkan Kolam --}}
    <div class="bg-white rounded-xl shadow-md p-5 border border-gray-200">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">
            <i class="fas fa-chart-line mr-2"></i>Riwayat Monitoring - Kolam {{ $monitoring->kolam }}
        </h2>

        @if($mingguan->isEmpty())
            <p class="text-gray-500 text-center py-4">Belum ada data monitoring untuk kolam ini.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="py-3 px-4 border text-left">Tanggal</th>
                            <th class="py-3 px-4 border text-left">Jenis Ikan</th>
                            <th class="py-3 px-4 border text-right">Bibit Awal</th>
                            <th class="py-3 px-4 border text-right">Kematian</th>
                            <th class="py-3 px-4 border text-right">Ukuran (cm)</th>
                            <th class="py-3 px-4 border text-right">Jumlah Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mingguan as $m)
                            <tr class="border-b hover:bg-blue-50 transition">
                                <td class="py-3 px-4 border font-semibold">
                                    {{ \Carbon\Carbon::parse($m->tanggal)->format('d M Y') }}
                                </td>
                                <td class="py-3 px-4 border">{{ $m->masterBenih->jenis_ikan ?? '-' }}</td>
                                <td class="py-3 px-4 border text-right font-semibold">{{ number_format($m->bibit_awal) }}</td>
                                <td class="py-3 px-4 border text-right text-red-600 font-semibold">
                                    {{ number_format($m->kematian_bibit ?? 0) }}
                                </td>
                                <td class="py-3 px-4 border text-right">{{ $m->ukuran ?? '-' }}</td>
                                <td class="py-3 px-4 border text-right text-green-700 font-bold text-lg">
                                    {{ number_format(($m->jumlah_akhir ?? ($m->bibit_awal ?? 0) - ($m->kematian_bibit ?? 0))) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Filter Bulan --}}
    <div class="mb-4 flex items-center justify-between gap-4">
        <form method="GET" class="flex items-center gap-2">
            <label class="font-medium text-gray-700">Pilih Bulan:</label>
            <input type="month" name="month" value="{{ $selectedMonth ?? now()->format('Y-m') }}"
                   class="border rounded p-2" onchange="this.form.submit()">
        </form>

        <div>
            <a href="{{ route('admin.monitoring.monitoring', $monitoring->id) }}"
               class="text-sm text-blue-600 hover:underline">Reset</a>
        </div>
    </div>
</div>
@endsection
