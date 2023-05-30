<?php

use App\Http\Controllers\OffersController;
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
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/products.show/{id}', 'HomeController@show')->name('products.show');    

Route::get('/dashboard', 'UserController@index');
Route::get('/offers', 'OffersController@index');
Route::post('/offers/{offer}', 'OffersController@update');

Route::get('search', 'HomeController@search');

Route::post('like', 'LikeController@like')->name('like');
Route::post('dislike', 'LikeController@dislike')->name('dislike');

Auth::routes();

Route::get('/products.create', 'ProductsController@create');
Route::post('/products.store', 'ProductsController@store');
Route::get('/products.edit/{id}', 'ProductsController@edit');
Route::put('/products.store/{product}', 'ProductsController@update');

Route::post('comments.store', 'CommentsController@store')->name('comments.store');

Route::get('add/to-wishlist/{product_id}', 'WishlistController@addToWishlist');
Route::get('/wishlist', 'WishlistController@index');
Route::delete('wishlist.destroy/{id}', 'WishlistController@destroy')->name('wishlist.destroy');

Route::post('/', 'OffersController@store')->name('offers.store');

