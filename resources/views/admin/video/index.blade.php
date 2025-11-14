@extends('layouts.admin')

@section('content')
    <div class="p-8 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Daftar Video</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.videos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Upload Video Baru</a>

        <div class="mt-6">
            @foreach ($videos as $video)
                <div class="border p-4 mb-4 rounded-lg shadow-sm">
                    <h3 class="font-bold text-lg">{{ $video->judul }}</h3>
                    <p class="text-gray-600 mb-2">{{ $video->deskripsi }}</p>
                    <video controls class="w-full rounded-lg">
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                </div>
            @endforeach
        </div>
    </div>
@endsection
