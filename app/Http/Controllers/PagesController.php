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
    $this->middleware('auth', ['only' => ['postCustom','getCustom']]);
  }

  public function getIndex(){
    return view('pages.index');
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

  public function postCustom(){
    $file_name = 'p' . time();
    // Maatwebsite excel
    Excel::create($file_name, function($excel) {
      // Sets the sheet name
      $excel->sheet('Pedido de compra', function($sheet) {
        // User who is buying
        $user = Auth::user();
        // Adds the user's data
        $sheet->appendRow(["Usuario:", $user->name]);
        $sheet->appendRow(["E-mail:", $user->email]);
        // Adds an empty row
        $sheet->appendRow([""]);
        // Adds the titles
        $sheet->appendRow(["Código","Producto","Cantidad","U. Medida","Precio","% Bonif.","Imp. Bonif","Subtotal"]);
        // Requests the data from the form
        $request = request()->all();
        // Saves the data to an array
        for ($i=0; $i <= $request['counter']; $i++) {
          // If the item $i is set
          if(isset($request['description'.$i]) && $request['quantity'.$i] != null){
            // Computes the data
            $cod = "";
            $name = $request['description'.$i];
            $quantity = $request['quantity'.$i];
            $um = "";
            $price = "";
            $bonif = "";
            $impbonif = "";
            $subtotal = "";
            // Appends the row with the data
            $sheet->appendRow([$cod,$name,$quantity, $um, $price,$bonif, $impbonif , $subtotal]);
          }
        }
          // Set auto size for sheet
          $sheet->setAutoSize(true);
          // Set the alignment to the first 1000 rows
          $sheet->cells('A1:H1000', function($cells) {
            $cells->setAlignment('center');
            $cells->setValignment('center');
          });
      });
      // Stores the xls to the server
    })->store('xls');
    // Stores the xls data in the database
    $order = new Order();
    $order->user_email = Auth::user()->email;
    $order->file_name = $file_name . '.xls';
    $order->type = Order::CUSTOM_ID;
    $order->save();
    // Sets the success flash message
    Session::flash('successMessage','El pedido se ha realizado con exito');
    // Redirects to the custom page
    return redirect()->to('custom');
  }
}
