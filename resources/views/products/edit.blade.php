@extends('layout')

@section('title', 'Editar Producto')

@section('css')
  {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
  <div class="row">
    {!! Form::model($product, array('route' => ['products.update', $product->id], 'method' => 'PUT', 'files' => true)) !!}
    {{-- Editable data --}}
    <div class="col-xs-12 col-md-8">
      {{ Form::label('name', 'Nombre del producto:')}}
      {{ Form::text('name', null, array('class' => 'form-control')) }}

      {{ Form::label('price', 'Precio del producto:')}}
      {{ Form::number('price', null, array('class' => 'form-control', 'step' => '0.01')) }}

      {{ Form::label('description', 'Descripción:')}}
      {{ Form::textarea('description', null, array('class' => 'form-control')) }}

      {{ Form::label('promo', 'Agregar a promociones: ') }}
      {{ Form::checkbox('promo') }}
      <br>

      {{ Form::label('units', 'Unidades de medida del producto:')}}
      {{ Form::text('units', null, array('class' => 'form-control', 'required' => '')) }}

      {{ Form::label('feature_image', 'Cambiar imagen') }}
      {{ Form::file('feature_image') }}

      {{ Form::label('tags', 'Palabras claves') }}
      {{ Form::select('tags[]',$tags, null ,['class' => 'form-control select2multiple', 'multiple' => 'multiple']) }}
    </div>
    {{-- Sidebar --}}
    <div class="col-xs-12 col-md-4">
      <div class="well">
        <center><label>Información extra</label></center>
        <dl class="dl-horizontal">
          <dt>{{ Form::label('category_id', 'Categoría') }}</dt>
          <dd>{{ Form::select('category_id',$categories, null ,['class' => 'form-control']) }}</dd>
          <dt>Creado:</dt>
          <dd>{{ date('d/m/Y - H:i',strtotime($product->created_at)) }}</dd>
          <dt>Ultima modificación:</dt>
          <dd>{{ date('d/m/Y - H:i',strtotime($product->updated_at)) }}</dd>
        </dl>
        <hr>
        <div class="row">
          <div class="col-xs-6">
            {!! Html::linkRoute('products.show', 'Cancelar', array($product->id), array('class' => 'btn btn-danger btn-block')) !!}
          </div>
          <div class="col-xs-6">
            {{ Form::submit('Guardar', array('class' => 'btn btn-success btn-block')) }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
@endsection

@section('js')
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $(".select2multiple").select2();
    $('.select2multiple').select2().val({{ $jsontags }}).trigger('change');﻿
  </script>
@endsection
