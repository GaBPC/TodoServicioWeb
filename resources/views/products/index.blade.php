@extends('layout')

@section('title','Nuestros productos')

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#448AFF ; color: white;">
    <div class="container text-center">
      <h1>Nuestros productos.</h1>
      <hr>
    </div>
  </div>
@endsection

@section('content')
  <div class="col-xs-12 col-md-8">
    @foreach ($products as $product)
      <div class="panel-group text-center">
        <div class="panel panel-info">
          <div class="panel-heading">
            <strong><h3>{{ $product->name }}</h3></strong>
          </div>
          <div class="panel-body">
            @if ($product->image != null)
              <center>
                <img class="img-responsive" src="{{asset('images/' . $product->image)}}" alt="Imagen para {{ $product->name }}">
              </center>
            @else
              <center>
                <img class="img-responsive" src="{{asset('images/site-resources/noimage.png')}}" alt="Imagen no encontrada">
              </center>
            @endif
            <strong>Precio unitario: </strong>${{ $product->price }}
            <br>
            <strong> ID: </strong>{{ $product->id }}
            <br>
            <hr>
            <div class="col-xs-12 col-md-offset-2 col-md-4">
              <a href="{{route('products.show', $product->id)}}" class="btn btn-info btn-sm btn-block">Más información</a>
            </div>
            <div class="visible-xs visible-sm">
              <br><br>
            </div>
            <div class="col-xs-12 col-md-4">
              <a href="#" class="btn btn-success btn-sm btn-block">Agregar al carrito</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <div class="col-xs-12 text-center">
      {!! $products->links() !!}
    </div>
  </div>

  {{-- Personalized page link --}}
  <div class="col-xs-12 col-md-4">
    <a href="{{ url('custom') }}"><img class="img-responsive radius-border" src="{{asset('images/site-resources/personal.png')}}" alt="Imagen para personalizados"></a>
    <br>
  </div>

  <div class="col-xs-12 col-md-4">
    <div class="well" style="background-color: #448AFF; color: white">
      <h3>Ver por categoria:</h3>
      <ul>
        @foreach ($categories as $category)
          <li><h4><a href="{{ route('categories.show',$category->id) }}" style="color: white">{{$category->category_name}}</a></h4></li>
        @endforeach
      </ul>
    </div>
  </div>


@endsection
