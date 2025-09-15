<?php

use App\Http\Controllers\OffersController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\MessagingController;

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
Route::get('/kakoradi', 'PageController@kakoradi'); 
Route::get('/postavioglas', 'PageController@postavioglas');
Route::get('/razmena', 'PageController@razmena');

Route::get('/dashboard', 'UserController@index');

Route::get('/offers', 'OffersController@index');
Route::get('/sendOffers', 'SendOffersController@index');
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

// Messaging System Routes
Route::get('/messages', 'MessagingController@index')->name('messages.index');
Route::get('/messages/{id}', 'MessagingController@show')->name('messages.show');
Route::post('/messages', 'MessagingController@store')->name('messages.store');
Route::post('/messages/{id}/read', 'MessagingController@markAsRead')->name('messages.read');
Route::delete('/messages/{id}', 'MessagingController@destroy')->name('messages.destroy');
Route::delete('/messages/delete-conversation/{otherUserId}', 'MessagingController@deleteConversation')->name('messages.delete-conversation');
Route::get('/api/messages', 'MessagingController@getMessages')->name('messages.api');

// Route::get('markAsRead/', 'OffersController@markAsRead')->name('markAsRead');
// Route::get('markAsRead/{notificationId}', 'OffersController@markAsRead')->name('markAsRead');
Route::get('/notifications/mark-as-read/{notificationId}', function ($notificationId) {
    $user = auth()->user();
    $notification = $user->notifications()->find($notificationId);

    if ($notification) {
        // Obeleži kao pročitano
        $notification->markAsRead();

        // Vrati korisnika na odgovarajući URL iz notifikacije
        return redirect($notification->data['url'] ?? '/offers');
    }

    return redirect('/offers'); // Ako notifikacija ne postoji, preusmeri na default stranicu
})->name('markAsRead');

Route::get('search', 'HomeController@search');

Route::post('like', 'LikeController@like')->name('like');
Route::post('dislike', 'LikeController@dislike')->name('dislike');

Auth::routes();

Route::get('/auth.edit/{id}', 'UserController@edit');
Route::post('/auth/{id}', 'UserController@update')->name('user.update');

Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/{id}', 'BlogController@show')->name('blog.show');

Route::get('/products.create', 'ProductsController@create');
Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products.show/{id}', 'HomeController@show')->name('products.show');  
Route::get('/products/{id}/edit', 'ProductsController@edit')->name('products.edit');
Route::put('/products/{product}', 'ProductsController@update')->name('products.update');
Route::delete('/products/{id}', 'ProductsController@destroy')->name('product.destroy');

Route::post('/comments.store/{id}', 'CommentsController@store')->name('comments.store');

Route::get('add/to-wishlist/{product_id}', 'WishlistController@addToWishlist')->name('wishlist.add');
Route::get('/wishlist', 'WishlistController@index');
Route::delete('wishlist.destroy/{id}', 'WishlistController@destroy')->name('wishlist.destroy');



// Admin panel rute sa auth + isAdmin middleware
// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::get('/blog/create', [AdminController::class, 'create'])->name('admin.create');
//     // Dodaj još admin ruta po potrebi...
// });

    // Route::get('/admin/dashboard', 'AdminController@index')->name('admin/dashboard');
    // Route::get('/admin/blog/create', 'AdminController@create')->name('admin/blog/create');


    // web.php
// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('admin/dashboard');
//     Route::get('/posts', [PostsController::class, 'index'])->name('admin/posts');
//     Route::get('/posts/create', [PostsController::class, 'create'])->name('admin/posts/create');
//     Route::post('/posts/store', [PostsController::class, 'store'])->name('admin/posts/store');
//     // Route::get('/posts/{id}/edit', [PostsController::class, 'edit'])->name('admin/posts/edit');
//     Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('admin.posts.edit');

//     Route::put('/posts/{post}', [PostsController::class, 'update'])->name('admin.posts.update');
//     // Route::put('/posts/{post}', [PostsController::class, 'update'])->name('admin.posts.update');
//     Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('admin/posts/destroy');
//     Route::get('/users', [AdminController::class, 'users'])->name('admin/users');
//     Route::get('/products', [AdminController::class, 'products'])->name('admin/products');
// });

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
});
