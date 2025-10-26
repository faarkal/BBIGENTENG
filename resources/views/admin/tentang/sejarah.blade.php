@extends('layouts.admin') {{-- pastikan layouts.admin ada --}}

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Edit Sejarah</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.sejarah.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul (opsional)</label>
            <input type="text" name="judul" class="w-full border rounded p-2"
                   value="{{ old('judul', $sejarah->judul ?? '') }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Sejarah</label>
            <textarea name="isi" rows="10" class="w-full border rounded p-3" required>{{ old('isi', $sejarah->isi ?? '') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
