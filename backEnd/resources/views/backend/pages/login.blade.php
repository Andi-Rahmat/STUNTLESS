<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LOGIN STUNTTLES</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div
      style="background-color: #ffb8e0; min-width: 100vw; min-height: 100vh"
      class="d-flex justify-content-center align-items-center"
    >
      <div class="card my-5 w-100" style="max-width: 80%">
        <div class="card-body">
          <div class="row flex-column flex-lg-row px-3">
            <div
              style="background-color: #ec7fa9"
              class="rounded col-lg-6 col-md-12 d-flex flex-column justify-content-center align-items-center"
            >
              <div class="">
                <div class="container text-center">
                  <h1 style="font-size: 55px" class="text-white mt-4 fw-bold">
                    Login
                  </h1>
                  <h3 class="fs-4 text-white mt-3" style="font-weight: normal">
                    Welcome to Stuntless
                  </h3>
                  <p class="text-white px-5" style="font-size: 10px">
                    Lakukan login dengan benar, perhatikan setiap email password
                    yang akan anda masukkan
                  </p>
                </div>
                <div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-white"
                            >Email</label
                            >
                            <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            />
                            @error('email')
                            <div class="text-red-500 text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="text-white">Password</label>
                            <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            />
                            @error('password')
                            <div class="text-danger fs-xs">{{ $message }}</div>
                            @enderror
                            <p class="text-white py-1" style="font-size: x-small">
                            Belum Punya akun?
                            <a
                                class=""
                                style="font-size: 10px"
                                href="/registrasi"
                                >Daftar sekarang
                            </a>
                            </p>
                            <div class="text-center justify-content-center">
                            <button
                                type="submit"login.html
                                class="btn text-center text-white px-5 justify-content-center"
                                style="
                                background-color: #87cefa;
                                border-radius: 30px;
                                box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                                "
                            >
                                Login
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div
              class="col-lg-6 d-flex justify-content-center align-items-center flex-column p-2 col-sm-12 order-first order-lg-last"
            >
              <img style="width: 60%" src="{{asset('assets/img/stuntless.png')}}" alt="" />
                  <h1
                    class="flex-column fw-bold"
                    style="
                      font-size: 35px;
                      color: #ec7fa9;
                      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
                    "
                    ;
                  >
                    STUNTLESS
                  </h1>
              <p
                class="text-center px-5"
                style="font-size: 10px; color: #000000; opacity: 60%"
              >
                Sistem monitoring tumbuh kembang anak berbasis IoT dan
                terintergasi dengan website untuk deteksi stunting secara
                real-time
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
