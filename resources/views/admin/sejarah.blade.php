@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Edit Sejarah Balai</h2>

        <form action="{{ route('admin.sejarah.update') }}" method="POST">
            @csrf
            <textarea name="isi" rows="10" class="w-full border rounded p-3">{{ old('isi', $sejarah->isi ?? '') }}</textarea>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
