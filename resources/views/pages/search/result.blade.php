@extends('layout')

@section('title','Resultados')

@section('navbar-extend')
  <div class="jumbotron text-center" style="background-color:#00C853 ; color: white;">
    <div class="container">
      <h2>Hemos encontrado esto:</h2>
    </div>
  </div>
@endsection

@section('content')

  <div class="alert alert-info" role="alert">
      Si aquí no encuentra lo que buscaba, no dude en agregarlo en la seccion de <a href="{{ url('budget') }}">Mi Presupuesto</a> y nosotros intentaremos conseguirlo.
  </div>

  <div class="col-xs-12">
    <hr>
  </div>
  {{-- Start of row --}}
  <div class="row">
    <div class="col-xs-12">
      @foreach ($products as $index => $product)
        <div itemscope itemtype="https://schema.org/Product" class="col-xs-12 col-md-3">
          <div class="panel-group text-center">
            <div class="panel panel-success">
              <div class="panel-heading">
                <strong itemprop="name">
                  <h5>
                    {{ strlen($product->name) <= 60 ? $product->name : substr($product->name,0,60) . "..."}}
                    @if ($product->isInPromo())
                      <i class="glyphicon glyphicon-star"></i>
                    @endif
                  </h5>
                </strong>
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
                <div itemprop="description">
                  <hr>
                  <p>{{ $product->description }}</p>
                  @if ($product->isInPromo())
                    <strong>Precio unitario: </strong>${{ number_format((float)$product->price, 2, ',', '') }}
                    <br>
                  @endif
                  <strong> ID: </strong>{{ $product->id }}
                  <br>
                  <hr>
                </div>
                <div class="col-xs-12">
                  <a itemprop="url" href="{{route('products.show', $product->id)}}" class="btn btn-primary btn-sm btn-block">Más información</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- For md screen: if 4 items have already been printed, closes the row and open a new one --}}
        @if (($loop->index + 1) % 4 == 0)
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
        @endif
      @endforeach
    </div>
  </div>
  <div class="col-xs-12">
    <hr>
  </div>
@endsection
