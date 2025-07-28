@php
    $menu = request()->segment(1);
@endphp
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'dashboard' ? 'collapsed' : '' }} " href="/dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'data-pendaftar' ? 'collapsed' : '' }} " href="/data-pendaftar">
        <i class="bi bi-menu-button-wide"></i>
        <span>Data Pendaftar</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'konten-berita' ? 'collapsed' : '' }} " href="index.html">
        <i class="bi bi-layout-text-window-reverse"></i>
        <span>Konten Berita</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ $menu !== 'Pendaftaran' ? 'collapsed' : '' }} " href="/pendaftaran">
        <i class="bi bi-journal-text"></i>
        <span>Pendaftaran</span>
      </a>
    </li>

  </ul>

</aside>