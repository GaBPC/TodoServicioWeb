@extends('layout')

@section('title','Inicio')

@section('navbar-extend')
  <div class="banner">
    <div class="banner-layer banner-text">
      <div class="col-xs-12">
        <br><br>
        <h1>¡Bienvenidos a Todo Servicio!</h1>
        <h1>Su ferretería online</h1>
        {{-- <h3>En esta página usted podrá encontrar nuestras ultimas ofertas, asi como también realizar encargos personalizados.</h3> --}}
      </div>
    </div>
  </div>
@endsection

@section('content')
  <hr>
  <div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          @foreach ($images_names as $key => $image_name)
            @if ($key == 0)
              <div class="item active">
                <img src="{{ asset("images/site-resources/carousel/$image_name") }}" alt="{{$image_name}}" style="width:100%;">
              </div>
            @else
              <div class="item">
                <img src="{{ asset("images/site-resources/carousel/$image_name") }}" alt="{{$image_name}}" style="width:100%;">
              </div>
            @endif
          @endforeach
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    {{-- Products page link --}}
    <div class="col-xs-offset-1 col-xs-10 col-md-offset-0 col-md-4">
      <br>
      <a href="{{ route('products.index') }}"><img itemprop="image" class="img-responsive radius-border" src="{{asset('images/site-resources/products.png')}}" alt="Visite nuestros productos de venta online"></a>
    </div>
    {{-- Personalized page link --}}
    <div class="col-xs-offset-1 col-xs-10 col-md-offset-0 col-md-4">
      <br>
      <a href="{{ url('custom') }}"><img itemprop="image" class="img-responsive radius-border" src="{{asset('images/site-resources/personal.png')}}" alt="Solicitar un presupuesto personalizado."></a>
    </div>
    {{-- Location page link --}}
    <div class="col-xs-offset-1 col-xs-10 col-md-offset-0 col-md-4">
      <br>
      <a href="{{ url('location') }}"><img itemprop="image" class="img-responsive radius-border" src="{{asset('images/site-resources/maps.png')}}" alt="Encuentrenos en Mar del Plata"></a>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col-xs-12 col-md-6" style="margin-bottom: 15px;">
      <div class="jumbotron text-center" style="background-color: #B2DFDB">
        <h2>¿Quieres comenzar a realizar pedidos?</h2>
      </div>
      <a href="{{ route('register') }}" class="btn btn-primary btn-block btn-lg">Registrarse</a>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="jumbotron text-center" style="background-color: #673AB7; color: white">
        <h2>¿Te interesa recibir las ultimas ofertas por mail?</h2>
      </div>
      <center>
        {!! Form::open(array('url' => 'mailing', 'class' => 'form-inline', 'method' => 'post')) !!}
        <div class="input-group">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          {{ Form::email('email', null, array('class' => 'form-control input-lg', 'placeholder' => 'Ingrese su email', 'required' => '', 'maxlength' => '255')) }}
          <div class="input-group-btn">
            <input type="submit" class="btn btn-info btn-lg" value="Enviar">
          </div>
        </div>
        {!! Form::close() !!}
      </center>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
  $('.carousel').carousel({
    interval: 1000 * 2
  });
  </script>
@endsection
