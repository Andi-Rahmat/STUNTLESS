<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>@yield('title', 'Registrasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-pink-100 flex justify-center items-center">
    <div class="flex md:w-1/3 w-1/2  bg-white rounded-lg shadow-lg my-[50px]">
        <div class="w-full p-8">
            <h2 class="text-3xl font-bold mb-6 text-center">Registrasi</h2>
            <form action="{{ route('registrasi') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Nama
                    </label>
                    <input type="text" id="name" name="name" placeholder="sesuai di KTP" value="{{old('name')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('name')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-4">
                    <label for="tglLahir" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Tanggal Lahir
                    </label>
                    <div class="relative max-w-sm mb-4">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker id="default-datepicker" type="text" name="tglLahir" id="tglLahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-400 focus:border-pink-500 block w-full ps-10 p-3" placeholder="Select date">
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Alamat
                    </label>
                    <input type="text" id="alamat" name="alamat" placeholder="sesuai di KTP" value="{{old('alamat')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('alamat')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-4">
                    <label for="jenisKelamin" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Jenis Kelamin
                    </label>
                    <select name="jenisKelamin" id="jenisKelamin" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                        <option value="p" {{ old('jenisKelamin') == 'p' ? 'selected' : '' }}>Perempuan</option>
                        <option value="l" {{ old('jenisKelamin') == 'l' ? 'selected' : '' }}>Laki-Laki</option>
                    </select>
                </div>

                <!-- Jumlah Anak -->
                <div class="mb-4">
                    <label for="jumlahAnak" class="block text-sm font-medium text-gray-600"> 
                        <span class="text-sm text-red-600">*</span>Jumlah Anak
                    </label>
                    <input type="text" id="jumlahAnak" name="jumlahAnak" placeholder="Anak" value="{{old('jumlahAnak')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('jumlahAnak')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIK -->
                <div class="mb-4">
                    <label for="NIK" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> NIK
                    </label>
                    <input type="text" id="NIK" name="nik" placeholder="sesuai di KTP" value="{{old('nik')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('nik')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No Telp -->
                <div class="mb-4">
                    <label for="NoTelp" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> No. Telp
                    </label>
                    <input type="text" id="NoTelp" name="noTelp" placeholder="08xxxxx" value="{{old('noTelp')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('noTelp')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Email
                    </label>
                    <input type="text" id="email" name="email" placeholder="Email" value="{{old('email')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('email')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Password
                    </label>
                    <input type="password" id="password" placeholder="Password" value="{{old('Password')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label for="konfirmasiPass" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Konfirmasi Password
                    </label>
                    <input type="password" name="password" id="konfirmasiPass" placeholder="Konfirmasi Password" value="{{old('konfirmasiPass')}}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('password')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <p hidden id="teksPw" class="text-center text-sm mb-4 text-red-500">Password berbeda</p>
                    <button id="submit" type="submit" disabled class="w-full py-2 bg-pink-300 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Daftar
                    </button>
                    <p class="text-center text-sm mb-4 text-gray-500">Sudah punya akun ? <a href="/login" class="text-blue-600">Login</a></p>
                </div>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        const password = document.getElementById("password");
        const konfirmasiPass = document.getElementById("konfirmasiPass");
        const teksPw = document.getElementById("teksPw");
        const submitButton = document.getElementById("submit");
        konfirmasiPass.addEventListener("input", () => {
            teksPw.removeAttribute('hidden');

            if (password.value === konfirmasiPass.value) {
                teksPw.setAttribute('hidden', true);

                submitButton.removeAttribute('disabled');
                submitButton.classList.add('hover:bg-pink-400');
            } else {
                submitButton.setAttribute('disabled', true);
                submitButton.classList.remove('hover:bg-pink-400');

            }
        });
    </script>
</body>

</html>