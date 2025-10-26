<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Balai Usaha Perikanan Genteng' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,600,400italic,700' rel='stylesheet'
        type='text/css'>

    <style>
        body {
            font-family: 'Raleway', sans-serif;
        }

        /* Scrollbar halus */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- NAVBAR -->
    @include('layouts.navbar-publik')

    <!-- KONTEN UTAMA -->
    <main class="pt-24 pb-12"> {{-- ini memberi jarak di bawah navbar --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <!-- FOOTER -->
    @include('layouts.footer-publik')

</body>

</html>
