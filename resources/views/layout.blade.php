<!DOCTYPE html>
<html>

<!-- Head -->
@include('partials._head')

<body>
  <!-- Navbar -->
  @include('partials._navbar')

  @yield('navbar-extend')
  <br>

  <div class="container">
    <!-- If they exists, shows messages at the top of the page -->
    @include('partials._messages')

    <!-- Setting content with Blade -->
    @yield('content')
  </div>

  <!-- Footer -->
  @include('partials._footer')

  <!-- Scripts -->
  @include('partials._javascript')
</body>
</html>
