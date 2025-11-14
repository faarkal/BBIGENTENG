@extends('layouts.admin')

@section('content')
<div class="p-8 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Upload Video Aktivitas</h2>

    <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Video</label>
            <input type="text" name="judul" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi (opsional)</label>
            <textarea name="deskripsi" class="border rounded w-full p-2"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">File Video</label>
            <input type="file" name="file" accept="video/*" class="border rounded w-full p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload</button>
    </form>
</div>
@endsection
