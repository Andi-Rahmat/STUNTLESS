<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="{{asset('assets/img/Asset/Stuntless FIX.png')}}" type="image/x-icon">
    <title>STUNTLESS</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        overflow-x: hidden;
      }

      body {
        color: #333;
      }
      .home-section {
        background: linear-gradient(to bottom, #f797b4, #ffb8e0);
        padding: 30px 0; /* memberi ruang vertikal */
        min-height: 100vh;
      }

      .navbar-custom {
        background: #ffff;
        border-radius: 20px;
        padding: 10px 20px;
      }
      .navbar-nav {
        background: #ec7fa9;
        border-radius: 5px;
        padding: 3px 10px;
        gap: 20px; /* jarak antar link */
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
        -webkit-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
        -moz-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
      }
      .navbar-nav .nav-link {
        color: white;
        font-weight: bold;
        font-size: 16px;
      }
      .btn-login {
        background: #ec7fa9;
        color: white;
        border-radius: 50px;
        padding: 9px 30px;
        font-weight: bold;
        font-size: 16px;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
        -webkit-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
        -moz-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
      }
      .btn-login:hover {
        background: #f797b4;
        color: #fff;
      }
      .navbar-brand img {
        height: 40px;
        margin-right: 10px;
      }
      .judul {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.11);
      }
      .Klasifikasi {
        background-color: #ffe8cd;
      }

      .form-container input,
      .form-container select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
      }
      .form-container label {
        color: #333;
        font-weight: bold;
      }
      .form-container button {
        width: 100%;
        padding: 10px;
        background-color: #ff63b1;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
      }
      .form-container button:hover {
        background-color: #f05473;
      }
      .result-card {
        background-color: #fbe8eb;
        padding: 10px;
        border-radius: 10px;
        width: 48%;
        box-sizing: border-box;
        text-align: center;
      }
      .result-card h3 {
        color: #000000;
        opacity: 70%;
        font-size: 18px;
        margin-bottom: 10px;
      }
      .accordion-button {
        justify-content: center;
        text-align: center;
      }
      .subheading {
        font-size: 60px;
        color: #ec7fa9;
        cursor: pointer;
      }
      /* Pada layar desktop, tampilkan 3 testimoni per slide */
      @media (min-width: 768px) {
        .carousel-item .row {
          display: flex;
          justify-content: space-between;
        }
        .carousel-item .col-md-4 {
          flex: 0 0 33.33%;
        }
      }

      /* Pada layar mobile, tampilkan 1 testimoni per slide */
      @media (max-width: 767px) {
        .carousel-item .row {
          display: flex;
          justify-content: center;
        }
        .carousel-item .col-12 {
          flex: 0 0 100%;
        }
      }
    </style>
  </head>

  <body>
    <section class="home-section">
      <div class="home">
        <header class="header">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-custom">
              <!-- Logo -->
              <a class="navbar-brand d-flex align-items-center">
                <img
                  src="{{asset('assets/img/Asset/Stuntless FIX.png')}}"
                  alt="Logo"
                  width="42"
                  height="50"
                />
                <span style="font-weight: bold; opacity: 60%; font-size: 16px"
                  >Stuntless</span
                >
              </a>

              <!-- Mobile Button -->
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
              >
                <span class="navbar-toggler-icon"></span>
              </button>

              <!-- Menu Tengah -->
              <div
                class="collapse navbar-collapse justify-content-center"
                id="navbarNav"
              >
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Klasifikasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Menu</a>
                  </li>
                </ul>
              </div>

              <div class="d-none d-lg-block">
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
              </div>
              <!-- Login Button -->
            </nav>
          </div>
        </header>

        <div
          style="margin-top: 20px"
          class="d-flex justify-content-center align-items-center"
        >
          <div class="kotak" style="max-width: 90%">
            <div class="card-body">
              <!-- beda -->
              <div class="row flex-column flex-lg-row px-3">
                <!-- kotak kiri pertama -->
                <div
                  class="rounded col-lg-6 col-md-12 d-flex flex-column justify-content-center align-items-center"
                >
                  <div class="">
                    <h1
                      class="judul fw-bold judul fw-bold text-white"
                      style="font-size: clamp(42px, 8vw, 100px)"
                    >
                      Stuntless
                    </h1>

                    <h3
                      style="font-size: clamp(20px, 4vw, 36px)"
                      class="text-white"
                    >
                      Selamat Datang di Website Informatif STUNTLESS
                    </h3>
                    <p class="text-white" style="text-align: justify">
                      “Kami percaya bahwa setiap anak berhak tumbuh sehat dan
                      optimal sejak dini. Melalui platform ini, kami
                      menghadirkan solusi inovatif berbasis IoT yang dapat
                      membantu kader posyandu.
                    </p>
                    <button
                      style="
                        background-color: #fff;
                        border-radius: 30px;
                        outline: none;
                        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
                        -webkit-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
                        -moz-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.26);
                      "
                      type="button"
                      class="btn px-3 py-2 outline-0"
                    >
                      Get Started
                    </button>
                  </div>
                </div>
                <div
                  class="col-lg-6 d-flex justify-content-center align-items-center flex-column col-sm-12 order-first order-lg-last"
                >
                  <img style="width: 100%" src="{{asset('assets/img/Asset/new bening.png')}}" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- section-dua -->
    <section>
      <div class="judu-about-us mt-4 gx-3" style="padding: 0px 30px">
        <h1
          class="fw-bold fs-1 text-center"
          style="
            color: #ec7fa9;
            text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.11);
            font-size: clamp(50px, 2vw, 90px);
          "
        >
          About Us
        </h1>

        <p
          class=""
          style="
            font-size: clamp(14px, 2vw, 15px);
            text-align: center;
            opacity: 85%;
          "
        >
          Stunting di Indonesia adalah masalah serius yang ditandai dengan
          kondisi gagal pertumbuhan pada anak akibat kekurangan gizi kronis,
          terutama pada 1.000 hari pertama kehidupan.Prevalensi stunting di
          Indonesia pada tahun 2024 mencapai 19,8%, menunjukkan penurunan
          dibandingkan tahun-tahun sebelumnya, tetapi masih menjadi perhatian
          karena dampaknya yang signifikan terhadap kualitas sumber daya
          manusia.
        </p>
        <br />
        <div class="row d-flex justify-content-center g-3">
          <div class="col-6" style="width: 35rem; height: auto; color: #fff">
            <div
              class="card-body p-5"
              style="background-color: #ec7fa9; border-radius: 5px"
            >
              <div class="align-items-center d-flex" style="gap: 15px">
                <img
                  src="{{asset('assets/img/Asset/batang putih.png')}}"
                  style="width: auto; height: 40px"
                  alt=""
                />
                <h5
                  class="card-title fw-bold mx"
                  style="font-size: clamp(30px, 2vw, 40px)"
                >
                  Our Mission
                </h5>
              </div>
              <br />
              <p
                class="card-text"
                style="font-size: clamp(13px, 2vw, 18px); text-align: justify"
              >
                Inisiatif STUNTLESS juga sejalan dengan Tujuan Pembangunan
                Berkelanjutan (Sustainable Development Goals/SDGs) pada poin
                ketiga, yaitu "Good Health and Well-being" (Kehidupan Sehat dan
                Sejahtera).
              </p>
            </div>
          </div>
          <div class="col-6" style="width: 35rem; height: auto; color: #fff">
            <div
              class="card-body p-5"
              style="background-color: #ec7fa9; border-radius: 5px"
            >
              <div class="align-items-center d-flex" style="gap: 15px">
                <img
                  src="{{asset('assets/img/Asset/batang putih.png' )}}"
                  style="width: auto; height: 40px"
                  alt=""
                />
                <h5
                  class="card-title fw-bold mx"
                  style="font-size: clamp(30px, 2vw, 40px)"
                >
                  Our Vision
                </h5>
              </div>
              <br />
              <p
                class="card-text"
                style="font-size: clamp(13px, 2vw, 18px); text-align: justify"
              >
                Inisiatif STUNTLESS juga sejalan dengan Tujuan Pembangunan
                Berkelanjutan (Sustainable Development Goals/SDGs) pada poin
                ketiga, yaitu "Good Health and Well-being" (Kehidupan Sehat dan
                Sejahtera).
              </p>
            </div>
          </div>
          <br />
        </div>
        <br />
        <div>
          <p
            class="py-2"
            style="
              text-align: center;
              opacity: 80%;
              font-size: clamp(10px, 2vw, 15px);
            "
          >
            Dalam menangani Stunting, peran orang tua sangatlah penting guna
            menjaga pola makan anak, maka dari itu kami memberikan tips makanan
            terbaik untuk balita umur 0-5 tahun yang biasa di sebut “Piramida
            Makanan Sehat” dalam upaya mencegah gizi buruk dan terjadinya resiko
            stunting.
          </p>
          <hr
            style="border-top: 2px dashed #000; width: 100%; padding: 0 40px"
          />
        </div>
      </div>
    </section>
    <br />
    <!-- tambahan -->
    <section>
      <div
        class="gizi justify-content-center px-4"
        style="background-color: #ec7fa9"
      >
        <h2 class="fw-bold text-center py-3" style="color: #fff">
          PIRAMIDA GIZI BALITA
        </h2>
        <div class="justify-content-center text-center">
          <img
            style="justify-content: center; width: 70%"
            src="{{asset('assets/img/Asset/Piring Sehat.png' )}}"
            alt=""
          />
        </div>
        <div>
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne"
                >
                  Accordion Item #1
                </button>
              </h2>
              <div
                id="collapseOne"
                class="accordion-collapse collapse show"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  <strong>This is the first item’s accordion body.</strong> It
                  is shown by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element. These
                  classes control the overall appearance, as well as the showing
                  and hiding via CSS transitions. You can modify any of this
                  with custom CSS or overriding our default variables. It’s also
                  worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                  aria-expanded="false"
                  aria-controls="collapseTwo"
                >
                  Accordion Item #2
                </button>
              </h2>
              <div
                id="collapseTwo"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  <strong>This is the second item’s accordion body.</strong> It
                  is hidden by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element. These
                  classes control the overall appearance, as well as the showing
                  and hiding via CSS transitions. You can modify any of this
                  with custom CSS or overriding our default variables. It’s also
                  worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                  aria-expanded="false"
                  aria-controls="collapseThree"
                >
                  Accordion Item #3
                </button>
              </h2>
              <div
                id="collapseThree"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  <strong>This is the third item’s accordion body.</strong> It
                  is hidden by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element. These
                  classes control the overall appearance, as well as the showing
                  and hiding via CSS transitions. You can modify any of this
                  with custom CSS or overriding our default variables. It’s also
                  worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                  aria-expanded="false"
                  aria-controls="collapseThree"
                >
                  Accordion Item #4
                </button>
              </h2>
              <div
                id="collapseThree"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">
                  <strong>This is the third item’s accordion body.</strong> It
                  is hidden by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element. These
                  classes control the overall appearance, as well as the showing
                  and hiding via CSS transitions. You can modify any of this
                  with custom CSS or overriding our default variables. It’s also
                  worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
          </div>
        </div>
        <br />
      </div>
    </section>
    <!-- section ketiga -->
    <section style="background-color: #fff">
      <div class="text-center py-1" style="text-align: justify">
        <h1
          class="fw-bold px-2 mb-3"
          style="
            color: #ec7fa9;
            text-shadow: 0px 2px 0px rgba(0, 0, 0, 0.21);
            font-size: clamp(25px, 3vw, 50px);
          "
        >
          Standariasasi dan Tata Cara Pengukuran
        </h1>
        <p
          class="mx-4 text-center text-black"
          style="font-size: clamp(12px, 2vw, 16px); opacity: 80%"
        >
          Selain menjaga pola makan, orang tua balita juga harus memperhatikan
          tumbuh kembang balita secara mandiri melalui data standart dari WHO.
          Untuk melakukan monitoring tumbuh kembang balita sesuai standar dari
          WHO, orang tua dapat melakukan pengukuran berat badan, Tinggi Badan
          dan Lingkar Kepala untuk bisa mendapatkan data tumbuh kembang balita
          secara berkala. Tata cara pengukuran sebagai berikut :
        </p>
      </div>
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active text-center">
            <div class="container my-4">
              <div class="row justify-content-center">
                <!-- Mobile: col-12 (full). Desktop: dipersempit & tetap di tengah -->
                <div class="col-12 col-md-10 col-lg-8">
                  <div class="ratio ratio-16x9">
                    <iframe
                      width="560"
                      height="315"
                      src="https://www.youtube.com/embed/KxFs54ZzBxY?si=5Q2p3xER0LHtmh7F"
                      title="YouTube video player"
                      frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      referrerpolicy="strict-origin-when-cross-origin"
                      allowfullscreen
                    ></iframe>
                  </div>
                  <h4
                    class="mt-3 mb-5"
                    style="font-size: clamp(12px, 2vw, 16px); opacity: 80%"
                  >
                    Vidio pengukuran tinggi badan dapat diperhatikan sebagai
                    berikut untuk pengukura tinggi badan yang sempurna
                  </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container my-4 text-center">
              <div class="row justify-content-center">
                <!-- Mobile: col-12 (full). Desktop: dipersempit & tetap di tengah -->
                <div class="col-12 col-md-10 col-lg-8">
                  <div class="ratio ratio-16x9">
                    <iframe
                      src="https://www.youtube.com/embed/S0fRpB0lvXw?si=pyudrgizVYfLvw6P"
                      title="YouTube video player"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      allowfullscreen
                    ></iframe>
                  </div>
                  <h4
                    class="mt-3 mb-4 text-center"
                    style="font-size: clamp(12px, 2vw, 16px); opacity: 80%"
                  >
                    Vidio pengukuran tinggi badan dapat diperhatikan sebagai
                    berikut untuk pengukura tinggi badan yang sempurna
                  </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container my-4">
              <div class="row justify-content-center">
                <!-- Mobile: col-12 (full). Desktop: dipersempit & tetap di tengah -->
                <div class="col-12 col-md-10 col-lg-8">
                  <div class="ratio ratio-16x9">
                    <iframe
                      class="align-items-center"
                      width="560"
                      height="315"
                      src="https://www.youtube.com/embed/veavHbZWpsE?si=_PmgYcajYwPeuQV_"
                      title="YouTube video player"
                      frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      referrerpolicy="strict-origin-when-cross-origin"
                      allowfullscreen
                    ></iframe>
                  </div>
                  <h4
                    class="mt-3 mb-5 text-center"
                    style="font-size: clamp(12px, 2vw, 16px); opacity: 80%"
                  >
                    Vidio pengukuran tinggi badan dapat diperhatikan sebagai
                    berikut untuk pengukura tinggi badan yang sempurna
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev start-0 align-items-center"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="prev"
        >
          <span
            class="carousel-control-prev-icon rounded-circle"
            aria-hidden="true"
            style="background-color: #ec7fa9"
          ></span>
          <span class="visually-hidden">Previous</span>
        </button>

        <!-- Next -->
        <button
          class="carousel-control-next align-items-center"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="next"
        >
          <span
            class="carousel-control-next-icon rounded-circle"
            aria-hidden="true"
            style="background-color: #ec7fa9"
          ></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

    <!-- section 4 -->
    <section class="Klasifikasi p-4" style="background-color: #fff">
      <div
        class="form-container pp-2"
        style="
          background-color: #ffb8e0;
          padding: 20px;
          border-radius: 5px;
          max-width: 90%;
          margin: 0 auto;
        "
      >
        <h2
          class="text-center p-3 mb-3 text-white"
          style="background-color: #ff63b1; border-radius: 10px 10px 0 0"
        >
          Klasifikasi Gizi
        </h2>
        <form id="giziForm">
          <!-- Input untuk Umur -->
          <label for="umur">Umur (bulan):</label>
          <input type="number" id="umur" name="umur" required />

          <!-- Dropdown untuk Jenis Kelamin -->
          <label for="jenisKelamin">Jenis Kelamin:</label>
          <select id="jenisKelamin" name="jenisKelamin" required>
            <option value="anak_perempuan">Anak Perempuan</option>
            <option value="anak_laki">Anak Laki-laki</option>
          </select>

          <!-- Input untuk Tinggi Badan -->
          <div class="d-flex flex-column">
            <label for="tinggiBadan">Tinggi Badan (cm):</label>
            <input type="number" id="tinggiBadan" name="tinggiBadan" />
          </div>

          <!-- Input untuk Berat Badan -->
          <label for="beratBadan">Berat Badan (kg):</label>
          <input type="number" id="beratBadan" name="beratBadan" required />

          <!-- Input untuk Lingkar Kepala -->
          <label for="beratBadan">Lingkar Kepala (cm) :</label>
          <input
            type="number"
            id="lingkar Kepala"
            name="lingkar Kepala"
            required
          />

          <!-- Tombol untuk Simpan -->
          <button type="button" id="simpanButton">Simpan</button>
        </form>

        <!-- Hasil perhitungan -->
        <div
          class="result-container d-flex mt-3 justify-content-center"
          style="gap: 10px"
        >
          <div class="result-card" id="bbResult">
            <h3>Berat Badan Berdasarkan Umur:</h3>
            <p>
              Z-Score: - <br />
              Status Gizi: -
            </p>
          </div>
          <div class="result-card" id="tbResult">
            <h3>Tinggi Badan Berdasarkan Umur:</h3>
            <p>
              Z-Score: - <br />
              Status Gizi: -
            </p>
          </div>
        </div>
        <!-- div beda -->
        <div
          class="result-container d-flex mt-2 justify-content-center"
          style="gap: 10px"
        >
          <div class="result-card" id="bbTbResult">
            <h3>Tinggi dan Berat Badan Berdasarkan Umur:</h3>
            <p>
              Z-Score: - <br />
              Status Gizi: -
            </p>
          </div>
          <div class="result-card" id="bmiResult">
            <h3>Lingkar Kepala Berdasarkan Umur: <br /></h3>
            <p>
              Z-Score: - <br />
              Status Gizi: -
            </p>
            <style></style>
          </div>
        </div>
      </div>
    </section>

    <!-- beda section -->
    <section>
      <div class="container py-5 text-center">
        <!-- Subjudul sebagai trigger collapse -->
        <a
          class="h3 subheading d-block mb-3 fw-bold"
          style="font-size: clamp(35px, 4vw, 65px); text-decoration: none"
          data-bs-toggle="collapse"
          href="#penjelasan"
          role="button"
          aria-expanded="false"
          aria-controls="penjelasan"
        >
          Kenapa Bisa Terjadi Stunting?!
        </a>

        <!-- Konten collapse -->
        <div class="collapse" id="penjelasan">
          <div class="card card-body text-start">
            <h4>Penjelasan</h4>
            <p>
              Stunting adalah kondisi gagal tumbuh akibat kekurangan gizi kronis
              sejak masa kehamilan hingga anak usia dua tahun. Faktor utama:
              asupan gizi kurang, infeksi berulang, sanitasi yang buruk, serta
              pola asuh yang tidak optimal. Dampaknya bukan hanya tubuh lebih
              pendek, tapi juga risiko gangguan kognitif, kesehatan, hingga
              produktivitas di masa depan.
            </p>
          </div>
        </div>
        <br />
        <a
          class="h3 subheading d-block mb-3 fw-bold"
          style="font-size: clamp(35px, 4vw, 65px); text-decoration: none"
          data-bs-toggle="collapse"
          href="#jawaban"
          role="button"
          aria-expanded="false"
          aria-controls="jawaban"
        >
          Bagaimana dengan Dampaknya?!
        </a>
        <br />
        <hr style="color: #000; width: 100%; opacity: 0%" />

        <!-- Konten collapse -->
        <div class="collapse" id="jawaban">
          <div class="card card-body text-start">
            <h4>jawaban</h4>
            <p>
              Stunting adalah kondisi gagal tumbuh akibat kekurangan gizi kronis
              sejak masa kehamilan hingga anak usia dua tahun. Faktor utama:
              asupan gizi kurang, infeksi berulang, sanitasi yang buruk, serta
              pola asuh yang tidak optimal. Dampaknya bukan hanya tubuh lebih
              pendek, tapi juga risiko gangguan kognitif, kesehatan, hingga
              produktivitas di masa depan.
            </p>
          </div>
        </div>
      </div>
      <!-- lanjutan -->
      <div class="justify-content-center text-center mb-4">
        <h1
          class="fw-bold text-white justify-content-center text-center mb-4"
          style="
            display: inline-block;
            justify-content: center;
            border-radius: 5px;
            font-size: clamp(18px, 2vw, 25px);
            background-color: #f797b4;
            padding: 10px 8px;
            display: inline-block;
            justify-content: center;
            max-width: 100%;
            box-sizing: border-box;
          "
        >
          Ciri Ciri Anak Terkena Stunting
        </h1>
      </div>

      <div class="mx-auto row px-lg-5 mb-4">
        <div class="col-6 text-center col-lg-3">
          <img class="mb-4 p-2" src="{{asset('assets/img/Asset/Anak Bugar.png' )}}" alt="" />
          <p style="text-align: justify">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic libero
            quod doloremque consectetur dolorum ratione, fugit deserunt aliquid
            aspernatur distinctio quae quaerat quas officia optio veniam
            voluptates asperiores soluta eius.
          </p>
        </div>
        <div class="col-6 text-center col-lg-3">
          <img class="mb-4 p-2" src="{{asset('assets/img/Asset/Timbangan.png')}}" alt="" />
          <p style="text-align: justify">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic libero
            quod doloremque consectetur dolorum ratione, fugit deserunt aliquid
            aspernatur distinctio quae quaerat quas officia optio veniam
            voluptates asperiores soluta eius.
          </p>
        </div>
        <div class="col-6 text-center col-lg-3">
          <img class="mb-4 p-2" src="{{asset('assets/img/Asset/Tinggi Anak.png')}}" alt="" />
          <p style="text-align: justify">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic libero
            quod doloremque consectetur dolorum ratione, fugit deserunt aliquid
            aspernatur distinctio quae quaerat quas officia optio veniam
            voluptates asperiores soluta eius.
          </p>
        </div>
        <div class="col-6 text-center col-lg-3">
          <img class="mb-4 p-2" src="{{asset('assets/img/Asset/Tulang Anak.png')}}" alt="" />
          <p style="text-align: justify">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic libero
            quod doloremque consectetur dolorum ratione, fugit deserunt aliquid
            aspernatur distinctio quae quaerat quas officia optio veniam
            voluptates asperiores soluta eius.
          </p>
        </div>
      </div>
    </section>
    <!-- section news -->
    <section style="background-color: #ffb8e0">
      <h1 class="text-center text-white fw-bold py-4" style="font-size: 50px">
        NEWS
      </h1>
      <!-- card beda -->
      <div
        class="row d-flex justify-content-center py-4 mx-auto"
        style="gap: 20px"
      >
        <div
          class="card col-md-6 col-lg-3 d-flex flex-column"
          style="width: 15rem"
        >
          <img
            src="{{asset('assets/img/Asset/Kemenkes Logo.png')}}"
            style="width: 3 rem; border-radius: 1rem; justify-content: center"
            class="card-img"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title fw-bold">Apa itu Stunting?</h5>
            <p class="card-text" style="text-align: justify">
              Stunting dapat terjadi mulai janin masih dalam kandungan dan baru
              nampak saat anak berusia dua tahun (Kementerian Kesehatan Republik
              Indonesia, 2016).
            </p>
            <a
              href="https://ayosehat.kemkes.go.id/topik-penyakit/defisiensi-nutrisi/stunting"
              class="btn text-white"
              style="background-color: #87cefa"
              >Lihat Lebih Lanjut</a
            >
          </div>
        </div>
        <!-- card beda -->
        <div class="card col-6 col-md-6 col-lg-3 col-lg-3" style="width: 15rem">
          <img
            src="{{asset('assets/img/Asset/SSGI.png' )}}"
            class="card-img p-2"
            style="justify-content: center; width: 3 rem; border-radius: 1rem"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title fw-bold">
              SSGI 2024: Prevalensi Stunting Nasional Turun Menjadi 19,8%
            </h5>
            <p class="card-text" style="text-align: justify">
              Survei nasional yang menjadi rujukan utama dalam upaya percepatan
              penurunan stunting ini mencatat penurunan prevalensi stunting
              nasional, dari 21,5% pada 2023 menjadi 19,8% pada 2024.
            </p>
            <a
              href="https://www.badankebijakan.kemkes.go.id/ssgi-2024-prevalensi-stunting-nasional-turun-menjadi-198/"
              class="btn text-white"
              style="background-color: #87cefa"
              >Lihat Lebih Lanjut</a
            >
          </div>
        </div>
        <!-- card beda -->
        <div class="card col-6 col-md-6 col-lg-3 col-lg-3" style="width: 15rem">
          <img
            src="{{asset('assets/img/Asset/Stunting Genting.png' )}}"
            class="card-img-top"
            style="width: 3 rem; border-radius: 1rem; justify-content: center"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title fw-bold">Stunting itu Penting dan Genting</h5>
            <p class="card-text" style="text-align: justify">
              Stunting di Indonesia merupakan isu kritis yang membutuhkan
              pendekatan multi-sektoral dan menjadi permasalahan kekurangan gizi
              utama balita Indonesia saat ini.
            </p>
            <a
              href="https://mail.tebingtinggikota.go.id/berita/artikel/stunting-itu-penting-dan-genting"
              class="btn text-white"
              style="background-color: #87cefa"
              >Lihat Lebih Lanjut</a
            >
          </div>
        </div>
        <!-- card beda -->
        <div class="card col-6 col-md-6 col-lg-3 col-lg-3" style="width: 15rem">
          <img
            src="{{asset('assets/img/Asset/Stunting Genting.png' )}}"
            class="card-img-top"
            style="width: 3 rem; border-radius: 1rem; justify-content: center"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title fw-bold">Stunting itu Penting dan Genting</h5>
            <p class="card-text" style="text-align: justify">
              Stunting di Indonesia merupakan isu kritis yang membutuhkan
              pendekatan multi-sektoral dan menjadi permasalahan kekurangan gizi
              utama balita Indonesia saat ini.
            </p>
            <a
              href="https://mail.tebingtinggikota.go.id/berita/artikel/stunting-itu-penting-dan-genting"
              class="btn text-white"
              style="background-color: #87cefa"
              >Lihat Lebih Lanjut</a
            >
          </div>
        </div>
      </div>
    </section>
    <!-- section contact -->
    <section>
      <div
        class="row flex-column flex-lg-row d-flex justify-content-center p-5 align-items-center"
      >
        <div class="">
          <h1
            class="text-center fw-bold p-2 mb-3"
            style="
              color: #ec7fa9;
              font-size: clamp(25px, 3vw, 40px);
              text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
              text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.11);
            "
          >
            Location & Contact Us
          </h1>
        </div>
        <div class="col-lg-6 col-md-12">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3014.6483745840933!2d112.79118257357148!3d-7.27581897149572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa10ea2ae883%3A0xbe22c55d60ef09c7!2sPoliteknik%20Elektronika%20Negeri%20Surabaya!5e1!3m2!1sid!2sid!4v1756164567994!5m2!1sid!2sid"
            width="100%"
            height="300"
            style="border-radius: 1rem; justify-content: center"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
        <!-- beda -->

        <div class="col-lg-6 align-items-center flex-column py-2">
          <div class="d-flex mb-3" style="gap: 10px">
            <div
              class="p-3 px-2 align-items-center"
              style="
                background-color: #ffb8e0;
                border-radius: 6px;
                width: 50%;
                gap: 5px;
              "
            >
              <img
                class="p-1 rounded-circle"
                style="width: 30x; height: 30px; background-color: #ec7fa9"
                src="{{asset('assets/img/Asset/Phone.png')}}"
                alt=""
              />
              <span
                style="font-size: clamp(10px, 1vw, 18px); text-align: justify"
                class="align-items-center"
                >+62 896 1241 4093</span
              >
            </div>
            <div
              class="p-3 px-2 d-flex align-items-center"
              style="
                background-color: #ffb8e0;
                border-radius: 6px;
                width: 50%;
                gap: 5px;
              "
            >
              <img
                class="p-1 rounded-circle"
                style="width: 30px; height: 30px; background-color: #ec7fa9"
                src="{{asset('assets/img/Asset/Letter.png' )}}"
                alt=""
              />
              <span
                style="font-size: clamp(10px, 1vw, 18px); text-align: justify"
                class="align-items-center"
              >
                Stuntless@gmail.com
              </span>
            </div>
          </div>
          <!-- beda -->
          <div class="d-flex" style="gap: 10px">
            <div
              class="p-3 px-2 d-flex align-items-center"
              style="background-color: #ffb8e0; border-radius: 6px; gap: 10px"
            >
              <img
                class="p-1 rounded-circle"
                style="width: 40px; height: 40px; background-color: #ec7fa9"
                src="{{asset('assets/img/Asset/Map.png')}}"
                alt=""
              />
              <span
                style="font-size: clamp(12px, 1vw, 20px); text-align: justify"
                class="align-items-center"
              >
                Institut Teknologi Sepuluh Nopember, Jl. Raya ITS, Keputih, Kec.
                Sukolilo, Surabaya, Jawa Timur 60111
              </span>
            </div>
          </div>
          <div
            class="p-3 px-2 d-flex align-items-center mt-3"
            style="background-color: #ffb8e0; border-radius: 6px; gap: 10px"
          >
            <img
              class="p-1 rounded-circle"
              style="width: 40px; height: 40px; background-color: #ec7fa9"
              src="{{asset('assets/img/Asset/Clock.png')}}"
              alt=""
            />
            <span
              style="font-size: clamp(12px, 1vw, 20px); text-align: justify"
              class="align-items-center"
            >
              Senin - Jum'at 08.00 - 16.00
            </span>
          </div>
        </div>
      </div>
    </section>
    <!-- testi -->
    <section class="testimoni p-4" style="background-color: #ffb8e0">
      <div class="justify-content-center">
        <h1 class="text-center text-white fw-bold mb-3">Testimoni</h1>
      </div>
      <div
        id="testimoniCarousel"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <!-- Testimoni 1 -->
          <div class="carousel-item active">
            <div class="d-flex justify-content-center">
              <div class="card" style="width: 60vw; height: 20vh">
                <div class="d-flex align-items-center mt-3">
                  <img
                    src="{{asset('assets/img/Asset/Testi Andi.png' )}}"
                    class="card-img-top-start rounded-circle mx-3"
                    style="width: 40px"
                    alt="..."
                  />
                  <span class="fw-bold">Andi Rahmat</span>
                </div>
                <div class="card-body">
                  <p
                    class="card-text mb-4"
                    style="
                      text-align: justify;
                      font-size: clamp(12px, 1vw, 20px);
                    "
                  >
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Optio, eos necessitatibus? Sed omnis aliquam, quod odit
                    inventore eaque, qui optio fugiat eos, corporis delectus ut
                    minima maxime? Nisi, officia omnis.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Testimoni 2 -->
          <div class="carousel-item">
            <div class="d-flex justify-content-center">
              <div class="card" style="width: 60vw; height: 20vh">
                <div class="d-flex align-items-center mt-3">
                  <img
                    src="{{asset('assets/img/Asset/Toffan Taulany.png' )}}"
                    class="card-img-top-start rounded-circle mx-3"
                    style="width: 40px"
                    alt="..."
                  />
                  <span class="fw-bold">Toffan Taulany</span>
                </div>
                <div class="card-body">
                  <p
                    class="card-text"
                    style="
                      text-align: justify mb-3;
                      font-size: clamp(12px, 1vw, 20px);
                    "
                  >
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Optio, eos necessitatibus? Sed omnis aliquam, quod odit
                    inventore eaque, qui optio fugiat eos, corporis delectus ut
                    minima maxime? Nisi, officia omnis.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Testimoni 3 -->
          <div class="carousel-item">
            <div class="d-flex justify-content-center">
              <div class="card" style="width: 60vw; height: 20vh">
                <div class="d-flex align-items-center mt-3">
                  <img
                    src="{{asset('assets/img/Asset/Memei .png' )}}"
                    class="card-img-top-start rounded-circle mx-3"
                    style="width: 40px"
                    alt="..."
                  />
                  <span class="fw-bold">Memei</span>
                </div>
                <div class="card-body">
                  <p
                    class="card-text mb-3"
                    style="
                      text-align: justify;
                      font-size: clamp(12px, 1vw, 20px);
                    "
                  >
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Optio, eos necessitatibus? Sed omnis aliquam, quod odit
                    inventore eaque, qui optio fugiat eos, corporis delectus ut
                    minima maxime? Nisi, officia omnis.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Kontrol Carousel -->
        <button
          class="carousel-control-prev"
          style="filter: invert(1); left: -40px"
          type="button"
          data-bs-target="#testimoniCarousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          style="filter: invert(1); right: -40px"
          type="button"
          data-bs-target="#testimoniCarousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!-- beda -->
    <section>
      <div class="row d-flex mt-4 text-center justify-content-center">
        <div
          class="col-lg-3 col-6 align-items-center justify-content-center px-3"
        >
          <img
            class="align-items-center"
            src="{{asset('assets/img/Asset/Stuntless FIX.png')}}"
            width="70px"
            height="70px"
            alt=""
          />
        </div>
        <div class="col-lg-3 col-6 align-items-center px-3">
          <h4
            style="font-size: clamp(10px, 2vw, 20px); color: #ec7fa9"
            class="fw-bold text-center align-items-center"
          >
            Tentang STUNTLESS
          </h4>
          <p
            class="stuntless-info px-3 align-items-center"
            style="
              font-size: clamp(8px, 2vw, 16px);
              list-style: none;
              text-align: justify;
            "
          >
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum
            modi, facilis laudantium corrupti reiciendis possimus dolore. Vel
            enim culpa, libero quo.
          </p>
        </div>

        <div class="col-lg-3 col-6 align-items-center">
          <h4
            style="font-size: clamp(10px, 2vw, 20px); color: #ec7fa9"
            class="fw-bold text-center align-items-center"
          >
            Kontak Kami
          </h4>
          <div class="d-flex flex-column">
            <div class="align-items-center justify-content-center">
              <p style="font-size: clamp(8px, 2vw, 16px)">
                Phone: + 62-892-9902-2456
              </p>
              <p style="font-size: clamp(8px, 2vw, 16px)">
                Email: Stuntless@gmail.com
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6 align-items-center">
          <h4
            style="font-size: clamp(10px, 2vw, 20px); color: #ec7fa9"
            class="fw-bold text-center align-items-center"
          >
            Ikuti Kami
          </h4>
          <div class="d-flex flex-column">
            <div
              class="align-items-center d-flex justify-content-center"
              style="gap: 10px"
            >
              <img
                class="align-items-center"
                width="20px"
                height="20px"
                src="{{asset('assets/img/Asset/Instagram.png')}}"
                alt=""
              />
              <span style="font-size: clamp(12px, 2vw, 16px)"
                >@Stuntless.Id</span
              >
            </div>
            <div
              class="align-items-center d-flex justify-content-center"
              style="gap: 10px"
            >
              <img
                class="align-items-center"
                width="20px"
                height="20px"
                src="{{asset('assets/img/Asset/TikTok.png' )}}"
                alt=""
              />
              <span style="font-size: clamp(12px, 2vw, 16px)"
                >_Stuntless.Id</span
              >
            </div>
            <div
              class="align-items-center d-flex justify-content-center"
              style="gap: 10px"
            >
              <img
                class="align-items-center"
                width="20px"
                height="20px"
                src="{{asset('assets/img/Asset/YouTube Squared.png')}}"
                alt=""
              />
              <span style="font-size: clamp(12px, 2vw, 16px)">Stuntless</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <hr />
    <footer>
      <div
        style="justify-content: space-between; font-size: clamp(8px, 1vw, 15px)"
        class="d-flex align-items-center px-3"
      >
        <p>© 2025 STUNTLESS. All rights reserved.</p>
        <p>Kebijakan Privasi | Syarat & Ketentuan</p>
      </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
