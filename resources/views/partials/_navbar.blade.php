<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">
        <span class="brand-logo">TodoServicio</span>
        <span class="dot-com">.com</span>
      </a>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="divider-vertical hidden-xs hidden-sm"></li>
        <li class="{{ Request::is('products') ? "active" : "" }}"><a href="{{ route('products.index') }}">Productos</a></li>
        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="{{ url('contact') }}">Contacto</a></li>
        <li><a href="{{ url('contact') }}">Ubicación</a></li>
        {{-- <li class="{{ Request::is('search') ? "active" : "" }}"><a href="{{ url('search') }}">Buscar</a></li> --}}
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
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Bienvenido {{ Auth::user()->name }}! <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <center>
                <form id="logout-form" class="navbar-form" action="{{ route('logout') }}" method="POST">
                  {{ csrf_field() }}
                  <a href="{{ url('carrito') }}"><span class="glyphicon glyphicon-shopping-cart"> Carrito</a>
                    <li class="divider"></li>
                    <a href="{{ url('home') }}"><span class="glyphicon glyphicon-tasks"> Información</a>
                      <li class="divider"></li>
                      <input type="submit" class="btn btn-danger" value="Cerrar sesión">
                    </form>
                  </center>
                </ul>
              @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>
