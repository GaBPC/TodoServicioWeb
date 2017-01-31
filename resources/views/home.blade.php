@extends('layout')

@section('title','Control')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Panel de usuario</div>

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
                  <label>Registrado desde:</label> {{ Auth::user()->created_at }}
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
