@extends('layout')

@section('title','Buscar')

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#8BC34A; color: white;">
    <div class="container text-center">
      <h1>Busque entre nuestros productos:</h1>
      <hr>
    </div>
  </div>
@endsection

@section('content')
  <center>
    {!! Form::open(array('url' => 'search', 'class' => 'form-inline', 'method' => 'post')) !!}
    {{ Form::text('tag', null, array('class' => 'form-control input-lg', 'placeholder' => 'Ingrese la palabra clave', 'required' => '', 'maxlength' => '255')) }}
    <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> Buscar</button>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    {!! Form::close() !!}
  </center>
  <hr>

  <div class="col-xs-12 col-md-offset-2 col-md-4">
    <div class="well" style="background-color: #66BB6A; color: white">
      <h3>Ver por palabras claves:</h3>
      <ul>
        @foreach ($tags as $tag)
          <li><h4><a href="{{ route('tags.show',$tag->id) }}" style="color: white">{{$tag->name}}</a></h4></li>
        @endforeach
      </ul>
      <div class="col-xs-12 text-center">
        {!! $tags->links() !!}
      </div>
      &nbsp
    </div>
  </div>

  <div class="col-xs-12 col-md-4">
    <div class="well" style="background-color: #C8E6C9; color: black">
      <h3>Ver por categoria:</h3>
      <ul>
        @foreach ($categories as $category)
          <li><h4><a href="{{ route('categories.show',$category->id) }}" style="color: black">{{$category->category_name}}</a></h4></li>
        @endforeach
      </ul>
    </div>
  </div>

@endsection
