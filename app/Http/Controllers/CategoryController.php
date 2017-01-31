<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use Session;

class CategoryController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth', ['except' => ['index','show']]);
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
    return view('categories.show')->withCategory($category);
  }

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
    //
  }
}
