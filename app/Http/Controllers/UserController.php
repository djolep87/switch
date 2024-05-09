<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\Validation\Rule;
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

    public function edit()
    {
        $user = Auth::user();
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();
        $products = Product::where('user_id', auth()->user()->id)->get();
        return view('/auth.edit', compact('wishlists'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id() . ',id'],
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ], [
            'email.unique' => 'Email adresa već postoji u našem sistemu. Molimo vas odaberite drugu email adresu.',
        ]);

        $user = Auth::user();

        if ($user) {
            $user->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ]);

            toast('Uspešno ste izmenili podatke!', 'success');

            return redirect('/dashboard');
        }

    
    }
}
