@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">
        {{ $masterBenih->exists ? '✏️ Edit Data Master Benih' : '➕ Tambah Data Master Benih' }}
    </h1>

    <form action="{{ $masterBenih->exists ? route('admin.master-benih.update', $masterBenih->id) : route('admin.master-benih.store') }}" method="POST" class="space-y-4">
        @csrf
        @if($masterBenih->exists)
            @method('PUT')
        @endif

        <div>
            <label class="block font-semibold">Jenis Ikan</label>
            <input type="text" name="jenis_ikan" value="{{ old('jenis_ikan', $masterBenih->jenis_ikan) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Jumlah Benih</label>
                <input type="number" name="jumlah_benih" value="{{ old('jumlah_benih', $masterBenih->jumlah_benih) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Ukuran (cm)</label>
                <input type="number" step="0.1" name="ukuran" value="{{ old('ukuran', $masterBenih->ukuran) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Restoking</label>
                <input type="number" name="restocking" value="{{ old('restocking', $masterBenih->restocking) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Harga Per Ekor (Rp)</label>
                <input type="number" step="0.01" name="harga_perekor" value="{{ old('harga_perekor', $masterBenih->harga_perekor) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Kematian Benih (%)</label>
                <input type="number" step="0.01" name="kematian_benih" value="{{ old('kematian_benih', $masterBenih->kematian_benih) }}" class="w-full border p-2 rounded">
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection
