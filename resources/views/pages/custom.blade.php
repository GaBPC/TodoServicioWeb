@extends('layout')

@section('title','Nuestros productos')

@section('css')
<style media="screen">
.input-group{
  margin-bottom: 10px;
}
</style>
@endsection

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#E1F5FE ; color: black;">
    <div class="container text-center">
      <h2>Complete el formulario para realizar su pedido o presupuesto.</h2>
    </div>
  </div>
@endsection

@section('content')
  {!! Form::open(array('url' => 'custom', 'method' => 'POST')) !!}
  <input type="hidden" id="counter" name="counter" value="0">
  <div id="inputs">
    <div class="input-group" id="group0">
      <input type="text" class="form-control" id="text0" name="text0" placeholder="Ingrese la descripción">
      <input type="number" class="form-control" id="number0" name="number0" value="1" min="1">
      <span class="input-group-addon">
        <button type="button" id="button0" class="btn btn-link btn-xs" onclick="addInput()">
          <i id="glyph0" class="glyphicon glyphicon-plus" style="font-size: 23px"></i>
        </button>
      </span>
    </div>
  </div>
  <hr>
  <div class="col-xs-12 col-md-offset-4 col-md-4">
    {{ Form::submit('Enviar',array('class' => 'btn btn-info btn-block btn-lg')) }}
  </div>
  {!! Form::close() !!}
@endsection

@section('js')
  <script type="text/javascript">
  function deleteInput(number){
    var div = document.getElementById("group" + number);
    div.remove();
  }

  function addInput(){
    var counter = document.getElementById("counter");
    var cant = parseInt(counter.value);

    cant += 1;
    counter.setAttribute('value', cant);

    var inputs_div = document.getElementById("inputs");

    var div = document.createElement("div");
    div.className += "input-group";
    div.setAttribute('id','group' + cant)

    var text = document.createElement("input");
    text.type = "text";
    text.className += "form-control";
    text.setAttribute('placeholder','Ingrese la descripción');
    text.setAttribute('name','text' + cant);
    text.setAttribute('id','text' + cant);

    var number = document.createElement("input");
    number.type = "number";
    number.className += "form-control";
    number.setAttribute('value','1');
    number.setAttribute('min','1');
    number.setAttribute('name','number' + cant);
    number.setAttribute('id','number' + cant);

    var span = document.createElement("span");
    span.className += "input-group-addon";

    var button = document.createElement("button");
    button.setAttribute('type','button');
    button.setAttribute('class','btn btn-link btn-xs');
    button.setAttribute('onclick','addInput()');
    button.setAttribute('id','button' + cant);

    var i = document.createElement("i");
    i.className += "glyphicon glyphicon-plus";
    i.setAttribute('style','font-size: 23px');
    i.setAttribute('id','glyph' + cant);

    button.appendChild(i);

    span.appendChild(button);

    div.appendChild(text);
    div.appendChild(number);
    div.appendChild(span);

    inputs_div.append(div);

    var prev_glyph = document.getElementById("glyph" + (cant-1));
    prev_glyph.setAttribute('class','glyphicon glyphicon-minus');
    prev_glyph.setAttribute('style','font-size: 23px; color: red;');

    var prev_button = document.getElementById("button" + (cant-1));
    prev_button.setAttribute('onclick','deleteInput('+ (cant-1) + ');')
  }

  // $(window).bind('beforeunload', function(){
  //   return 'Si abandona esta página se perderan los productos agregados, ¿Esta seguro que desea salir?';
  // });
  </script>
@endsection
