@extends('layout')

@section('title', 'Ver Producto')

@section('content')
  <div class="row">
    {{-- Principal data --}}
    <div itemscope itemtype="https://schema.org/Product" class="col-xs-12 col-md-8" style="margin-bottom: 20px;">
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
        <p>{{ $product->description }}</p>
        @if ($product->isInPromo())
          <h4>Precio unitario: ${{ number_format((float)$product->price, 2, ',', '')  }}</h4>
        @endif
        @foreach ($product->tags as $tag)
          <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
        @endforeach
      </center>
    </div>
    {{-- Sidebar --}}
    <div class="col-xs-12 col-md-4">
      <div itemprop="description" class="well">
        <center><label>Información extra</label></center>
        <dl class="dl-horizontal">
          <dt>Categoría:</dt>
          <dd>{{ $product->category->category_name }}</dd>
          <dt>Creación:</dt>
          <dd>{{ date('d/m/Y - H:i',strtotime($product->created_at)) }}</dd>
          <dt>Ultima modificación:</dt>
          <dd>{{ date('d/m/Y - H:i',strtotime($product->updated_at)) }}</dd>
        </dl>
        <hr>
        <div class="row">
          <div class="col-xs-12">
            <center>
              @if ($product->isInPromo())
                <h5><b>¡Comprar!</b></h5>
                {!! Form::open(array('route' => 'buy.store', 'method' => 'post', 'class' => 'form-inline')) !!}
                <div class="input-group">
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  {{ Form::number('quantity', null, array('class' => 'form-control', 'placeholder' => '0', 'min' => '0'))}}
                  <span title="{{ $product->units }}" class="input-group-addon">
                    {{ strlen($product->units) <=10 ? $product->units : substr($product->units,0,10) . "..."}}
                  </span>
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-usd"></span></button>
                  </div>
                </div>
                {!! Form::close() !!}
              @else
                <h5><b>Agregar al presupuesto</b></h5>
                {!! Form::open(array('route' => 'budget.store', 'method' => 'post', 'class' => 'form-inline')) !!}
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
              @endif
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
            {!! Html::linkRoute('products.index', 'Ir al índice', array($product->id), array('class' => 'btn btn-default btn-block')) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
