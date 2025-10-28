@extends('layouts.publik-layout')

@section('content')
<div class="container mx-auto mt-28 px-6">
    <h1 class="text-4xl font-bold text-blue-900 mb-6 text-center">Sejarah Balai Usaha Perikanan Genteng</h1>

    @if ($sejarah)
        <div class="prose max-w-none text-gray-800 leading-relaxed">
            <p>{!! nl2br(e($sejarah->isi)) !!}</p>
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada data sejarah yang tersedia.</p>
    @endif
</div>
@endsection
