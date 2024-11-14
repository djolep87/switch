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
    $user = Auth::user();

    if ($user) {
        // Proveri da li je proizvod već u wishlistu
        $wishlist = Wishlist::where('user_id', $user->id)
                            ->where('product_id', $product_id)
                            ->first();

        if ($wishlist) {
            // Ako je proizvod već u wishlistu, ukloni ga
            $wishlist->delete();
            return response()->json([
                'status' => 'removed',
                'toast_message' => 'Oglas je uklonjen iz liste želja!'
            ]);
        } else {
            // Ako nije, dodaj ga u wishlist
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product_id,
            ]);
            return response()->json([
                'status' => 'added',
                'toast_message' => 'Oglas je dodat u listu želja!'
            ]);
        }
    }

    return response()->json(['status' => 'error', 'message' => 'User not authenticated'], 401);
}

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        toast('Ne pratite više ovaj oglas!', 'warning');
        return back();
    }
}
