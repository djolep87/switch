<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();

        return view('wishlist.index', compact('wishlists'));
        
    }

    public function countWishlistItems()
    {
        $user = Auth::user();

        if (!$user) {
            return 0;
        }

        $wishlist = Wishlist::where('user_id', $user->id)->first();

        if (!$wishlist) {
            return 0;
        }

        return $wishlist->items->count();
    }

    public function addToWishlist($product_id)
    {
        if (Auth::check()) {
            Wishlist::insert([
                'user_id' => Auth()->user()->id,
                'product_id' => $product_id,


            ]);
            return back()->with('success', 'Zapratili ste oglas!');
        } else {
            return redirect('/login');
        }
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return back();
    }
}
