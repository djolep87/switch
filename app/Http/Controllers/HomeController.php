<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('name', request()->category);
            })->paginate(48);
            $categories = Category::withCount('products')->get();
            $categoryName = $categories->where('name', request()->category)->first()->name;
        } else {
            $products = Product::join('users', 'users.id', 'products.user_id')
                ->select('users.id as user_name', 'products.*')->orderBy('created_at', 'desc')->paginate(48);
            // $products = Product::inRandomOrder()->take(16)->get();
            $categories = Category::withCount('products')->get();
            $categoryName = '';
        }
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();



        if (Auth::check()) {
            $listproducts = Product::where('user_id', auth()->user()->id)->get();
        } else {
            $listproducts = null;
        }
        return view('/home', compact('products', 'categories', 'categoryName', 'listproducts', 'wishlists'));
    }

    // public function show($id)
    // {
    //     $product = Product::find($id);
    //     return view('products.show')->with('product', $product);
    // }


    public function show(Product $product, $id)
    {

        $comments = Comment::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->where('product_user_id', $product->user_id)
            ->get();


        // $comments = Comment::where('product_user_id', $product->user_id)->get();
        // $comments = Comment::where('product_user_id',)->orderBy('created_at', 'desc')->get();

        $user = Auth::user();
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        if (Auth::check()) {
            $listproducts = Product::where('user_id', Auth::user()->id)->get();
        } else {
            $listproducts = null;
        }

        $products = Product::find($id);

        Product::find($id)->increment('views');
        $product = Product::find($id);
        $images = $product->images;
        return view('products.show', compact('product', 'products', 'images', 'listproducts', 'wishlists', 'user', 'comments'));
    }

    public function store(Request $request)
    {
    }
}
