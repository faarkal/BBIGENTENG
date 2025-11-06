@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Tambah Data Monitoring</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.monitoring.store') }}" method="POST"
          class="bg-white p-6 rounded-lg shadow space-y-5 border border-gray-200">
        @csrf

        {{-- Tanggal Monitoring --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Bibit Lahir</label>
            <input type="date" name="tanggal"
                value="{{ old('tanggal', now()->toDateString()) }}"
                required
                class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-blue-500 focus:border-blue-500" />
            @error('tanggal')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Jenis Bibit (Master Benih) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Bibit</label>
            <select name="master_benih_id" required
                    class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Jenis Bibit --</option>
                @foreach ($jenisIkan as $ji)
                    <option value="{{ $ji->id }}" {{ old('master_benih_id') == $ji->id ? 'selected' : '' }}>
                        {{ $ji->jenis_ikan }}
                    </option>
                @endforeach
            </select>
            @error('master_benih_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kolam --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kolam</label>
            <input type="text" name="kolam" value="{{ old('kolam') }}" required
                   placeholder="Kolam A1"
                   class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-blue-500 focus:border-blue-500" />
            @error('kolam')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Bibit Awal --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bibit Awal</label>
            <input type="number" name="bibit_awal" min="0" value="{{ old('bibit_awal', 0) }}" required
                   class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-blue-500 focus:border-blue-500" />
            @error('bibit_awal')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="pt-4 flex items-center gap-3">
            <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Simpan Monitoring
            </button>
            <a href="{{ route('admin.monitoring.index') }}"
               class="text-gray-600 hover:underline text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
