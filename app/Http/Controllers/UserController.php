<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();
        $user = Auth::user();
        $products = Product::where('user_id', auth()->user()->id)->get();
        return view('dashboard', compact('products', 'wishlists'));
    }

   
}
