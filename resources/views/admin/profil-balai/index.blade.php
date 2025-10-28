@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-blue-800">Kelola Profil Balai</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profil-balai.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi Profil</label>
            <textarea name="deskripsi" id="deskripsi" rows="8" class="w-full border rounded p-3">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
