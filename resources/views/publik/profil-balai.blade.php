@extends('layouts.publik-layout')

@section('content')
<div class="container mx-auto mt-28 px-6">
    <h1 class="text-4xl font-bold text-blue-900 mb-6 text-center">Profil Balai Usaha Perikanan Genteng</h1>

    @if ($profil)
        <div class="prose max-w-none text-gray-800 leading-relaxed">
            {!! nl2br(e($profil->deskripsi)) !!}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada data profil balai yang tersedia.</p>
    @endif
</div>
@endsection
