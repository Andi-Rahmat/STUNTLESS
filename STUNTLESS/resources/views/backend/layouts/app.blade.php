<!DOCTYPE html>
<html lang="en">
  @include('backend.layouts.header')
  @include('backend.layouts.navbar')

  <main id="main" class="main">
    @yield('content')
  </main>

  @include('backend.layouts.footer')
</body>
</html>
