@extends('layout')

@section('title','Agregar nuevo producto')

@section('css')
  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-md-offset-2 col-md-8">
      <h1 class="text-center">Agregar un nuevo producto</h1>
      <hr>
      {!! Form::open(array('route' => 'products.store', 'data-parsley-validate' => '', 'files' => true)) !!}
      {{ Form::label('name', 'Nombre') }}
      {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}
      <br>
      {{ Form::label('price', 'Precio') }}
      {{ Form::number('price', null, array('class' => 'form-control', 'placeholder' => 'Ingrese el precio', 'required' => '', 'min' => '0', 'step' => '0.01')) }}
      <br>
      {{ Form::label('units', 'Unidades de medida') }}
      {{ Form::text('units', null, array('class' => 'form-control', 'placeholder' => 'Ingrese la unidad de medida', 'required' => '')) }}
      <br>
      {{ Form::label('feature_image', 'Subir imagen') }}
      {{ Form::file('feature_image')}}
      <br>
      {{ Form::label('category_id', 'Categoría') }}
      <select class="form-control" name='category_id'>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
      </select>
      <br>
      {{ Form::label('tags', 'Palabras claves') }}
      <select class="form-control select2multiple" multiple="multiple" name="tags[]"> <!--[] are for pass the data as a array to the request -->
        @foreach ($tags as $tag)
          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
      </select>
      <br>
      <br>
      {{ Form::submit('Agregar',array('class' => 'btn btn-success btn-block')) }}
      {!! Form::close() !!}
    </div>
  </div>
@endsection

@section('js')
  {!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $(".select2multiple").select2();
  </script>
@endsection
