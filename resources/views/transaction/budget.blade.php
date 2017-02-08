@extends('layout')

@section('title', 'Carrito')

@section('navbar-extend')
  <div class="jumbotron text-center" style="background-color:#E040FB ; color: white;">
    <div class="container">
      <h2>Estos son los productos por los que usted va a pedir un presupuesto:</h2>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 text-center">
      <table class="table">
        <thead>
          <th class="text-center">Nombre</th>
          <th class="text-center">Cantidad</th>
          <th class="text-center"></th>
        </thead>

        <tbody>
          @for ($i=0; $i < $budgets['counter']; $i++)
            <tr>
              <td class="text-center">
                <a href="{{ route('products.show',$budgets[$i]['product']->id) }}">
                  {{$budgets[$i]['product']->name}}
                  <td class="text-center">{{$budgets[$i]['quantity']}} {{ $budgets[$i]['product']->units }}</td>
                </a>
              </td>
              <td class="text-center">
                {!! Form::open(array('route' => ['budget.destroy', $budgets[$i]['id']], 'method' => 'delete')) !!}
                {{ Form::submit('-', array('class' => 'btn btn-danger btn-block')) }}
                {!! Form::close() !!}
              </td>
            </tr>
          @endfor

          @for ($i=0; $i < $manual_budgets['counter']; $i++)
            <tr>
              <td class="text-center">
                {{$manual_budgets[$i]['description']}}
                <td class="text-center">{{$manual_budgets[$i]['quantity']}}</td>
              </td>
              <td class="text-center">
                {!! Form::open(array('route' => ['budget.destroy', $manual_budgets[$i]['id']], 'method' => 'delete')) !!}
                {{ Form::submit('-', array('class' => 'btn btn-danger btn-block')) }}
                {!! Form::close() !!}
              </td>
            </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <center>
        <h4>¿No encontró lo que buscaba? Agreguelo manualmente y nosotros lo intentaremos conseguir:</h4>
        {!! Form::open(array('route' => 'budget.manual', 'class' => 'form-inline', 'method' => 'post')) !!}
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
          {{ Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Ingrese la descripción', 'required' => '')) }}
        </div>
        <div class="form-group">
          {{ Form::number('quantity', null, array('class' => 'form-control', 'placeholder' => 'Ingrese la cantidad', 'required' => '')) }}
        </div>
        <button type="submit" class="btn btn-default">Agregar</button>
        {!! Form::close() !!}
      </center>
    </div>
  </div>

  <div class="row">
    <hr>
    <div class="col-xs-12 col-md-offset-4 col-md-4">
      <a href="{{ route('budget.send') }}" class="btn btn-success btn-block">Solicitar mi presupuesto</a>
    </div>
  </div>
@endsection
