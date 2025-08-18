<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrasi STUNTLESS</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous" />
</head>

<body>
    <div
        style="background-color: #ffb8e0; min-width: 100vw; min-height: 100vh"
        class="d-flex justify-content-center align-items-center">
        <div class="card mt-2 mb-2" style="max-width: 80%">
            <div class="card-body">
                <div class="row flex-column flex-lg-row px-3">
                    <div
                        class="rounded col-lg-6 col-md-12 d-flex flex-column justify-content-center align-items-center">
                        <div class="">
                            <div class="container text-center">
                                <h1
                                    style="
                      font-size: 55px;
                      color: #ec7fa9;
                      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
                    "
                                    class="mb-3 fw-semibol">
                                    Registrasi
                                </h1>
                                <img style="width: 60%" src="{{asset('assets/img/stuntless.png')}}" alt="" />
                                <h1
                                    class="flex-column fw-bold"
                                    style="
                      font-size: 35px;
                      color: #ec7fa9;
                      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
                    "
                                    ;>
                                    STUNTLESS
                                </h1>
                                <p class="px-5" style="font-size: 10px">

                                    Sistem monitoring tumbuh kembang anak berbasis IoT dan
                                    terintergasi dengan website untuk deteksi stunting secara
                                    real-time
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        style="background-color: #ec7fa9"
                        class="rounded col-lg-6 col-md-10 d-flex flex-column">
                        <form action="{{ route('registrasi') }}" method="POST">
                            @csrf
                            <div
                                class="mb-1 mt-2"
                                style="display: flex; flex-direction: column">
                                <label
                                    for="nama"
                                    class="form-label text-white"
                                    style="font-size: medium">Nama :
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="nama"
                                        name="name"
                                        value="{{old('name')}}"
                                        placeholder="Masukkan Nama anda"
                                        style="width: 100%" />
                                    @error('name')
                                    <div class="text-danger font-xs">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>

                            <div class="mb-2" style="display: flex; flex-direction: column">
                                <label
                                    for="NIK"
                                    class="form-label text-white"
                                    style="font-size: medium">NIK :
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="NIK"
                                        name="nik"
                                        value="{{old('nik')}}"
                                        placeholder="Masukkan NIK anda 0-16 Angka"
                                        style="width: 100%" />
                                    @error('nik')
                                    <div class="text-danger font-xs">{{ $message }}</div>
                                    @enderror
                                </label>
                            </div>
                            <div class="form-floating mb-2">
                                <input
                                    type="email"
                                    class="form-control"
                                    id="floatingInputGrid"
                                    name="email"
                                    placeholder="name@example.com"
                                    value="{{old('email')}}" />
                                <label for="floatingInputGrid">Email address</label>
                                @error('email')
                                <div class="text-danger font-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- dua pw -->

                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="">
                                        <label class="text-white" for="pw1">Password</label>
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="form-control"
                                            placeholder="Masukkan Password" />
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="">
                                        <label class="text-white" for="pw2">
                                            Konfirmasi Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="konfirmasiPass"
                                            placeholder="Masukkan Ulang Password" />
                                        @error('password')
                                        <div class="text-danger font-xs">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="justify-content-center text-center mt-3">
                                    <p hidden id="teksPw" class="text-center fs-sm mb-4 text-danger bg-white">Password berbeda</p>
                                    <button
                                        style="
                        border-radius: 30px;
                        width: 40%;
                        background-color: #87cefa;
                        border: none;
                        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                      "
                                        class="btn btn-primary"
                                        type="submit">
                                        Buat Akun
                                    </button>
                                    <div class="d-flex justify-content-center gap-3 mt-2">
                                        <hr
                                            class="text-white text-center justify-content-center"
                                            style="width: 40%" />
                                        <hr
                                            class="text-white text-center justify-content-center"
                                            style="width: 40%" />
                                    </div>

                                    <!-- bawah -->
                                    <p
                                        class="text-white mt-1"
                                        style="align-items: center; font-size: x-small">
                                        Sudah mempunyai akun? <a href="/login">Log in</a>
                                    </p>
                                </div>
                            </div>
                        </form>

                        <!-- dua pw selesai -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
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
            } else {
                submitButton.setAttribute('disabled', true);

            }
        });
    </script>
</body>

</html>