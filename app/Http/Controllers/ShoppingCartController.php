<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\ShoppingCart;
use App\Product;
use App\Order;
use Session;
use Excel;

class ShoppingCartController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getBuys()
  {
    $buys = array();
    $buys['counter'] = 0;
    $buys['total'] = 0;

    $user = Auth::user();
    $items = ShoppingCart::where('user_id',$user->id)->where('type', ShoppingCart::BUY)->get();
    foreach ($items as $item) {
      $product = Product::find($item->product_id);
      $buys[$buys['counter']] = array('id' => $item->id , 'product' => $product , 'quantity' => $item->quantity);
      $buys['total'] += $product->price * $item->quantity;
      $buys['counter']++;
    }
    return view('cart.buys')->withBuys($buys);
  }

  public function getBudget()
  {
    $budgets = array();
    $budgets['counter'] = 0;
    $budgets['total'] = 0;

    $user = Auth::user();
    $items = ShoppingCart::where('user_id',$user->id)->where('type', ShoppingCart::BUDGET)->get();
    foreach ($items as $item) {
      $product = Product::find($item->product_id);
      $budgets[$budgets['counter']] = array('id' => $item->id , 'product' => $product , 'quantity' => $item->quantity);
      $budgets['total'] += $product->price * $item->quantity;
      $budgets['counter']++;
    }
    return view('cart.budget')->withBudgets($budgets);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    if($request->quantity != null){
      $user_id = Auth::user()->id;
      $items_cart = ShoppingCart::where('user_id', $user_id)->where('product_id', $request->product_id)->get();
      if(count($items_cart) > 0){
        $items_cart[0]->quantity = $items_cart[0]->quantity + $request->quantity;
        $items_cart[0]->save();
      }
      else {
        $cart_item = new ShoppingCart();
        $cart_item->user_id = $user_id;
        $cart_item->product_id = $request->product_id;
        $cart_item->quantity = $request->quantity;

        $product = Product::find($request->product_id);
        $cart_item->type = ($product->isInPromo()) ? ShoppingCart::BUY : ShoppingCart::BUDGET;

        $cart_item->save();
      }
      Session::flash('successMessage','El producto ha sido agregado al carrito');
    }
    else {
      Session::flash('errorMessage','No ha seleccionado una cantidad');
    }
    return redirect()->route('products.show', $request->product_id);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $cart_item = ShoppingCart::find($id);
    $cart_item->delete();
    Session::flash('errorMessage','El producto ha sido borrado del carrito');
    return redirect()->route('cart.index') ;
  }

  // public function destroyAll()
  // {
  //   $user_id = Auth::user()->id;
  //   $items = ShoppingCart::where('user_id',$user_id)->get();
  //   foreach ($items as $cart_item) {
  //     $cart_item->delete();
  //   }
  //   Session::flash('errorMessage','El carrito fue vaciado correctamente');
  //   return redirect()->route('cart.index') ;
  // }

  public function submit($type)
  {
    // Maatwebsite excel
    $file_name = $type . time();
    Excel::create($file_name, function($excel) use($type) {
      // Sets the sheet name
      $excel->sheet('Pedido de compra', function($sheet) use($type) {
        // User who is buying
        $user = Auth::user();
        // Adds the user's data
        $sheet->appendRow(["Usuario:", $user->name]);
        $sheet->appendRow(["E-mail:", $user->email]);
        // Adds an empty row
        $sheet->appendRow([""]);
        // Adds the titles
        $sheet->appendRow(["Código","Producto","Cantidad","U. Medida","Precio","% Bonif.","Imp. Bonif","Subtotal"]);
        // Gets all the user's items where the transaction type is $type
        $items = ShoppingCart::where('user_id',$user->id)->where('type',$type)->get();
        // Adds the data of all items
        foreach ($items as $item) {
          // Gets the item's data
          $product = Product::find($item->product_id);
          // Computes the data
          $cod = "";
          $name = $product->name;
          $quantity = $item->quantity;
          $um = $product->units;
          $price = $product->price;
          $bonif = "";
          $impbonif = "";
          $subtotal = $price * $quantity;
          // Appends the row with the data
          $sheet->appendRow([$cod,$name,$quantity, $um, $price,$bonif, $impbonif , $subtotal]);
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
    $order->type = Order::CART_ID;
    $order->save();
    // Sets the success flash message
    Session::flash('successMessage','El pedido se ha realizado con exito');
    // Redirects to the custom page
    $url = "";

    if($type == ShoppingCart::BUY){
      $url = ShoppingCart::BUY_URL;
    }
    else {
      $url = ShoppingCart::BUDGET_URL;
    }
    return redirect()->to($url);
  }
}
