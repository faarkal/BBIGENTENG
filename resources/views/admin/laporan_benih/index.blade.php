@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">📄 Laporan Benih Ikan</h1>

        {{-- 🔹 Form Upload --}}
        <form action="{{ route('admin.laporan-benih.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow mb-6">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama File</label>
                <input type="text" name="nama_file" class="border rounded w-full px-3 py-2"
                    placeholder="Contoh: Laporan Benih Ikan Bulan Oktober 2025" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">File Laporan</label>
                <input type="file" name="file_path" class="border rounded w-full px-3 py-2"
                    accept=".pdf,.doc,.docx,.xls,.xlsx" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Bulan Pelaporan</label>
                <input type="date" name="periode_pelaporan" class="border rounded w-full px-3 py-2" required>
            </div>

            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                <i class="fa-solid fa-upload mr-2"></i> Upload
            </button>
        </form>

        {{-- 🔍 Filter --}}
        <form method="GET" class="flex flex-wrap justify-end mb-8 space-x-3">
            <select name="bulan" class="border rounded px-3 py-2">
                <option value="">Semua Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>

            <select name="tahun" class="border rounded px-3 py-2">
                @foreach ($daftarTahun as $t)
                    <option value="{{ $t }}" {{ request('tahun', $tahun) == $t ? 'selected' : '' }}>
                        {{ $t }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>
        </form>


        {{-- 🔹 Tabel Laporan --}}
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama File</th>
                        <th class="px-4 py-2 text-center">Periode</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $item)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $item->nama_file }}</td>

                            {{-- 🗓️ Tampilkan tanggal dalam format Indonesia tanpa jam --}}
                            <td class="px-4 py-2 text-center">
                                {{ \Carbon\Carbon::parse($item->periode_pelaporan)->locale('id')->translatedFormat('d F Y') }}
                            </td>

                            {{-- 🔘 Tombol Aksi dengan jarak antar tombol --}}
                            <td class="px-4 py-2 text-center space-x-2">
                                {{-- 🔵 Lihat --}}
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 inline-block">
                                    <i class="fa-solid fa-eye mr-1"></i>Lihat
                                </a>

                                {{-- 🟢 Download --}}
                                <a href="{{ asset('storage/' . $item->file_path) }}" download
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 inline-block">
                                    <i class="fa-solid fa-download mr-1"></i>Download
                                </a>

                                {{-- 🔴 Hapus --}}
                                <form action="{{ route('admin.laporan-benih.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 inline-block">
                                        <i class="fa-solid fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-4">
                                Belum ada laporan yang diunggah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>


            </table>
        </div>

    </div>
@endsection
