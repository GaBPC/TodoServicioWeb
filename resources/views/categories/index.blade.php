@extends('layout')

@section('title', 'Categorías')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Creada</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($categories as $category)
            <tr>
              <th>{{ $category->id }}</th>
              <td>{{ $category->category_name }}</td>
              <td>{{ $category->created_at }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-md-4">
      <div class="well">
        {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
        <center><h3>Crear nueva categoría</h3></center>
        {{Form::label('category_name','Nombre')}}
        {{Form::text('category_name', null, ['class' => 'form-control'])}}
        <hr>
        {{Form::submit('Guardar', ['class' => 'btn btn-success btn-block'])}}
        {!! Form::close() !!}
      </div>
    </div>

  </div>

@endsection
