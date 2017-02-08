<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Budget;
use \App\Product;
use \App\Order;
use Auth;
use Session;
use Excel;

class BudgetsController extends Controller
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
    $budgets = array();
    $budgets['counter'] = 0;

    $manual_budgets = array();
    $manual_budgets['counter'] = 0;

    $user = Auth::user();
    $items = Budget::where('user_id',$user->id)->get();
    foreach ($items as $item) {
      if (is_null($item->product_id)) {
        $manual_budgets[$manual_budgets['counter']] = array('id' => $item->id , 'description' => $item->description , 'quantity' => $item->quantity);
        $manual_budgets['counter']++;
      }
      else {
        $product = Product::find($item->product_id);
        $budgets[$budgets['counter']] = array('id' => $item->id , 'product' => $product , 'quantity' => $item->quantity);
        $budgets['counter']++;
      }

    }
    return view('transaction.budget')->withBudgets($budgets)->withManual_budgets($manual_budgets);
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
      $items_cart = Budget::where('user_id', $user_id)->where('product_id', $request->product_id)->get();
      if(count($items_cart) > 0){
        $items_cart[0]->quantity = $items_cart[0]->quantity + $request->quantity;
        $items_cart[0]->save();
      }
      else {
        $item = new Budget();
        $item->user_id = $user_id;
        $item->product_id = $request->product_id;
        $item->quantity = $request->quantity;
        $item->description = null;
        $item->save();
      }
      Session::flash('successMessage','El producto ha sido agregado al carrito');
    }
    else {
      Session::flash('errorMessage','No ha seleccionado una cantidad');
    }
    return redirect()->route('products.show', $request->product_id);
  }

  public function manual()
  {
    $request = request()->all();

    $description = $request['description'];
    $quantity = $request['quantity'];

    $budget = new Budget();

    $budget->user_id = Auth::user()->id;
    $budget->product_id = null;
    $budget->quantity = $quantity;
    $budget->description = $description;

    $budget->save();

    return redirect()->route('budget.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $item = Budget::find($id);
    $item->delete();
    Session::flash('errorMessage','El producto ha sido borrado del carrito');
    return redirect()->route('budget.index') ;
  }

  public function send()
  {
    // Maatwebsite excel
    $file_name = 'presupuesto' . time();
    Excel::create($file_name, function($excel){
      // Sets the sheet name
      $excel->sheet('Pedido de presupuesto', function($sheet){
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
        $items = Budget::where('user_id',$user->id)->get();
        // Adds the data of all items
        foreach ($items as $item) {
          // Gets the item's data
          $product = Product::find($item->product_id);
          // Computes the data
          $cod = "";
          $name = (is_null($product->name)) ? $product->description : $product->name;
          $quantity = $item->quantity;
          $um = $product->units;
          $price = "";
          $bonif = "";
          $impbonif = "";
          $subtotal = "";
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
    $order->type = Order::BUDGET_ID;
    $order->save();
    // Sets the success flash message
    Session::flash('successMessage','Su presupuesto ha sido recibido y pronto recibira su respuesta vía mail.');
    // Redirects to the custom page
    return redirect()->route('budget.index');
  }
}
