<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;
use App\Tag;
use Auth;
use Image;

use Storage;

use Session;

class ProductController extends Controller
{

  public function __construct()
  {
    $this->middleware(['auth','admin'], ['except' => ['index','show']]);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // Create a variable and store all the products in it from the Database
    $products = Product::orderBy('id','desc')->paginate(5);
    // Create a variable and store all the categories in it from the Database
    $categories = Category::all();
    // Return a view and pass in the above variable
    return view('products.index')->withProducts($products)->withCategories($categories);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $categories = Category::all();
    $tags = Tag::all();
    return view('products.create')->withCategories($categories)->withTags($tags);
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
      'name' => 'required|max:255',
      'price' => 'required|numeric|min:0|max:99999999',
      'category_id' => 'required|integer',
      'feature_image' => 'sometimes|image'
    );
    $this->validate($request, $rules);
    // Store in the Database
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->category_id = $request->category_id;
    // Save the image
    if ($request->hasFile('feature_image')) {
      $image = $request->file('feature_image');
      $filename = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/' . $filename);
      Image::make($image)->save($location); //->resize(800, 400)
      $product->image = $filename;
    }
    $product->save();
    if (isset($request->tags)) {
      $product->tags()->sync($request->tags);
    }
    else {
      $product->tags()->sync(array());
    }
    // Sets de flash success message
    Session::flash('successMessage','El producto ha sido agregado correctamente');
    // Redirect to next page
    return redirect()->route('products.show',$product->id);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    // Finde the product in the database and saves as a variable
    $product = Product::find($id);
    // Return the view an pass in the variable
    return view('products.show')->withProduct($product);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $categories = Category::all();
    $listCategories = array();
    foreach ($categories as $category){
      $listCategories[$category->id] = $category->category_name;
    }
    $tags = Tag::all();
    $listTags = array();
    foreach ($tags as $tag){
      $listTags[$tag->id] = $tag->name;
    }
    // Find the product in the database and saves as a variable
    $product = Product::find($id);
    $jsontags = json_encode($product->tags->pluck('id'));
    // Return the view an pass in the variable
    return view('products.edit')->withProduct($product)->withCategories($listCategories)
    ->withTags($listTags)->withJsontags($jsontags);
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
    // Validate the Database
    $rules = array(
      'name' => 'required|max:255',
      'price' => 'required|numeric|min:0|max:99999999',
      'category_id' => 'required|integer',
      'feature_image' => 'sometimes|image'
    );
    $this->validate($request, $rules);
    // Save the data to the Database
    $product = Product::find($id);
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->category_id = $request->input('category_id');
    if ($request->hasFile('feature_image')){
      // Save the new imagen
      $image = $request->file('feature_image');
      $filename = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/' . $filename);
      Image::make($image)->save($location); //->resize(800, 400)
      $oldFilename = $product->image;
      // Update the database
      $product->image = $filename;
      // Delete the old image
      Storage::delete($oldFilename);
    }
    $product->save();
    if (isset($request->tags)) {
      $product->tags()->sync($request->tags);
    }
    else {
      $product->tags()->sync(array());
    }
    // Set the flash success message
    Session::flash('successMessage','El producto ha sido modificado correctamente');
    // Redirect with flash success message
    return redirect()->route('products.show', $product->id);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    // Find the product in the database and saves as a variable
    $product = Product::find($id);
    // Delete all the relations with the tags
    $product->tags()->detach();
    // Delete the image from the storage
    if($product->image != null){
      Storage::delete($product->image);
    }
    // Delete the product
    $product->delete();
    // Sets the success message
    Session::flash('successMessage','El producto ha sido eliminado correctamente');
    // Return a view with success message
    return redirect()->route('products.index');
  }
}
