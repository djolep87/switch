<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
            })->get();
            $categories = Category::withCount('products')->get();
            $categoryName = $categories->where('name', request()->category)->first()->name;
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(16);
            // $products = Product::inRandomOrder()->take(16)->get();
            $categories = Category::withCount('products')->get();
            $categoryName = '';
        }


        return view('/home')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }
}
