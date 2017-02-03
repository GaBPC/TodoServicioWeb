@extends('layout')

@section('title','Nuestros productos')

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#E1F5FE ; color: black;">
    <div class="container text-center">
      <h2>Complete el formulario para solicitar su presupuesto.</h2>
      (*Si abandona esta página sin enviar los datos, estos no se guardarán)
    </div>
  </div>
@endsection

@section('content')
  <div id="app">
    {!! Form::open(array('url' => 'custom', 'method' => 'POST')) !!}
    <input type="hidden" name="counter" v-bind:value="counter">
    <table class="table">
      <thead>
        <th class="text-center">Descripción</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center"></th>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <input id="description" class="form-control" type="text" placeholder="Ingrese la descripción">
          </td>
          <td class="text-center">
            <input id="quantity" class="form-control" type="number" value="1" min="1" >
          </td>
          <td class="text-center">
            <input @click="addItem" type="button" class="btn btn-success btn-block" value="+">
          </td>
        </tr>
        <tr v-for="item in items">
          <td>
            <input class="form-control" v-model="item.description" v-bind:name="'description' + item.id" required/>
          </td>
          <td>
            <input class="form-control" v-model="item.quantity" v-bind:name="'quantity' + item.id" required/>
          </td>
          <td class="text-center">
            <input @click="removeItem" type="button" v-bind:id="item.id" value="-" class="btn btn-danger btn-block">
          </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <div class="col-xs-12 col-md-offset-4 col-md-4">
      {{ Form::submit('Enviar',array('class' => 'btn btn-info btn-block')) }}
    </div>
    {!! Form::close() !!}
  </div>
@endsection

@section('js')
  <script src="https://unpkg.com/vue@2.1.10/dist/vue.js"></script>
  <script>
  var app = new Vue({
    el: '#app',
    data: {
      counter: '0',
      items: [ ]
    },
    methods: {
      addItem: function(){
        var description = document.getElementById('description');
        var quantity = document.getElementById('quantity');
        var quantityvalue = parseInt(quantity.value);
        if(isNaN(quantityvalue) || quantityvalue < 1) { quantityvalue = 1 }
        this.items.push({"description": description.value, "quantity": quantityvalue , "id":this.counter});
        this.counter++;
        description.value = "";
        quantity.value = "1";
      },
      removeItem: function(){
        var id = event.target.id;
        var encontrado = false;
        var i = 0;
        while(i < this.items.length && !encontrado){
          if(this.items[i].id == id){
            encontrado = true;
            this.items.splice(i, 1);
          }
          else {
            i++;
          }
        }
      }
    }
  })
  </script>
@endsection
