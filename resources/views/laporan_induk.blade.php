@extends('layouts.publik-layout')

@php
    $tahunSekarang = $tahunSekarang ?? \Carbon\Carbon::now()->year;
@endphp

@section('content')
    <div class="container mx-auto mt-28 px-6">
        <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">📊 Laporan Induk Ikan Tahun {{ $tahunSekarang }}</h1>

        <form method="GET" class="flex flex-wrap justify-end mb-8 space-x-3">
            <select name="bulan" class="border rounded-lg px-4 py-2 shadow-sm">
                <option value="">-- Semua Bulan --</option>
                @foreach ($daftarBulan as $angka => $nama)
                    <option value="{{ $angka }}" {{ $angka == $bulanDipilih ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>

            <select name="tahun" class="border rounded-lg px-4 py-2 shadow-sm">
                @foreach ($daftarTahun as $tahun)
                    <option value="{{ $tahun }}" {{ $tahun == $tahunDipilih ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">
                Filter
            </button>
        </form>

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($laporan as $item)
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold text-lg text-gray-800">
                            <i class="fa-solid fa-file-lines text-blue-700 mr-2"></i>{{ $item->nama_file }}
                        </h3>
                        <span class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->periode_pelaporan)->translatedFormat('F Y') }}
                        </span>
                    </div>

                    <div class="flex space-x-3 mt-4">
                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            <i class="fa-solid fa-eye mr-1"></i> Lihat
                        </a>
                        <a href="{{ asset('storage/' . $item->file_path) }}" download
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                            <i class="fa-solid fa-download mr-1"></i> Download
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-600 py-6">
                    <i class="fa-solid fa-circle-info text-blue-600 mr-2"></i>
                    Belum ada laporan induk untuk tahun {{ $tahunSekarang }}.
                </div>
            @endforelse
        </div>
    </div>
@endsection
