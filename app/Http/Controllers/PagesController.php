<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;
use App\Category;
use Session;
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
    $tags = Tag::orderBy('name','asc')->paginate(10);;
    $categories = Category::orderBy('category_name','asc')->get();
    return view('pages.search.form')->withTags($tags)->withCategories($categories);
  }

  public function postSearch(){
    $request = request()->only('tag');
    if($request['tag'] != null){
      $tag_request = $request['tag'];
      $tag = Tag::where('name',$tag_request)->first();
      if($tag != null){
        // Return the view with the tag because its no posible to pass $tag->products without iterating over it
        return view('pages.search.result')->withTag($tag);
      }
    }
    Session::flash('errorMessage','No se han encontrado coincidencias con las palabras ingresadas');
    return redirect()->to('search');
  }

  public function getContact()  {
    return view('pages.contact');
  }
}
