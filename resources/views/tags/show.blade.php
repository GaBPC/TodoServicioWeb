@extends('layout')

@section('title', "$tag->name Tag")

@section('content')
  <div class="row">
    <div class="col-xs-9">
      <h1>{{ $tag->name }} Tag <small>Presente en {{ $tag->products()->count() }} producto(s)</small></h1>
    </div>
    <div class="col-xs-3">
      {!! Form::open(['route' => ['tags.destroy',$tag->id], 'method' => 'DELETE']) !!}
        {{ Form::submit('Eliminar',['class' => 'btn btn-danger btn-block pull-right', 'style' => 'margin-top: 30px']) }}
      {!! Form::close() !!}
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-12">
      <table class="table">
        <thead>
          <th>#</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Categoria</th>
          <th>Otros Tags</th>
          <th></th>
        </thead>

        <tbody>
          @foreach ($tag->products as $product)
            <tr>
              <th>{{ $product->id }}</th>
              <td>{{ $product->name }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->category->category_name }}</td>
              <td>
                @foreach ($product->tags as $tag_p)
                  <a href="{{ route('tags.show', $tag_p->id) }}"><span class="label label-default">{{ $tag_p->name }}</span></a>
                @endforeach
              </td>
              <td><a href="{{ route('products.show',$product->id) }}" class="btn btn-sm btn-default btn-block">Ver</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
