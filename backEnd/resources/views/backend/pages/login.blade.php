<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>@yield('title', 'Login IONIC25')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-pink-100 flex justify-center items-center h-screen">
    <div class="flex w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Left Side (Login) -->
        <div class="w-full sm:w-1/2 p-8">
            <h2 class="text-3xl font-bold mb-6">Sign in</h2>
            <div class="flex justify-around mb-6">
                <button class="p-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300">
                    <i class="fab fa-facebook"></i>
                </button>
                <button class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition-all duration-300">
                    <i class="fab fa-google"></i>
                </button>
                <button class="p-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-all duration-300">
                    <i class="fab fa-linkedin"></i>
                </button>
            </div>
            <p class="text-center mb-4">atau gunakan akun anda</p>
            <form>
                <input type="email" placeholder="Email" class="w-full p-3 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                <input type="password" placeholder="Password" class="w-full p-3 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                <p class="text-right text-sm mb-4 text-gray-500"><a href="#">Lupa kata sandi anda?</a></p>
                <button type="submit" class="w-full py-3 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all duration-300">SIGN IN</button>
            </form>
        </div>

        <!-- Right Side (Sign Up) -->
        <div class="w-full sm:w-1/2 bg-pink-500 text-white flex flex-col justify-center items-center p-8 sm:rounded-r-lg">
            <h2 class="text-3xl font-bold mb-6">Halo, Teman!</h2>
            <p class="text-lg mb-6 text-center">Daftarkan diri anda dan mulai gunakan layanan kami segera</p>
            <a href="#" class="bg-white text-pink-600 py-3 px-8 rounded-lg text-lg hover:bg-pink-100 transition-all duration-300">SIGN UP</a>
        </div>
    </div>

    <!-- Tailwind CSS for icons (Font Awesome) -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>