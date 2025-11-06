@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Daftar Monitoring Bibit</h1>

    <a href="{{ route('admin.monitoring.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block mb-6">
       + Tambah Monitoring
    </a>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($monitorings->isEmpty())
        <p class="text-gray-500">Belum ada data monitoring.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($monitorings as $data)
                <div class="bg-white shadow-lg rounded-2xl p-5 border border-gray-200 hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-blue-700 mb-2">
                        {{ $data->masterBenih->jenis_ikan ?? 'Tidak Diketahui' }}
                    </h2>
                    <p class="text-gray-600 mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') }}</p>
                    <p class="text-gray-600 mb-1"><strong>Kolam:</strong> {{ ucfirst($data->kolam) }}</p>
                    <p class="text-gray-600 mb-3"><strong>Bibit Awal:</strong> {{ number_format($data->bibit_awal) }}</p>

                    <div class="flex justify-between mt-3">
                        <a href="{{ route('admin.monitoring.monitoring', $data->id) }}"
                           class="text-blue-600 hover:underline">Monitoring</a>

                        <form action="{{ route('admin.monitoring.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
