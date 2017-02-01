<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['except' => 'index']);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $tags = Tag::all();

    return view ('tags.index')->withTags($tags);
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
      'name' => 'required|max:255'
    );
    $this->validate($request, $rules);
    // Save a new category
    $tag = new Tag();
    $tag->name = $request->name;
    $tag->save();
    // Set the flash success message
    Session::flash('successMessage','El tag ha sido creada correctamente');
    // Redirect back to index
    return redirect()->route('tags.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $tag = Tag::find($id);
    return view('tags.show')->withTag($tag);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $tag = Tag::find($id);
    $tag->products()->detach();
    $tag->delete();
    Session::flash('successMessage','El tag ha sido eliminado correctamente');
    return redirect()->route('tags.index');
  }
}
