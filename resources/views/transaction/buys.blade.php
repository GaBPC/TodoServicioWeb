@extends('layout')

@section('title', 'Carrito')

@section('navbar-extend')
  <div class="jumbotron text-center" style="background-color:#E040FB ; color: white;">
    <div class="container">
      <h2>Estas son las promociones que usted esta por comprar:</h2>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 text-center">
      <table class="table">
        <thead>
          <th class="text-center">Nombre</th>
          <th class="text-center">Precio</th>
          <th class="text-center">Cantidad</th>
          <th class="text-center">Subtotal</th>
          <th class="text-center"></th>
        </thead>

        <tbody>
          @for ($i=0; $i < $buys['counter']; $i++)
            <tr>
              <td class="text-center">
                <a href="{{ route('products.show',$buys[$i]['product']->id) }}">
                  {{$buys[$i]['product']->name}}
                </a>
              </td>
              <td class="text-center">{{ $buys[$i]['product']->price }}</td>
              <td class="text-center">{{$buys[$i]['quantity']}} {{ $buys[$i]['product']->units }}</td>
              <td class="text-center">{{ $buys[$i]['product']->price * $buys[$i]['quantity'] }}</td>
              <td class="text-center">
                {!! Form::open(array('route' => ['buy.destroy', $buys[$i]['id']], 'method' => 'DELETE')) !!}
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
            <td class="text-center">${{number_format((float)$buys['total'], 2, ',', '')}}</td>
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
      <a href="{{ route('buy.send') }}" class="btn btn-success btn-block">Realizar mi compra</a>
    </div>
  </div>
@endsection
