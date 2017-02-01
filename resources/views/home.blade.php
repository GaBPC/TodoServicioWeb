@extends('layout')

@section('title','Control')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Panel de administrador</div>

          <div class="panel-body">
            <center>
              <!-- Authentication Links -->
              @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
              @else
                <div class="form-group">
                  <label>Sesión iniciada como:</label> {{ Auth::user()->name }}
                  <hr>
                  <label>E-mail:</label> {{ Auth::user()->email }}
                  <hr>
                  <label>Registrado desde:</label> {{ date('d/m/Y - H:i',strtotime(Auth::user()->created_at)) }}
                  <br>
                  <label>Ultimo cambio de contraseña:</label> {{ date('d/m/Y - H:i',strtotime(Auth::user()->updated_at)) }}
                  @if (Auth::user()->role == 1)
                    <hr>
                    <div class="row">
                      <h4>¿Qué desea administrar?:</h4>
                      <div class="col-xs-12 col-md-6">
                        <br>
                        <a href="{{ route('tags.index') }}" class="btn btn-primary btn-block">Palabras claves</a>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <br>
                        <a href="{{ route('categories.index') }}" class="btn btn-info btn-block">Categorías</a>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <br>
                        <a href="{{ route('products.create') }}" class="btn btn-success btn-block">Agregar producto</a>
                      </div>
                    </div>
                  @endif
                  <hr>
                </div>
                <form id="logout-form" class="form-horizontal" action="{{ route('logout') }}" method="POST">
                  {{ csrf_field() }}
                  <input type="submit" class="btn btn-danger" value="Cerrar sesión">
                </form>
              @endif
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
