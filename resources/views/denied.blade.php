@extends('layout')

@section('title', 'Acceso denegado')

@section('content')
  <div class="row">
    <div class="col-xs-12 text-center">
      <h1>Usted no esta autorizado a ingresar a esta sección.</h1>
      <hr>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4">
      <a href="{{ url('/') }}" class="btn btn-danger btn-block">Volver a la página principal</a>
    </div>
  </div>
@endsection
