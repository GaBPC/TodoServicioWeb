@extends('layout')

@section('title','Contacto')

@section('navbar-extend')
  <div class="row">
    <div class="jumbotron text-center" style="background-color:#7C4DFF ; color: white;">
      <h1>Contactese con nosotros</h1>
      <div class="container">
        <div class="col-xs-12">
          <hr>
        </div>
        <div class="col-xs-12  col-md-offset-2 col-md-3">
          <h3><span class="glyphicon glyphicon-earphone"></span> 0223 155 814863</h3>
        </div>
        <div class="col-xs-12 col-md-5">
          <h3><span class="glyphicon glyphicon-envelope"></span> faktor2005@yahoo.com.ar</h3>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    {{-- Mail form --}}
    <div class="col-xs-12 col-md-8">

    </div>
    {{-- Links to others pages --}}
    <div class="col-xs-12 col-md-4">

    </div>
  </div>
@endsection