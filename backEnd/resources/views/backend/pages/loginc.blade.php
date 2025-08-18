<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>@yield('title', 'Login STUNTLESS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-pink-100 flex justify-center items-center h-screen">
    <div class="flex w-1/4 bg-white rounded-lg shadow-lg">
        <div class="w-full p-8">
            <h2 class="text-3xl font-bold mb-6 text-center">Sign in</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" placeholder="Email" class="w-full p-3 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('email')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" placeholder="Password" class="w-full p-3 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('password')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                    <p class="text-right text-sm mb-4 text-gray-500"><a href="#">Lupa kata sandi anda?</a></p>

                <div>
                    <button type="submit" class="w-full py-2 bg-red-300 text-white rounded-md hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-blue-500">Sign In</button>
                </div>

                <p class="text-center text-sm mb-4 text-gray-500">Belum punya akun ? <a href="/registrasi" class="text-blue-600">Daftar</a></p>
            </form>
        </div>
    </div>

</body>

</html>