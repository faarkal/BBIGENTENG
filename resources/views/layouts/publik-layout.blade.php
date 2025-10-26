<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Balai Usaha Perikanan Genteng' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50">

    {{-- Navbar --}}
    @include('layouts.navbar-publik')

    {{-- Konten --}}
    <main class="pt-24 pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content') {{-- <== ini menggantikan {{ $slot }} --}}
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer-publik')

</body>
</html>
