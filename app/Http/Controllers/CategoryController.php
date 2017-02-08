<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Session;
use Auth;


class CategoryController extends Controller
{

  public function __construct()
  {
    $this->middleware(['auth','admin'], ['except' => ['show']]);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // Display a view of all of our categories
    $categories = Category::all();
    // It will also have a form to create new categories (Create function not needed)
    return view ('categories.index')->withCategories($categories);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // Validate the data
    $rules = array(
      'category_name' => 'required|max:255'
    );
    $this->validate($request, $rules);
    // Save a new category
    $category = new Category();
    $category->category_name = $request->category_name;
    $category->save();
    // Set the flash success message
    Session::flash('successMessage','La categoria ha sido creada correctamente');
    // Redirect back to index
    return redirect()->route('categories.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $category = Category::find($id);
    $products_array = array();
    foreach ($category->products as $product) {
      if (!$product->isInPromo()) {
        array_push($products_array, $product);
      }
    }
    return view('categories.show')->withCategory($category)->withProducts($products_array);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if($id != 1){
      $products = Product::where('category_id',$id)->get();
      foreach ($products as $product) {
        $product->category_id = 1;
        $product->save();
      }
      $category = Category::find($id);
      $category->delete();
      Session::flash('successMessage','La categoria ha sido eliminado correctamente');
      return redirect()->route('categories.index');
    }
    else {
      Session::flash('errorMessage','Es imposible eliminar la categoria basica');
      return redirect()->route('categories.show',$id);
    }
  }
}
