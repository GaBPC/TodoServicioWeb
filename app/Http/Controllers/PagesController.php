<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;
use App\Category;
use App\Order;
use Session;
use Illuminate\Http\Request;
use Excel;
use Auth;

class PagesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['only' => ['home', 'postCustom','getCustom']]);
  }

  public function home(){
    return view('home');
  }

  public function getCookies()
  {
    return view('pages.cookies');
  }

  public function getIndex(){
    $dir = public_path('images/site-resources/carousel');
    $files = scandir($dir);
    for ($i=0; $i < count($files); $i++) {
      if(strpos($files[$i], "carousel") === false){
        unset($files[$i]);
      }
    }

    $names = array();
    $i = 0;

    foreach ($files as $file) {
      $names[$i] = $file;
      $i++;
    }

    return view('pages.index')->withImages_names($names);
  }

  public function postSearch(){
    $data = array();
    $request = request()->only('tag');
    if($request['tag'] != null){
      $words = explode(" ", $request['tag']);
      foreach ($words as $word) {
        $word = strtoupper($word);
        $tags = Tag::where('name','like', '%' . $word .'%')->get();
        foreach ($tags as $tag) {
          $products = $tag->products;
          foreach ($products as $product) {
            if (!$product->isInPromo()) {
              if(!isset($data[$product->id])){ $data[$product->id] = $product; }
            }
          }
        }
        $tags = Category::where('category_name','like', '%' . $word .'%')->get();
        foreach ($tags as $tag) {
          $products = $tag->products;
          foreach ($products as $product) {
            if (!$product->isInPromo()) {
              if(!isset($data[$product->id])){ $data[$product->id] = $product; }
            }
          }
        }
        $products = Product::where('promo', false)->where('name','like','%' . $word . '%')->get();
        foreach ($products as $product) {
          if(!isset($data[$product->id])){ $data[$product->id] = $product; }
        }
      }
      if(count($data) <= 0){
        Session::flash('errorMessage','Lamentablemente no se han encontrado coincidencias con las palabras ingresadas. Le recomendamos ingresar las palabras en singular.');
      }
    }
    else {
      Session::flash('errorMessage','Lamentablemente no se han encontrado coincidencias con las palabras ingresadas. Le recomendamos ingresar las palabras en singular.');
    }
    return view('pages.search.result')->withProducts($data);
  }

  public function getContact()  {
    return view('pages.contact');
  }

  public function getLocation()  {
    return view('pages.location');
  }

  public function getDenied(){
    return view('denied');
  }
}
