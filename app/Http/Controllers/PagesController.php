<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;
use App\Category;
use Session;
use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function getIndex(){
    return view('pages.index');
  }

  public function getCarrito(){
    // Write a controller for this
    return view('pages.carrito');
  }

  public function getSearch(){
    $tags = Tag::orderBy('name','asc')->paginate(10);;
    $categories = Category::orderBy('category_name','asc')->get();
    return view('pages.search.form')->withTags($tags)->withCategories($categories);
  }

  public function postSearch(){
    $request = request()->only('tag');
    if($request['tag'] != null){
      $tag_request = $request['tag'];
      $tag = Tag::where('name',$tag_request)->first();
      if($tag != null && count($tag->products) > 0){
        // Return the view with the tag because its no posible to pass $tag->products without iterating over it
        return view('pages.search.result')->withTag($tag);
      }
      else {
        Session::flash('errorMessage','No se han encontrado coincidencias con las palabras ingresadas');
        return redirect()->to('search');
      }
    }
    Session::flash('errorMessage','No se han encontrado coincidencias con las palabras ingresadas');
    return redirect()->to('search');
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

  public function getCustom(){
    return view('pages.custom');
  }

  public function postCustom(){
    $ret = "";
    $request = request()->all();
    $count =  $request['counter'];
    for ($i=0; $i <= $count; $i++) {
      if(isset($request['text'.$i]) && $request['text'.$i] != null){
        $ret .= 'Item: ' . $request['text'.$i];
        $ret .= ' Cantidad: ' . $request['number'.$i];
      }
    }
    return $ret;
  }
}
