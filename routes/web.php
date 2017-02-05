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

//Cookies route
Route::get('cookies', 'PagesController@getCookies');
// Index route
Route::get('/', 'PagesController@getIndex');
// Denied access route
Route::get('denied', 'PagesController@getDenied');
// Search routes
Route::post('search', 'PagesController@postSearch');
// Contact route
Route::get('contact', 'PagesController@getContact');
// Location route
Route::get('location', 'PagesController@getLocation');
// Custom routes
Route::get('custom', 'PagesController@getCustom');
Route::post('custom', 'PagesController@postCustom');
// Products routes
Route::resource('products', 'ProductController');
// Categories routes
Route::resource('categories', 'CategoryController',['except' => ['create']]);
// Tags routes
Route::resource('tags', 'TagController',['except' => ['create']]);
// ShopingCart routes
Route::resource('cart', 'ShoppingCartController', ['except' => ['create','show']]);
Route::get('cart/destroyAll','ShoppingCartController@destroyAll');
Route::get('cart/submit','ShoppingCartController@submit');

// Authentication routes
Auth::routes();
Route::get('/home', 'HomeController@index');
// Maling list routes
Route::post('mailing', 'MailingContactController@saveContact');
// Orders routes
Route::resource('orders','OrderController');
