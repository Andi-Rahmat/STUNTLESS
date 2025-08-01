<!DOCTYPE html>
<html lang="en">
@include('backend.layouts.header')
@include('backend.layouts.navbar')

<main id="main" class="main">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @yield('content')
</main>

@include('backend.layouts.footer')
</body>

</html>