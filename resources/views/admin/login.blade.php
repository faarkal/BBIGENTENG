<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Illustration -->
        <div class="hidden md:flex md:w-1/2 items-center justify-center bg-gray-100 p-0">
    <img src="{{ asset('backend/assets/images/ikan cupang.jpg') }}"
         alt="Login Illustration"
         class="w-full h-full object-cover">
       </div>
        <!-- Login Form -->
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-bold mb-2">Sign In Admin</h2>

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

            <form action="{{ route('admin.login_submit') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="email" placeholder="Username" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="{{ route('admin.forget_password') }}" class="text-indigo-600 text-sm hover:underline">Forgot Password</a>
                </div>
                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">Log In</button>
            </form>
            <div class="my-4 text-center text-gray-400">— or login with —</div>
            <div class="flex justify-center space-x-4">

                <a href="{{ route('google.auth') }}" class="bg-red-500 text-white rounded-full p-3 hover:bg-red-600 transition"><i class="fab fa-google"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
