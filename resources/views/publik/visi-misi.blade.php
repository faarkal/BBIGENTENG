@extends('layouts.publik-layout')

@section('content')
<div class="container mx-auto mt-28 px-6">
    <h1 class="text-4xl font-bold text-blue-900 mb-6 text-center">Visi & Misi Balai Usaha Perikanan Genteng</h1>

    @if ($visiMisi)
        <div class="prose max-w-none text-gray-800 leading-relaxed">
            <h2 class="text-2xl font-semibold text-blue-800 mb-2">Visi</h2>
            <p>{!! nl2br(e($visiMisi->visi)) !!}</p>

            <h2 class="text-2xl font-semibold text-blue-800 mt-6 mb-2">Misi</h2>
            <p>{!! nl2br(e($visiMisi->misi)) !!}</p>
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada data visi & misi yang tersedia.</p>
    @endif
</div>
@endsection
