@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-blue-800 mb-6">📋 Data Master Benih Ikan</h1>

        <a href="{{ route('admin.master-benih.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Jenis Ikan
        </a>

        @if (session('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        <table class="min-w-full bg-white mt-6 border border-gray-300">
            <thead class="bg-blue-100 text-blue-900">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Jenis Ikan</th>
                    <th class="p-3 text-left">Jumlah Benih</th>
                    <th class="p-3 text-left">Ukuran (cm)</th>
                    <th class="p-3 text-left">Restoking</th>
                    <th class="p-3 text-left">Harga/Ekor (Rp)</th>
                    <th class="p-3 text-left">Kematian Benih (%)</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($masterBenih as $b)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $b->jenis_ikan }}</td>
                        <td class="p-3">{{ number_format($b->jumlah_benih) }}</td>
                        <td class="p-3">{{ $b->ukuran }}</td>
                        <td class="p-3">{{ $b->restocking }}</td>
                        <td class="p-3">Rp {{ number_format($b->harga_perekor, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $b->kematian_benih }}%</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.master-benih.edit', $b->id) }}"
                                class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.master-benih.destroy', $b->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')"
                                    class="text-red-600 hover:underline">Hapus</button>
                            </form>

                            {{-- 🔹 Tombol langsung gunakan --}}
                            <a href="{{ route('admin.benih.create') }}?jenis={{ urlencode($b->jenis_ikan) }}"
                                class="text-green-600 hover:underline ml-2">Gunakan Data Ini</a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center p-4 text-gray-500">Belum ada data master benih.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
