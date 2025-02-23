<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function uslovi()
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        return view('uslovi', compact('wishlists'));
    }

    public function about()
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        return view('about', compact('wishlists'));
    }

    public function contact()
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        return view('contact', compact('wishlists'));
    }

    public function kakoradi()
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        return view('pages.kakoradi', compact('wishlists'));
    }

    public function postavioglas()
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        return view('pages.postavioglas', compact('wishlists'));
    }

    public function razmena()
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        return view('pages.razmena', compact('wishlists'));
    }
}
