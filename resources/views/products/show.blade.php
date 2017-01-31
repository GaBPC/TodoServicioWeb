@extends('layout')

@section('title', 'Ver Producto')

@section('content')
  <div class="row">
    {{-- Principal data --}}
    <div class="col-xs-12 col-md-8">
      <center>
        @if ($product->image != null)
          <img class="img-responsive img-thumbnail" src="{{asset('images/' . $product->image)}}" alt="Imagen para {{ $product->name }}">
        @endif
        <h1><b>{{ $product->name }}</b></h1>
        <h4>Precio unitario: ${{ $product->price }}</h4>
        @foreach ($product->tags as $tag)
          <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
        @endforeach
      </center>
      <hr>
    </div>
    {{-- Sidebar --}}
    <div class="col-xs-12 col-md-4">
      <div class="well">
        <center><label>Información extra</label></center>
        <dl class="dl-horizontal">
          <dt>Categoría:</dt>
          <dd>{{ $product->category->category_name }}</dd>
          <dt>Creado:</dt>
          <dd>{{ date('d/m/Y - H:i',strtotime($product->created_at)) }}</dd>
          <dt>Ultima modificación:</dt>
          <dd>{{ date('d/m/Y - H:i',strtotime($product->updated_at)) }}</dd>
        </dl>
        <hr>
        <div class="row">
          <div class="col-xs-12">
            <a href="#" class="btn btn-success btn-block">Agregar al carrito</a>
            <br>
          </div>
          <div class="col-xs-6">
            {!! Html::linkRoute('products.edit', 'Modificar', array($product->id), array('class' => 'btn btn-primary btn-block')) !!}
          </div>
          <div class="col-xs-6">
            {!! Form::open(array('route' => ['products.destroy', $product->id], 'method' => 'delete')) !!}
            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger btn-block')) }}
            {!! Form::close() !!}
          </div>
          <div class="col-xs-12">
            <br>
            {!! Html::linkRoute('products.index', 'Ir al indice', array($product->id), array('class' => 'btn btn-default btn-block')) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
