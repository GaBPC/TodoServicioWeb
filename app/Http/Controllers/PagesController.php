<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['except' => ['getIndex','getSearch','getContact']]);
  }

  public function getIndex(){
    return view('pages.index');
  }

  public function getCarrito(){
    return view('pages.carrito');
  }

  public function getSearch(){
    return 'Search';
  }

  public function getContact()
  {
    return view('pages.contact');
  }
}
