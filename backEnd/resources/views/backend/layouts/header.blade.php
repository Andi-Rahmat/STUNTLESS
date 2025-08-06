<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title>@yield('title', 'Dashboard - NiceAdmin')</title>

  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <style>
    /* Styling untuk dropdown Select2 */
    .select2-container--default .select2-selection--single {
      width:100%;
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

  <style>
    .btn {
      position: relative;
    }

    .btn .info-text {
      display: none;
      position: absolute;
      z-index: 20;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      background-color: grey;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      margin-top: 5px;
      white-space: nowrap;
    }

    .btn:hover .info-text {
      display: block;
    }

    .btnKlasifikasi {
      border:1px solid #ec4899 !important;
      color: #ec4899;
    }

    .btnKlasifikasi.active {
      background-color: #ec7fa9;
      color: black;
    }
    .btnKlasifikasi:hover{
      background-color: #ec7fa9;
      color: black;
    }
  </style>
</head>

<body>
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('assets/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->name}}</h6>
              <span>{{Auth::user()->role}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>

          </ul>
        </li>

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>