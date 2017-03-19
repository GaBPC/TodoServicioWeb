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

// Products routes
Route::resource('products', 'ProductController');
Route::get('promo', 'ProductController@promo');
// Categories routes
Route::resource('categories', 'CategoryController',['except' => ['create','edit','update']]);
// Tags routes
Route::resource('tags', 'TagController',['except' => ['create','edit','update']]);

//
Route::resource('buy', 'BuysController', ['except' => ['create','show', 'edit', 'update']]);
Route::get('buy/send', 'BuysController@send')->name('buy.send');

//
Route::resource('budget', 'BudgetsController', ['except' => ['create','show', 'edit', 'update']]);
Route::get('budget/send', 'BudgetsController@send')->name('budget.send');
Route::post('budget/manual', 'BudgetsController@manual')->name('budget.manual');

// Authentication routes
Auth::routes();
Route::get('/home', 'PagesController@home');
// Maling list routes
Route::post('mailing', 'MailingContactController@saveContact');
// Orders routes
Route::resource('orders','OrderController', ['except' => ['create', 'store', 'edit', 'update']]);
