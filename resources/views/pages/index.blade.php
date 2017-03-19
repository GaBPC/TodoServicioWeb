@extends('layout')

@section('title','Inicio')

@section('css')
<style>
body{
  background-color: #F5F5F5;
}

</style>
@endsection

@section('navbar-extend')

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>

      </ol>
      <div class="item active">
        <img src="{{ asset("images/site-resources/carousel/img0.png") }}" alt="" style=" min-height: 175px">
        <div class="carousel-caption">
          <h3>¡Bienvenidos a Todo Servicio! Su Ferretería Online</h3>
        </div>
      </div>

      <div class="item">
        <img src="{{ asset("images/site-resources/carousel/img1.png") }}" alt="" style=" min-height: 175px">
      </div>

      <div class="item">
        <img src="{{ asset("images/site-resources/carousel/img2.png") }}" alt="" style=" min-height: 175px">
      </div>

      <div class="item">
        <img src="{{ asset("images/site-resources/carousel/img3.png") }}" alt="" style=" min-height: 175px">
      </div>
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
@endsection

@section('content')
  <div class="panel panel-danger text-center">
    <div class="panel-body">
      <div class="col-xs-12 col-md-4">
        <center>
          <img src="{{asset('images/site-resources/personal.png')}}" class="img-responsive text-center" alt="">
        </center>
      </div>
      <div class="col-xs-12 col-md-8">
        <h1>Pida su presupuesto</h1>
        <h4><b>Seleccione</b> los productos que le interesen, elija la cantidad que necesita y obtenga el presupuesto correspondiente.</h4>
        <h4>Si no encuentra lo que necesita, <b>agréguelo</b> manualmente desde la seccion de <a href="{{url('budget')}}">Mi Presupuesto</a> y nosotros intentaremos conseguirlo.</h4>
        <hr>
        <a href="{{url('products')}}" class="btn btn-success btn-lg">Ver Productos</a>
      </div>
    </div>
  </div>

  <div class="panel panel-danger text-center">
    <div class="panel-body">
      <div class="col-xs-12 col-md-4">
        <center>
          <img src="{{asset('images/site-resources/promo.png')}}" class="img-responsive" alt="">
        </center>
      </div>
      <div class="col-xs-12 col-md-8" >
        <h1>Nuestras promociones</h1>
        <h3>¿Quiere aprovechar mejores precios? Visite nuestras <b>promociones online</b> y compre a un menor precio.</h3>
        <hr>
        <a href="{{url('promo')}}" class="btn btn-primary btn-lg">Ver Promociones</a>
      </div>
    </div>
  </div>

  <div class="panel panel-danger text-center">
    <div class="panel-body">
      <div class="col-xs-12 col-md-4">
        <center>
          <img src="{{asset('images/site-resources/maps.png')}}" class="img-responsive" alt="">
        </center>
      </div>
      <div class="col-xs-12 col-md-8" >
        <h1>Nos encontramos en Mar del Plata</h1>
        <h3>Mire donde puede encontrarnos.</h3>
        <hr>
        <a href="{{url('location')}}" class="btn btn-danger btn-lg">Ver Ubicaciones</a>
      </div>
    </div>
  </div>

  <div class="panel panel-danger text-center">
    <div class="panel-body">
      <div class="col-xs-12 col-md-offset-3 col-md-6" style="margin-bottom: 15px;">
        <div class="jumbotron text-center" style="background-color: #B2DFDB">
          <h2>¿Aun no es usuario?</h2>
        </div>
        <a href="{{ route('register') }}" class="btn btn-info btn-block btn-lg">Registrarse</a>
      </div>

    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
  $('.carousel').carousel({
    interval: 1000 * 3.5
  });
  </script>
@endsection
