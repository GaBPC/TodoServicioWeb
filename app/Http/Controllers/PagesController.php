<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;
use App\Category;
use Session;
use Illuminate\Http\Request;
// use Excel;
use Auth;

class PagesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth', ['only' => ['postCustom']]);
  }

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
        Session::flash('errorMessage','No se han encontrado coincidencias con las palabras ingresadas, pero no dude en solicitar un presupuesto en nuestra sección de pedidos personalizados.');
        return redirect()->to('search');
      }
    }
    Session::flash('errorMessage','No se han encontrado coincidencias con las palabras ingresadas, pero no dude en solicitar un presupuesto en nuestra sección de pedidos personalizados.');
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

  // public function postCustom(){
  //   // Requests the data from the form
  //   $request = request()->all();
  //   // Gets the count of items
  //   $count =  $request['counter'];
  //   // Array to save the data
  //   $data = array();
  //   // Saves the data to an array
  //   for ($i=0; $i <= $count; $i++) {
  //     // If the item $i is set
  //     if(isset($request['description'.$i]) && $request['quantity'.$i] != null){
  //       $data[$i] = array($request['description'.$i], $request['quantity'.$i]);
  //     }
  //   }
  //   // Saves the user's data
  //   $data[$count + 1] = array(Auth::user()->name, Auth::user()->email);
  //   // Maatwebsite excel
  //   Excel::create(Auth::user()->email . time(), function($excel) use($data) {
  //     // Sets the sheet name and puts the content
  //     $excel->sheet('Hoja 1', function($sheet) use($data) {
  //       // Sets the font
  //       $sheet->setFontFamily('Arial');
  //       // Centers the cells
  //       $sheet->cells('A1:B1000', function($cells) {
  //         $cells->setAlignment('center');
  //       });
  //       // Sets the title row
  //       $sheet->cell('A1', function($cell) {
  //         $cell->setValue('Descripción');
  //       });
  //       $sheet->cell('B1', function($cell) {
  //         $cell->setValue('Cantidad');
  //       });
  //       // Saves the data to the sheet
  //       $sheet->fromArray($data);
  //     });
  //   })->store('xls'); // Stores the xls to the server
  //   // Sends the xls to the admin's email
  //   // TODO
  //   // Sets the success flash message
  //   Session::flash('successMessage','El pedido se ha realizado con exito');
  //   // Redirects to the custom page
  //   return redirect()->to('custom');
  // }
}
