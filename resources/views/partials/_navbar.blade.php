<nav class="navbar navbar-default navbar-fixed-top">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a title="Inicio" class="navbar-brand" href="{{ url('/') }}">
      <span class="brand-logo">TodoServicio</span>
    </a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="divider-vertical hidden-xs hidden-sm"></li>
      <li class="{{ Request::is('products') ? "active" : "" }}">
        <a title="Nuestros productos" href="{{ route('products.index') }}"><span class="glyphicon glyphicon-th"></span> Productos</a>
      </li>
      <li class="{{ Request::is('promo') ? "active" : "" }}">
        <a title="Nuestras promociones" href="{{ url('promo') }}"><span class="glyphicon glyphicon-star"></span> Promociones</a>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-piggy-bank"></span> Transacciones</a>
        <ul class="dropdown-menu">
          <li class="{{ Request::is('budget') ? "active" : "" }}">
            <a title="Ver mi presupuesto" href="{{ url('budget') }}"><span class="glyphicon glyphicon-shopping-cart"></span> Mi Presupuesto</a>
          </li>
          <li class="{{ Request::is('buys') ? "active" : "" }}">
            <a title="Ver mis compras" href="{{ url('buy') }}"><span class="glyphicon glyphicon-usd"></span> Mi Compra</a>
          </li>
        </ul>
      </li>

      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-search"></i> Buscar</span></a>
          <ul class="dropdown-menu" style="padding: 15px;min-width: 275px;">
            {!! Form::open(array('url' => 'search', 'class' => 'navbar-form', 'method' => 'post', 'role' => 'search')) !!}
            <div class="input-group">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              {{ Form::text('tag', null, array('class' => 'form-control', 'placeholder' => 'Ingrese su búsqueda', 'required' => '', 'maxlength' => '255')) }}
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
            </div>
            {!! Form::close() !!}
            <hr>
            <p><b>Recomendaciones: </b>ingrese las palabras claves, preferiblemente en minúsculas, separadas por espacio.</p>
          </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="margin-right: 5px;">
      @if (Auth::guest())
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Ingresar <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-edit"></span> Registrarse</a></li>
          </ul>
        </li>
      @else
        <li title="Opciones de la cuenta" class="{{ Request::is('home') ? "active" : "" }}">
          <a href="{{ url('home') }}"><span class="glyphicon glyphicon-user"></span> Mi Cuenta</a>
        </li>
      @endif
    </ul>
  </div>
</nav>
