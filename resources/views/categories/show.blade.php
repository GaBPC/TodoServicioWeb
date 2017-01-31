@extends('layout')

@section('title', "$category->category_name")

@section('content')
  <div class="row">
    <div class="col-xs-9">
      <h1>{{ $category->name }} Categoria <small>Presente en {{ $category->products()->count() }} producto(s)</small></h1>
    </div>
  </div>
  <hr>

  {{-- Start of row --}}
  <div class="row">
    <div class="col-xs-12">
  @foreach ($category->products as $index => $product)
    <div class="col-xs-12 col-md-3">
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
            @endif
            <strong>Precio unitario: </strong>${{ $product->price }}
            <br>
            <strong> ID: </strong>{{ $product->id }}
            <br>
            <hr>
            <div class="col-xs-12">
              <a href="{{route('products.show', $product->id)}}" class="btn btn-info btn-sm btn-block">Más información</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- For md screen: if 4 items have already been printed, closes the row and open a new one --}}
    @if (($index + 1) % 4 == 0)
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
    @endif
  @endforeach
@endsection
