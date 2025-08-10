<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>@yield('title', 'Registrasi IONIC25')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Pendaftaran Lomba</h2>

            <form action="{{ route('pendaftaran') }}" method="POST">
                @csrf

                <!-- Nama Peserta -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Peserta -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nomor telepon" value="{{ old('phone') }}" required>
                    @error('phone')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Lomba -->
                <div class="mb-4">
                    <label for="competition" class="block text-sm font-medium text-gray-600">Jenis Lomba</label>
                    <select id="competition" name="competition" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Jenis Lomba</option>
                        <option value="coding">Lomba Coding</option>
                        <option value="design">Lomba Desain</option>
                        <option value="writing">Lomba Menulis</option>
                        <!-- Tambahkan pilihan lomba lainnya sesuai kebutuhan -->
                    </select>
                    @error('competition')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Persetujuan Syarat dan Ketentuan -->
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="terms" name="terms" class="mr-2" required>
                    <label for="terms" class="text-sm text-gray-600">Saya setuju dengan <a href="#" class="text-blue-600">syarat dan ketentuan</a></label>
                </div>

                <!-- Tombol Pendaftaran -->
                <div>
                    <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Daftar Lomba</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>