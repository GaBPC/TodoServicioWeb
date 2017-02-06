<nav class="navbar navbar-default navbar-fixed-top">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">
      <span class="brand-logo">TodoServicio</span><span class="dot-com">.com.ar</span>
    </a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="divider-vertical hidden-xs hidden-sm"></li>
      <li class="{{ Request::is('products') ? "active" : "" }}">
        <a href="{{ route('products.index') }}"><span class="glyphicon glyphicon-align-justify"></span> Productos</a>
      </li>
      <li>
        {!! Form::open(array('url' => 'search', 'class' => 'navbar-form', 'method' => 'post', 'role' => 'search')) !!}
        <div class="input-group">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          {{ Form::text('tag', null, array('class' => 'form-control', 'placeholder' => 'Busque su producto', 'required' => '', 'maxlength' => '255')) }}
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
        {!! Form::close() !!}
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
        <li class="{{ Request::is('home') ? "active" : "" }}">
          <a href="{{ url('home') }}"><span class="glyphicon glyphicon-user"></span>  Bienvenido {{ Auth::user()->name }}!</a>
        </li>
      @endif
    </ul>
  </div>
</nav>
