@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Monitoring Mingguan</h1>

    {{-- Form Monitoring --}}
    <form action="{{ route('admin.monitoring.update', $monitoring->id) }}" method="POST" class="mb-10">
        @csrf
        @method('PUT')

        {{-- Tanggal Monitoring --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal Monitoring</label>
            <input type="date" name="tanggal"
                   value="{{ old('tanggal', $monitoring->tanggal) }}"
                   class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400" required>
        </div>

        {{-- Jenis Ikan --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Jenis Ikan</label>
            <select name="master_benih_id" class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400" required>
                <option value="">-- Pilih Jenis Ikan --</option>
                @foreach ($jenisIkan as $ikan)
                    <option value="{{ $ikan->id }}"
                        {{ $monitoring->master_benih_id == $ikan->id ? 'selected' : '' }}>
                        {{ $ikan->jenis_ikan }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kolam --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Kolam</label>
            <input type="text" name="kolam"
                   value="{{ old('kolam', $monitoring->kolam) }}"
                   placeholder="Contoh: Kolam A1"
                   class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400" required>
        </div>

        {{-- Data Monitoring Mingguan --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- 🌱 Bibit Awal --}}
            <div>
                <label class="block font-semibold mb-1">Bibit Awal</label>
                <input type="number" name="bibit_awal"
                       value="{{ old('bibit_awal', $monitoring->bibit_awal) }}"
                       class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400" required>
            </div>

            {{-- Ukuran (cm) --}}
            <div>
                <label class="block font-semibold mb-1">Ukuran (cm)</label>
                <input type="text" name="ukuran"
                       value="{{ old('ukuran', $monitoring->ukuran) }}"
                       placeholder="Contoh: 3.5"
                       class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Kematian Bibit --}}
            <div>
                <label class="block font-semibold mb-1">Kematian Bibit</label>
                <input type="number" name="kematian_bibit"
                       value="{{ old('kematian_bibit', $monitoring->kematian_bibit) }}"
                       class="border rounded w-full p-2 focus:ring-2 focus:ring-blue-400" required>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex items-center">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.monitoring.index') }}"
               class="ml-3 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>

   {{-- 🔹 Hasil Monitoring Berdasarkan Jenis Ikan --}}
<div class="bg-white rounded-xl shadow-md p-5 border border-gray-200">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">
        Hasil Monitoring - {{ $monitoring->masterBenih->jenis_ikan ?? '-' }}
    </h2>

    @if($mingguan->isEmpty())
        <p class="text-gray-500">Belum ada data monitoring untuk jenis ikan ini.</p>
    @else
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-blue-100 text-left">
                    <th class="py-2 px-3 border">Tanggal</th>
                    <th class="py-2 px-3 border">Kolam</th>
                    <th class="py-2 px-3 border">Bibit Awal</th>
                    <th class="py-2 px-3 border">Kematian</th>
                    <th class="py-2 px-3 border">Ukuran (cm)</th>
                    <th class="py-2 px-3 border">Jumlah Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mingguan as $m)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3 border">{{ \Carbon\Carbon::parse($m->tanggal)->format('d M Y') }}</td>
                        <td class="py-2 px-3 border">{{ $m->kolam }}</td>
                        <td class="py-2 px-3 border">{{ number_format($m->bibit_awal) }}</td>
                        <td class="py-2 px-3 border text-red-600">{{ number_format($m->kematian_bibit ?? 0) }}</td>
                        <td class="py-2 px-3 border">{{ $m->ukuran ?? '-' }}</td>
                        <td class="py-2 px-3 border text-green-700 font-semibold">
                            {{ number_format(($m->bibit_awal ?? 0) - ($m->kematian_bibit ?? 0)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</div>
@endsection
