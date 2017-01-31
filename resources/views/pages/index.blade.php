@extends('layout')

@section('title','Inicio')

@section('navbar-extend')
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

<hr>
<div class="col-xs-8 col-md-4">
  <a href="#"><img class="img-responsive radius-border" src="{{asset('images/site-resources/products.png')}}" alt="Imagen para productos"></a>
</div>



<div class="col-xs-8 col-md-4">
  <div class="visible-xs visible-sm">
    <br>
  </div>
  <a href="#"><img class="img-responsive radius-border" src="{{asset('images/site-resources/maps.png')}}" alt="Imagen para productos"></a>
</div>

<div class="col-xs-8 col-md-4">
  <div class="visible-xs visible-sm">
    <br>
  </div>
  <a href="#"><img class="img-responsive radius-border" src="{{asset('images/site-resources/account.png')}}" alt="Imagen para productos"></a>
</div>




  {{-- @foreach ($data['lastProducts'] as $product)
    @if ($product->image != null)
      <div class="col-xs-6 col-md-4">
        <a href="{{route('products.show', $product->id)}}" class="btn btn-default btn-sm btn-block">
          <center>
            <img class="img-responsive img-index" src="{{asset('images/' . $product->image)}}" alt="Imagen para {{ $product->name }}">
            <hr>
            <h4>{{ $product->name }}</h4>
            <h4>${{ $product->price }}</h4>
          </center>
        </a>
        <br>
      </div>
    @endif
  @endforeach

  <div class="row">
    <div class="col-xs-12">
      <hr>
    </div>
    <div class="col-xs-12 col-md-offset-4 col-md-4">
      <a href="{{route('products.index')}}" class="btn btn-info btn-block">Ver más</a>
    </div>
  </div> --}}


@endsection
