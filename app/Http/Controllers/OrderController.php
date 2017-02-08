<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use Excel;
use Session;

class OrderController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth','admin']);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $custom_items = Order::where('type', Order::BUY_ID)->get();
    $cart_items = Order::where('type', Order::BUDGET_ID)->get();
    return view('orders.index')->withCustom_items($custom_items)->withCart_items($cart_items);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $order = Order::find($id);
    Excel::load('storage/exports/' . $order->file_name)->export('xls');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $order = Order::find($id);
    unlink(storage_path() . '/exports/' . $order->file_name);
    $order->delete();
    Session::flash('successMessage','El archivo se ha eliminado con exito');
    return redirect()->route('orders.index');
  }
}
