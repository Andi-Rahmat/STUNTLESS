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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Styling untuk dropdown Select2 */
        .select2-container--default .select2-selection--single {
            height: 40px;
            /* Mengubah tinggi input */
            padding: 5px;
            /* Menambahkan padding di dalam input */
            border: 1px solid #ccc;
            /* Border khusus */
            border-radius: 8px;
            /* Membulatkan sudut */
        }

        /* Styling untuk dropdown options */
        .select2-container--default .select2-results__option {
            padding: 10px;
            /* Menambahkan padding pada pilihan */
        }

        /* Styling ketika dropdown difokuskan */
        .select2-container--default .select2-selection--single:focus {
            border-color: #ec4899;
            /* Warna border ketika fokus */
            box-shadow: 0 0 0 2px rgba(236, 72, 153, 0.5);
            /* Efek bayangan saat fokus */
        }
    </style>

</head>

<body class="bg-pink-100 flex justify-center items-center">
    <div class="flex md:w-1/3 w-1/2  bg-white rounded-lg shadow-lg my-[50px]">
        <div class="w-full p-8">
            <h2 class="text-3xl font-bold mb-6 text-center">Registrasi Balita</h2>
            <form action="{{ route('registrasi.balita') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-4">
                    <label for="namaLengkap" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Nama Lengkap
                    </label>
                    <input type="text" id="namaLengkap" name="namaLengkap" placeholder="Nama Lengkap" value="{{ old('namaLengkap') }}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('namaLengkap')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIK -->
                <div class="mb-4">
                    <label for="NIK" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> NIK
                    </label>
                    <input type="text" id="NIK" name="NIK" placeholder="Nomor Induk Kependudukan" value="{{ old('NIK') }}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('NIK')
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
                        <input datepicker id="tglLahir" type="text" name="tglLahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-400 focus:border-pink-500 block w-full ps-10 p-3" placeholder="Pilih Tanggal">
                    </div>
                </div>

                <!-- Anak Ke -->
                <div class="mb-4">
                    <label for="anakKe" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Anak Ke-
                    </label>
                    <input type="text" id="anakKe" name="anakKe" placeholder="Urutan Anak (contoh: 1, 2, 3)" value="{{ old('anakKe') }}" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                    @error('anakKe')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Golongan Darah -->
                <div class="mb-4">
                    <label for="golonganDarah" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span> Golongan Darah
                    </label>
                    <select name="golonganDarah" id="golonganDarah" class="w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                        <option value="A" {{ old('golonganDarah') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('golonganDarah') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ old('golonganDarah') == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ old('golonganDarah') == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                </div>

                <!-- ID Orang Tua -->
                <div class="mb-4">
                    <label for="idOrangTua" class="block text-sm font-medium text-gray-600">
                        <span class="text-sm text-red-600">*</span>Orang Tua
                    </label>
                    <select name="idOrangTua" id="idOrangTua" style="padding: 20px;" class="selectpicker mylabel w-full p-3 mb-2 border bg-gray-50 border-gray-300 focus:border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition-all duration-300">
                        <option value="" selected disabled>Pilih Orang Tua</option>
                        @foreach($orangTuaList as $orangTua)
                        <option value="{{ $orangTua->id }}" {{ old('idOrangTua') == $orangTua->id ? 'selected' : '' }}>
                            {{ $orangTua->namaLengkap }}
                        </option>
                        @endforeach
                    </select>
                    @error('idOrangTua')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-2 bg-pink-300 hover:bg-pink-400 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Daftar
                    </button>
                </div>
            </form>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.selectpicker').select2();
        });
    </script>
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
                submitButton.classList.add('hover:bg-red-400');
            } else {
                submitButton.setAttribute('disabled', true);
                submitButton.classList.remove('hover:bg-red-400');

            }
        });
    </script>
</body>

</html>