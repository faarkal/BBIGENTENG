@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">📦 Data Pemesanan Benih Ikan</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-blue-100 text-blue-900">
            <tr>
                <th class="p-3 text-left">No.</th>
                <th class="p-3 text-left">Nama Pemesan</th>
                <th class="p-3 text-left">Jenis Ikan</th>
                <th class="p-3 text-left">Jumlah</th>
                <th class="p-3 text-left">Total Harga</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemesanan as $p)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $p->nama_pemesan }}</td>
                    <td class="p-3">{{ $p->jenis_bibit }}</td>
                    <td class="p-3">{{ $p->jumlah_ikan }}</td>
                    <td class="p-3">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm
                            {{ $p->status == 'Diterima' ? 'bg-green-200 text-green-800' :
                               ($p->status == 'Ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="p-3 space-x-2">
                        @if($p->status == 'Menunggu Konfirmasi')
                            <form action="{{ route('admin.pemesanan.konfirmasi', $p->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">✔ Terima</button>
                            </form>
                            <form action="{{ route('admin.pemesanan.tolak', $p->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">✖ Tolak</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
