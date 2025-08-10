@php
    $menu = request()->url();
@endphp
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'dashboard' ? 'collapsed' : '' }} " href="{{route(cekRole().'.dashboard')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'data-pendaftar' ? 'collapsed' : '' }} " href="{{route('daftar_ibu')}}">
        <img src="{{asset('assets/icon/mother.png')}}" alt="" width="20" style="margin-right: 7px;">
        <span>Daftar Ibu</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'data-pendaftar' ? 'collapsed' : '' }} " href="{{route('daftar_balita')}}">
        <img src="{{asset('assets/icon/baby.png')}}" alt="" width="20" style="margin-right: 7px;">
        <span>Daftar Balita</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'konten-berita' ? 'collapsed' : '' }} " href="{{route('pengukuran')}}">
        <i class="bi bi-layout-text-window-reverse"></i>
        <span>Pengukuran</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'Pendaftaran' ? 'collapsed' : '' }} " href="{{route('registrasi.index')}}">
        <i class="bi bi-journal-text"></i>
        <span>Pendaftaran</span>
      </a>
    </li>

  </ul>

</aside>