@extends('layout')

@section('googlehtml')
  <meta name="google-site-verification" content="G53srD0kSSZ0n1ZjCnC008jZ0fuNHVcd1oGs5cJ9wtk" />
@endsection

@section('title','Nuestros productos')

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#448AFF ; color: white;">
    <div class="container text-center">
      <h2>Nuestras promociones.</h2>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @foreach ($products as $product)
        <div itemscope itemtype="https://schema.org/Product" class="col-xs-12 col-md-4 panel-group text-center">
          <div class="panel panel-info">
            <div class="panel-heading">
              <strong itemprop="name"><h3>{{ $product->name }}
                @if ($product->isInPromo())
                  <i class="glyphicon glyphicon-star"></i>
                @endif
              </h3></strong>
            </div>
            <div class="panel-body">
              @if ($product->image != null)
                <center>
                  <img itemprop="image" class="img-responsive" src="{{asset('images/' . $product->image)}}" alt="Imagen para {{ $product->name }}">
                </center>
              @else
                <center>
                  <img itemprop="image" class="img-responsive" src="{{asset('images/site-resources/noimage.png')}}" alt="Imagen no encontrada">
                </center>
              @endif
              <hr>
              <div itemprop="description">
                <b>Venta por:</b> {{ $product->units }}
                <p>{{ $product->description }}</p>
                <strong>Precio unitario: </strong>${{ number_format((float)$product->price, 2, ',', '') }}
                <hr>
              </div>
              <div class="col-xs-12 col-md-offset-2 col-md-8">
                <a itemprop="url" href="{{route('products.show', $product->id)}}" class="btn btn-info btn-sm btn-block">Más información</a>
              </div>
            </div>
          </div>
        </div>
        @if (($loop->index + 1) % 3 == 0)
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
        @endif
      @endforeach
    </div>
  </div>
@endsection
