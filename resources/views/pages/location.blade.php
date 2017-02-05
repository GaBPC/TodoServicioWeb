@extends('layout')

@section('title','Ubicación')

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#FFF59D ; color: black;">
    <div class="container text-center">
      <h2>Encuentrenos en Mar del Plata.</h2>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
      <div class="panel-group">
        <div class="panel panel-warning ">
          <div class="panel-heading text-center">
            <strong><h2>Oficina comercial</h2></strong>
          </div>
          <div class="panel-body">
            <iframe class="gmap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3142.372516005586!2d-57.550019084362134!3d-38.03840557971232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9584ddd9f749a635%3A0xf009d0fa33d37a89!2sRondeau+129%2C+B7603BDC+Mar+del+Plata%2C+Buenos+Aires!5e0!3m2!1ses-419!2sar!4v1485920419432" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
      <div class="panel-group">
        <div class="panel panel-warning ">
          <div class="panel-heading text-center">
            <strong><h2>Depósito y expedición</h2></strong>
          </div>
          <div class="panel-body">
            <iframe class="gmap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3145.4134804885853!2d-57.60964148436394!3d-37.96747877972482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9584d8571bf6d321%3A0x9aae05ec233aa8f7!2sAv.+Pedro+Luro+%26+Brasil%2C+Mar+del+Plata%2C+Buenos+Aires!5e0!3m2!1ses-419!2sar!4v1485920979927" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
