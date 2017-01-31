@extends('layout')

@section('title','Nuestros productos')

@section('content')
  <div class="row">
    <div class="col-xs-12 alert-danger">
      <h1 class="text-center">Nuestros productos</h1>
      <br>
    </div>
  </div>

  @foreach ($products as $product)
    <div class="row">
      <div class="col-xs-12 col-md-4">
        <br>
        @if ($product->image != null)
          <img class="img-responsive img-thumbnail img-index" src="{{asset('images/' . $product->image)}}" alt="Imagen para {{ $product->name }}">
        @endif
      </div>
      <div class="col-xs-12 col-md-8">
        <br>
        <div class="panel-group text-center">
          <div class="panel panel-info">
            <div class="panel-heading">
              <strong>Información</strong>
            </div>
            <div class="panel-body">
              <strong>Nombre: </strong>{{ $product->name }}
              <br>
              <strong>Precio unitario: </strong>${{ $product->price }}
              <br>
              <strong>ID: </strong>{{ $product->id }}
              <br>
              <hr>
              <div class="col-xs-offset-4 col-xs-4">
                <a href="{{route('products.show', $product->id)}}" class="btn btn-success btn-sm btn-block">Ver</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  <div class="col-xs-12 text-center">
    {!! $products->links() !!}
  </div>
@endsection
