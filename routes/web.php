<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/home', 'HomeController');
// Route::get('/products.show/{product}', 'HomeController@show')->name('products.show');
Route::get('/products.view/{id}', 'HomeController@view')->name('products.view');
// Route::get('/products.show/{product}', 'ProductsController@show');
// Route::get('/products', 'HomeController@show');

Auth::routes();

Route::get('/products.create', 'ProductsController@create');
Route::post('/products.store', 'ProductsController@store');
