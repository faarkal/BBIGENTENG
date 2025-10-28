@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-blue-800">Kelola Visi & Misi</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.visi-misi.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="visi" class="block text-gray-700 font-semibold mb-2">Visi</label>
                <textarea name="visi" id="visi" rows="4" class="w-full border rounded p-3">{{ old('visi', $visiMisi->visi ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="misi" class="block text-gray-700 font-semibold mb-2">Misi</label>
                <textarea name="misi" id="misi" rows="6" class="w-full border rounded p-3">{{ old('misi', $visiMisi->misi ?? '') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
