@extends('layout')

@section('googlehtml')
  <meta name="google-site-verification" content="G53srD0kSSZ0n1ZjCnC008jZ0fuNHVcd1oGs5cJ9wtk" />
@endsection

@section('title','Nuestros productos')

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#448AFF ; color: white;">
    <div class="container text-center">
      <h2>Nuestros productos.</h2>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">

  <div class="col-xs-12 col-md-3">
    <div class="well" style="background-color: #448AFF; color: white" id="panel">
      <div class=" text-center">
        <span @click="alternate" class="btn"><h4 style="color: white" v-text="text"></h4></span>
        <hr>
      </div>
      <div v-bind:style="'display:' + display">
        <ul>
          @foreach ($categories as $category)
            <li><h4><a href="{{ route('categories.show',$category->id) }}" style="color: white">{{$category->category_name}}</a></h4></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-5">
    @foreach ($products as $product)
      <div itemscope itemtype="https://schema.org/Product" class="panel-group text-center">
        <div class="panel panel-info">
          <div class="panel-heading">
            <strong itemprop="name"><h3>{{ $product->name }}
            @if ($product->isInPromo())
              <i class="glyphicon glyphicon-star"></i>
            @endif
            </h3></strong>
          </div>
          <div class="panel-body">
            @if ($product->image != null)
              <center>
                <img itemprop="image" class="img-responsive" src="{{asset('images/' . $product->image)}}" alt="Imagen para {{ $product->name }}">
              </center>
            @else
              <center>
                <img itemprop="image" class="img-responsive" src="{{asset('images/site-resources/noimage.png')}}" alt="Imagen no encontrada">
              </center>
            @endif
            <hr>
            <div itemprop="description">
              <p>{{ $product->description }}</p>
              @if ($product->isInPromo())
                <strong>Precio unitario: </strong>${{ number_format((float)$product->price, 2, ',', '') }}
                <br>
              @endif
              <strong> ID: </strong>{{ $product->id }}
              <br>
              <hr>
            </div>
            <div class="col-xs-12 col-md-offset-2 col-md-8">
              <a itemprop="url" href="{{route('products.show', $product->id)}}" class="btn btn-info btn-sm btn-block">Más información</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    <div class="col-xs-12 text-center">
      {!! $products->links() !!}
    </div>
  </div>
  {{-- Personalized page link --}}
  <div class="col-xs-12 col-md-4">
    <a href="{{ url('custom') }}"><img class="img-responsive radius-border" src="{{asset('images/site-resources/personal.png')}}" alt="Solicitar un presupuesto personalizado."></a>
    <br>
  </div>
</div>

@endsection

@section('js')
  <script src="https://unpkg.com/vue@2.1.10/dist/vue.js"></script>
  <script>
  var app = new Vue({
    el: '#panel',
    data: {
      text: "Mostrar categorías",
      isHidden: true,
      display: 'none;',
    },
    methods: {
      alternate: function () {
        this.isHidden = !this.isHidden;
        if(this.isHidden){
          this.text = 'Mostrar categorías';
          this.display = 'none;';
        }
        else {
          this.text = 'Ocultar categorías';
          this.display = 'inline;';
        }
      }
    }
  })
  </script>
@endsection
