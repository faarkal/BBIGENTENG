<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Illustration -->
        <div class="hidden md:flex md:w-1/2 items-center justify-center bg-gray-100 p-0">
            <img src="{{ asset('backend/assets/images/ikan cupang.jpg') }}"
                 alt="Forgot Password Illustration"
                 class="w-full h-full object-cover">
        </div>
        <!-- Forgot Password Form -->
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-bold mb-2">Forgot Password</h2>
            <p class="mb-4 text-gray-600 text-sm">Enter your email address and we'll send you a link to reset your password.</p>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded mb-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            @if (Session::has('error'))
                <div class="bg-red-100 text-red-700 p-2 rounded mb-2 text-sm">
                    <li>{{ Session::get('error') }}</li>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-2 text-sm">
                    <li>{{ Session::get('success') }}</li>
                </div>
            @endif

            <form action="{{ route('admin.password_submit') }}" method="POST" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Email address" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">Send Reset Link</button>
            </form>
            <div class="mt-4 text-center">
                <a href="{{ route('admin.login') }}" class="text-indigo-600 text-sm hover:underline"><i class="fas fa-arrow-left mr-1"></i>Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>