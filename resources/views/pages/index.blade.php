@extends('layout')

@section('title','Inicio')

@section('navbar-extend')
  {{-- Page information --}}
  <div class="banner">
    <div class="banner-layer banner-text">
      <div class="col-xs-12">
        <br><br>
        <h1>¡Bienvenidos a Todo Servicio!</h1>
        <h3>En esta página usted podrá encontrar nuestras ultimas ofertas,
            asi como realizar encargos personalizados.</h3>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="row">
  {{-- Products page link --}}
  <div class="col-xs-offset-2 col-xs-8 col-md-offset-2 col-md-4">
    <br>
    <a href="#"><img class="img-responsive radius-border" src="{{asset('images/site-resources/products.png')}}" alt="Imagen para productos"></a>
  </div>
  {{-- Location page link --}}
  <div class="col-xs-offset-2 col-xs-8 col-md-offset-0 col-md-4">
    <br>
    <a href="#"><img class="img-responsive radius-border" src="{{asset('images/site-resources/maps.png')}}" alt="Imagen para productos"></a>
  </div>
</div>
<hr>

<div class="row">
  <div class="col-xs-12 col-md-6">
    <br>
    <div class="jumbotron" style="background-color: #B2DFDB">
      <h2>¿Quieres recibir las ultimas ofertas por mail? Registrate:</h2>
    </div>
    <a href="{{ route('register') }}" class="btn btn-primary btn-block btn-lg">Registrarse</a>
  </div>
</div>
@endsection
