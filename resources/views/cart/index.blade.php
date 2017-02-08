@extends('layout')

@section('title', 'Carrito')

@section('navbar-extend')
  <div class="jumbotron text-center" style="background-color:#E040FB ; color: white;">
    <div class="container">
      <h2>Este es el estado actual de sus transacciones:</h2>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 text-center">
      <h1><u>Mi presupuesto personalizado:</u></h1>
      <table class="table">
        <thead>
          <th class="text-center">Nombre</th>
          <th class="text-center">Precio</th>
          <th class="text-center">Cantidad</th>
          <th class="text-center">Subtotal</th>
          <th class="text-center"></th>
        </thead>

        <tbody>
          @for ($i=0; $i < $normals['counter']; $i++)
            <tr>
              <td class="text-center">
                <a href="{{ route('products.show',$normals[$i]['product']->id) }}">
                  {{$normals[$i]['product']->name}}
                </a>
              </td>
              <td class="text-center">A determinar</td>
              <td class="text-center">{{$normals[$i]['quantity']}} {{ $normals[$i]['product']->units }}</td>
              <td class="text-center">A determinar</td>
              <td class="text-center">
                {!! Form::open(array('route' => ['cart.destroy', $normals[$i]['id']], 'method' => 'delete')) !!}
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
    <hr>
    <div class="col-xs-12 col-md-offset-4 col-md-4">
      <a href="{{ url('cart/submit') }}" class="btn btn-success btn-block">Solicitar mi presupuesto</a>
    </div>
  </div>

  {{--  ------------------------------------------------------------------------------------------------------- --}}
  <hr>
  {{--  ------------------------------------------------------------------------------------------------------- --}}

  <div class="row">
    <div class="col-xs-12 text-center">
      <h1><u>Mi promociones reservadas:</u></h1>
      <table class="table">
        <thead>
          <th class="text-center">Nombre</th>
          <th class="text-center">Precio</th>
          <th class="text-center">Cantidad</th>
          <th class="text-center">Subtotal</th>
          <th class="text-center"></th>
        </thead>

        <tbody>
          @for ($i=0; $i < $promos['counter']; $i++)
            <tr>
              <td class="text-center">
                <a href="{{ route('products.show',$promos[$i]['product']->id) }}">
                  {{$promos[$i]['product']->name}}
                </a>
              </td>
              <td class="text-center">{{ $promos[$i]['product']->price }}</td>
              <td class="text-center">{{$promos[$i]['quantity']}} {{ $promos[$i]['product']->units }}</td>
              <td class="text-center">{{ $promos[$i]['product']->price * $promos[$i]['quantity'] }}</td>
              <td class="text-center">
                {!! Form::open(array('route' => ['cart.destroy', $promos[$i]['id']], 'method' => 'delete')) !!}
                {{ Form::submit('-', array('class' => 'btn btn-danger btn-block')) }}
                {!! Form::close() !!}
              </td>
            </tr>
          @endfor
        </tbody>

        <tfoot>
          <tr>
            <td></td>
            <td></td>
            <th class="text-center">Total:</th>
            <td class="text-center">${{number_format((float)$promos['total'], 2, ',', '')}}</td>
            <td>
              {{-- <a href="{{ url('cart/destroyAll') }}" class="btn btn-danger btn-block btn-sm">Vaciar</a> --}}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="row">
    <hr>
    <div class="col-xs-12 col-md-offset-4 col-md-4">
      <a href="{{ url('cart/submit') }}" class="btn btn-success btn-block">Enviar mis reservas</a>
    </div>
  </div>
@endsection
