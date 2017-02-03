@extends('layout')

@section('title', 'Carrito')

@section('navbar-extend')
  <div class="jumbotron text-center" style="background-color:#E040FB ; color: white;">
    <div class="container">
      <h2>Este es el estado actual de su carrito de compras:</h2>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <table class="table">
        <thead>
          <th class="text-center">Nombre</th>
          <th class="text-center">Precio</th>
          <th class="text-center">Cantidad</th>
          <th class="text-center">Subtotal</th>
          <th class="text-center"></th>
        </thead>

        <tbody>
          @for ($i=0; $i < $data['counter']; $i++)
            <tr>
              <td class="text-center">
                <a href="{{ route('products.show',$data[$i]['product']->id) }}">
                  {{$data[$i]['product']->name}}
                </a>
              </td>
              <td class="text-center">${{ number_format((float)$data[$i]['product']->price, 2, ',', '') }}</td>
              <td class="text-center">{{$data[$i]['quantity']}}</td>
              <td class="text-center">${{number_format((float)$data[$i]['product']->price * $data[$i]['quantity'], 2, ',', '')}}</td>
              <td class="text-center">
                {!! Form::open(array('route' => ['cart.destroy', $data[$i]['id']], 'method' => 'delete')) !!}
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
            <td class="text-center">${{number_format((float)$data['total'], 2, ',', '')}}</td>
            <td>
              <a href="{{ url('cart/destroyAll') }}" class="btn btn-danger btn-block btn-sm">Vaciar</a>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <div class="row">
    <hr>
    <div class="col-xs-12 col-md-offset-4 col-md-4">
      <a href="{{ url('cart/submit') }}" class="btn btn-success btn-block">Realizar pedido</a>
    </div>
  </div>
@endsection
