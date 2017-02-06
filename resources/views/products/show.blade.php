@extends('layout')

@section('title', 'Ver Producto')

@section('content')
  <div class="row">
    {{-- Principal data --}}
    <div itemscope itemtype="https://schema.org/Product" class="col-xs-12 col-md-8">
      <center>
        @if ($product->image != null)
          <center>
            <img itemprop="image" class="img-responsive" src="{{asset('images/' . $product->image)}}" alt="Imagen para {{ $product->name }}">
          </center>
        @else
          <center>
            <img itemprop="image" class="img-responsive" src="{{asset('images/site-resources/noimage.png')}}" alt="Imagen no encontrada">
          </center>
        @endif
        <h1 itemprop="name"><b>{{ $product->name }}</b></h1>
        <h4>Precio unitario: ${{ number_format((float)$product->price, 2, ',', '')  }}</h4>
        @foreach ($product->tags as $tag)
          <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
        @endforeach
      </center>
      <hr>
    </div>
    {{-- Sidebar --}}
    <div class="col-xs-12 col-md-4">
      <div itemprop="description" class="well">
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
            <center>
              <h5><b>Agregar al carrito de compras</b></h5>
              {!! Form::open(array('route' => 'cart.store', 'method' => 'post', 'class' => 'form-inline')) !!}
              <div class="input-group">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                {{ Form::number('quantity', null, array('class' => 'form-control', 'placeholder' => '0', 'min' => '0'))}}
                <span title="{{ $product->units }}" class="input-group-addon">
                  {{ strlen($product->units) <=10 ? $product->units : substr($product->units,0,10) . "..."}}
                </span>
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-success">+ <span class="glyphicon glyphicon-shopping-cart"></span></button>
                </div>
              </div>
              {!! Form::close() !!}
            </center>
            <br>
          </div>
          @if (Auth::check() && Auth::user()->isAdmin())
            <div class="col-xs-6">
              {!! Html::linkRoute('products.edit', 'Modificar', array($product->id), array('class' => 'btn btn-primary btn-block')) !!}
            </div>
            <div class="col-xs-6">
              {!! Form::open(array('route' => ['products.destroy', $product->id], 'method' => 'delete')) !!}
              {{ Form::submit('Eliminar', array('class' => 'btn btn-danger btn-block')) }}
              {!! Form::close() !!}
            </div>
          @endif
          <div class="col-xs-12">
            <br>
            {!! Html::linkRoute('products.index', 'Ir al indice', array($product->id), array('class' => 'btn btn-default btn-block')) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
