<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        if (Auth::check()) {
            $listproducts = Product::where('user_id', auth()->user()->id)->get();
        } else {
            $listproducts = null;
        }

        // $offers = DB::table('offers')
        //     ->join('users', 'offers.user_id', '=', 'users.id')
        //     ->join('products', 'offers.product_id', '=', 'products.id')
        //     ->select('offers.*', 'users.firstname as user_firstname', 'products.name as product_name')
        //     ->where('acceptor', auth()->user()->id)
        // ->get();
        // Product::find($id)->increment('views');
        $products = Offer::with(['user', 'product', 'acceptor', 'sendproduct'])
                ->where('acceptor', auth()->user()->id) 
                ->get();


        return view('offers.index', compact('products', 'listproducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $offers = new Offer;
        $offers->user_id = Auth()->user()->id;
        $offers->sendproduct_id = $request->input('sendproduct_id');
        $offers->product_id = $request->input('product_id');
        $offers->acceptor = $request->input('acceptor');
        $offers->accepted = 0;
        // dd($offers);
        $offers->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
