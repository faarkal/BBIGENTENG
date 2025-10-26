@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-blue-800 mb-6">➕ Tambah Data Master Benih Ikan</h1>

        <form action="{{ route('admin.master-benih.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Jenis Ikan</label>
                    <input type="text" name="jenis_ikan" value="{{ old('jenis_ikan') }}"
                        class="w-full border rounded p-2" required>
                    @error('jenis_ikan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Jumlah Benih</label>
                    <input type="number" name="jumlah_benih" value="{{ old('jumlah_benih') }}"
                        class="w-full border rounded p-2" required>
                    @error('jumlah_benih')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Ukuran (cm)</label>
                    <input type="number" step="0.1" name="ukuran" value="{{ old('ukuran') }}"
                        class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-gray-700">Restoking</label>
                    <input type="number" name="restocking" value="{{ old('restocking') }}"
                        class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-gray-700">Harga per Ekor (Rp)</label>
                    <input type="number" step="0.01" name="harga_perekor" value="{{ old('harga_perekor') }}"
                        class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-gray-700">Kematian Benih (%)</label>
                    <input type="number" step="0.1" name="kematian_benih" value="{{ old('kematian_benih') }}"
                        class="w-full border rounded p-2">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.master-benih.index') }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection
