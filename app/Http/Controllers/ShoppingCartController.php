<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\ShoppingCart;
use App\Product;
use Session;

class ShoppingCartController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $data = array();
    $data['counter'] = 0;
    $data['total'] = 0;
    $user = Auth::user();
    $items = ShoppingCart::where('user_id',$user->id)->get();
    foreach ($items as $item) {
      $product = Product::find($item->product_id);
      $data[$data['counter']] = array('product' => $product, 'quantity' => $item->quantity, 'id' => $item->id);
      $data['total'] += $product->price * $item->quantity;
      $data['counter']++;
    }
    return view('cart.index')->withData($data);
  }

  // Create route is not necesary because the store route is acceced by forms on products.show

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
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
      $cart_item->save();
    }
    Session::flash('successMessage','El producto ha sido agregado al carrito');
    return redirect()->route('products.show', $request->product_id);
  }

  // Show route is not necessary  because there is nothing to show, all is in index

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
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

  public function destroyAll()
  {
    $user_id = Auth::user()->id;
    $items = ShoppingCart::where('user_id',$user_id)->get();
    foreach ($items as $cart_item) {
      $cart_item->delete();
    }
    Session::flash('errorMessage','El carrito fue vaciado correctamente');
    return redirect()->route('cart.index') ;
  }
}
