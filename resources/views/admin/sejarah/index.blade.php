@extends('layouts.admin')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Kelola Sejarah Balai</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('admin/sejarah/update') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Isi Sejarah:</label>
                <textarea name="isi" rows="10" class="w-full border border-gray-300 rounded p-3 focus:ring focus:ring-blue-300">{{ $sejarah->isi ?? '' }}</textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Simpan
            </button>
        </form>
    </div>
@endsection
