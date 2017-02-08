@extends('layout')

@section('title','Pedidos pendientes')

@section('content')

  <div class="row">
    <div class="col-xs-12">
      <h1>Presupuestos pendientes de revisión</h1>

      <table class="table">
        <thead>
          <th>Mail</th>
          <th>Archivo</th>
          <th>Fecha</th>
          <th></th>
        </thead>

        <tbody>
          @foreach ($custom_items as $item)
            <tr>
              <td>{{ $item->user_email }}</td>
              <td><a href="{{ route('orders.show', $item->id) }}">{{ $item->file_name }}</a></td>
              <td>{{ date('d/m/Y - H:i',strtotime($item->created_at)) }}</td>
              <td>
                {!! Form::open(array('route' => ['orders.destroy', $item->id], 'method' => 'delete')) !!}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger btn-block')) }}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <hr>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <h1>Compras pendientes de revisión</h1>

      <table class="table">
        <thead>
          <th>Mail</th>
          <th>Archivo</th>
          <th>Fecha</th>
          <th></th>
        </thead>

        <tbody>
          @foreach ($cart_items as $item)
            <tr>
              <td>{{ $item->user_email }}</td>
              <td><a href="{{ route('orders.show', $item->id) }}">{{ $item->file_name }}</a></td>
              <td>{{ date('d/m/Y - H:i',strtotime($item->created_at)) }}</td>
              <td>
                {!! Form::open(array('route' => ['orders.destroy', $item->id], 'method' => 'delete')) !!}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger btn-block')) }}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
