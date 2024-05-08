<?php

use App\Http\Controllers\OffersController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\UserController;

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
Route::get('/uslovi', 'PageController@uslovi');  
Route::get('/about', 'PageController@about');  
Route::get('/contact', 'PageController@contact');  

Route::get('/dashboard', 'UserController@index');

Route::get('/offers', 'OffersController@index');
Route::post('/', 'OffersController@store')->name('offers.store');
Route::post('/offers.update/{offer}', 'OffersController@update')->name('offers.update');
Route::post('/offers.rejected/{offer}', 'OffersController@rejected')->name('offers.rejected');
Route::post('/offers.confirmation/{offer}', 'OffersController@confirmation')->name('offers.confirmation');
Route::post('/offers.confirmation_sendoffer/{offer}', 'OffersController@confirmation_sendoffer')->name('offers.confirmation_sendoffer');
Route::post('/offers.canceled/{offer}', 'OffersController@canceled')->name('offers.canceled');
Route::post('/offers.canceled_sendoffer/{offer}', 'OffersController@canceled_sendoffer')->name('offers.canceled_sendoffer');
Route::delete('offers.destroy/{id}', 'OffersController@destroy')->name('offers.destroy');

Route::post('/offers.offer_archived/{offer}', 'OffersController@offer_archived')->name('offers.offer_archived');
Route::post('/offers.sendoffer_archived/{offer}', 'OffersController@sendoffer_archived')->name('offers.sendoffer_archived');

// Route::get('markAsRead/', 'OffersController@markAsRead')->name('markAsRead');
Route::get('markAsRead/{notificationId}', 'OffersController@markAsRead')->name('markAsRead');

Route::get('search', 'HomeController@search');

Route::post('like', 'LikeController@like')->name('like');
Route::post('dislike', 'LikeController@dislike')->name('dislike');

Auth::routes();

Route::get('/auth.edit/{id}', 'UserController@edit');
Route::post('/auth/{id}', 'UserController@update')->name('user.update');

Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog.show', 'BlogController@show')->name('blog.show');

Route::get('/products.create', 'ProductsController@create');
Route::post('/products.store', 'ProductsController@store');
Route::get('/products.show/{id}', 'HomeController@show')->name('products.show');  
Route::get('/products.edit/{id}', 'ProductsController@edit');
Route::put('/products.store/{product}', 'ProductsController@update');
Route::delete('/products.destroy/{id}', 'ProductsController@destroy')->name('product.destroy');

Route::post('/comments.store/{id}', 'CommentsController@store')->name('comments.store');

Route::get('add/to-wishlist/{product_id}', 'WishlistController@addToWishlist');
Route::get('/wishlist', 'WishlistController@index');
Route::delete('wishlist.destroy/{id}', 'WishlistController@destroy')->name('wishlist.destroy');


