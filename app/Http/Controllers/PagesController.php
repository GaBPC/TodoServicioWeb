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
