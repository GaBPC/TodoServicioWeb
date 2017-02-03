<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">
        <span class="brand-logo">TodoServicio</span><span class="dot-com">.com</span>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="divider-vertical hidden-xs hidden-sm"></li>
        <li class="{{ Request::is('products') ? "active" : "" }}">
          <a href="{{ route('products.index') }}"><span class="glyphicon glyphicon-align-justify"></span> Productos</a>
        </li>
        <li class="{{ Request::is('search') ? "active" : "" }}">
          <a href="{{ url('search') }}"><span class="glyphicon glyphicon-search"></span> Buscar</a>
        </li>
        <li class="{{ Request::is('cart') ? "active" : "" }}">
          <a href="{{ url('cart') }}"><span class="glyphicon glyphicon-shopping-cart"></span> Carrito</a>
        </li>
        <li class="{{ Request::is('contact') ? "active" : "" }}">
          <a href="{{ url('contact') }}"><span class="glyphicon glyphicon-earphone"></span> Contacto</a>
        </li>
        <li class="{{ Request::is('location') ? "active" : "" }}">
          <a href="{{ url('location') }}"><span class="glyphicon glyphicon-map-marker"></span> Ubicación</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          @if (Auth::guest())
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Ingresar <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-edit"></span> Registrarse</a></li>
            </ul>
          @else
            <li class="{{ Request::is('home') ? "active" : "" }}">
              <a href="{{ url('home') }}"><span class="glyphicon glyphicon-user"></span>  Bienvenido {{ Auth::user()->name }}!</a>
            </li>
          @endif
        </li>
      </ul>
    </div>
  </div>
</nav>
