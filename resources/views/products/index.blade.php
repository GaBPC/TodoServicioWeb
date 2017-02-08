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
    <div class="col-xs-12 col-md-4">
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

    <div class="col-xs-12 col-md-8">
      <div class="row">
        @foreach ($products as $product)
          <div itemscope itemtype="https://schema.org/Product" class="col-xs-12 col-md-6 panel-group text-center">
            <div class="panel panel-info">
              <div class="panel-heading">
                <strong itemprop="name">
                  <h3>{{ $product->name }}</h3>
                </strong>
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
                  <b>Venta por:</b> {{ $product->units }}
                  <p>{{ $product->description }}</p>
                @foreach ($product->tags as $tag)
                  <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
                @endforeach
                <hr>
              </div>
              <div class="col-xs-12 col-md-offset-2 col-md-8">
                <a itemprop="url" href="{{route('products.show', $product->id)}}" class="btn btn-info btn-sm btn-block">Más información</a>
              </div>
            </div>
          </div>
        </div>
        @if (($loop->index + 1) % 2 == 0)
        </div>
        <div class="row">
        @endif
      @endforeach
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <center>
      {!! $products->links() !!}
    </center>
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
