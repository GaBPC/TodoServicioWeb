<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Index route
Route::get('/', 'PagesController@getIndex');
// Ruta para ver el carrito de compras
Route::get('carrito', 'PagesController@getCarrito');
// Search route
Route::get('search', 'PagesController@getSearch');
// Products routes
Route::resource('products', 'ProductController');
// Categories routes
Route::resource('categories', 'CategoryController',['except' => ['create']]);
// Tags routes
Route::resource('tags', 'TagController',['except' => ['create']]);
// Authentication routes
Auth::routes();
Route::get('/home', 'HomeController@index');
