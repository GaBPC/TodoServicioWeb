@extends('layout')

@section('title', 'Tags')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Creado</th>
            <th>Ultima modifiación</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach ($tags as $tag)
            <tr>
              <th>{{ $tag->id }}</th>
              <td><a href="{{ route('tags.show',$tag->id) }}">{{ $tag->name }}</a></td>
              <td>{{ date('d/m/Y - H:i',strtotime($tag->created_at)) }}</td>
              <td>{{ date('d/m/Y - H:i',strtotime($tag->updated_at)) }}</td>
              <td>
                <center>
                  {!! Form::open(['route' => ['tags.destroy',$tag->id], 'method' => 'DELETE']) !!}
                  {{ Form::submit('X',['class' => 'btn btn-danger btn-sm']) }}
                  {!! Form::close() !!}
                </center>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-md-4">
      <div class="well">
        {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
        <center><h3>Crear nuevo tag</h3></center>
        {{Form::label('name','Nombre')}}
        {{Form::text('name', null, ['class' => 'form-control'])}}
        <hr>
        {{Form::submit('Guardar', ['class' => 'btn btn-success btn-block'])}}
        {!! Form::close() !!}
      </div>
    </div>

  </div>

@endsection
