<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['except' => ['getIndex','getSearch']]);
  }

  public function getIndex(){

    $lastProducts = Product::orderBy('id', 'desc')->take(6)->get();

    $data = array(
      'lastProducts' => $lastProducts
    );

    return view('pages.index')->withData($data);
  }

  public function getCarrito(){
    return view('pages.carrito');
  }

  public function getSearch(){
    return 'Search';
  }
}
