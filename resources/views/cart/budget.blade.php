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
          <th class="text-center">Subtotal</th>
          <th class="text-center"></th>
        </thead>

        <tbody>
          @for ($i=0; $i < $budgets['counter']; $i++)
            <tr>
              <td class="text-center">
                <a href="{{ route('products.show',$budgets[$i]['product']->id) }}">
                  {{$budgets[$i]['product']->name}}
                </a>
              </td>
              <td class="text-center">{{$budgets[$i]['quantity']}} {{ $budgets[$i]['product']->units }}</td>
              <td class="text-center">A determinar</td>
              <td class="text-center">
                {!! Form::open(array('route' => ['cart.destroy', $budgets[$i]['id']], 'method' => 'delete')) !!}
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
      <a href="{{ url('cart/submit',\App\ShoppingCart::BUDGET) }}" class="btn btn-success btn-block">Solicitar mi presupuesto</a>
    </div>
  </div>

@endsection
