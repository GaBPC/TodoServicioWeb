@extends('layout')

@section('title','Inicio')

@section('navbar-extend')
  {{-- Page information --}}
  <div class="banner">
    <div class="banner-layer banner-text">
      <div class="col-xs-12">
        <br><br>
        <h1>¡Bienvenidos a Todo Servicio!</h1>
        <h3>En esta página usted podrá encontrar nuestras ultimas ofertas, asi como realizar encargos personalizados.</h3>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    {{-- Products page link --}}
    <div class="col-xs-offset-2 col-xs-8 col-md-offset-0 col-md-4">
      <br>
      <a href="{{ route('products.index') }}"><img class="img-responsive radius-border" src="{{asset('images/site-resources/products.png')}}" alt="Imagen para productos"></a>
    </div>
    {{-- Personalized page link --}}
    <div class="col-xs-offset-2 col-xs-8 col-md-offset-0 col-md-4">
      <br>
      <a href="#"><img class="img-responsive radius-border" src="{{asset('images/site-resources/personal.png')}}" alt="Imagen para personalizados"></a>
    </div>
    {{-- Location page link --}}
    <div class="col-xs-offset-2 col-xs-8 col-md-offset-0 col-md-4">
      <br>
      <a href="{{ url('location') }}"><img class="img-responsive radius-border" src="{{asset('images/site-resources/maps.png')}}" alt="Imagen para localización"></a>
    </div>
  </div>
  <hr>

  <div class="row">
    <div class="col-xs-12 col-md-6">
      <br>
      <div class="jumbotron text-center" style="background-color: #B2DFDB">
        <h2>¿Quieres comenzar a realizar pedidos?</h2>
      </div>
      <a href="{{ route('register') }}" class="btn btn-primary btn-block btn-lg">Registrarse</a>
    </div>

    <div class="col-xs-12 col-md-6">
      <br>
      <div class="jumbotron text-center" style="background-color: #673AB7; color: white">
        <h2>¿Te interesa recibir las ultimas ofertas por mail?</h2>
      </div>
      <center>
        {!! Form::open(array('url' => 'asdasd', 'class' => 'form-inline', 'method' => 'post')) !!}
        {{ Form::email('email', null, array('class' => 'form-control input-lg', 'placeholder' => 'Ingrese su email', 'required' => '', 'maxlength' => '255')) }}
        <input type="submit" class="btn btn-info btn-lg" value="Enviar">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        {!! Form::close() !!}
      </center>
    </div>
  </div>
@endsection
