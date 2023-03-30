<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OffersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // if (request()->category) {
        //     $products = Product::with('categories')->whereHas('categories', function ($query) {
        //         $query->where('name', request()->category);
        //     })->paginate(48);
        //     $categories = Category::withCount('products')->get();
        //     $categoryName = $categories->where('name', request()->category)->first()->name;
        // } else {
        //     $products = Product::join('users', 'users.id', 'products.user_id')
        //         ->select('users.id as user_name', 'products.*')->orderBy('created_at', 'desc')->paginate(48);
        //     // $products = Product::inRandomOrder()->take(16)->get();
        //     $categories = Category::withCount('products')->get();
        //     $categoryName = '';
        // }

       

        if (Auth::check()) {
            $listproducts = Product::where('user_id', auth()->user()->id)->get();
        } else {
            $listproducts = null;
        }

        $offers = Offer::with(['user', 'product', 'acceptor', 'sendproduct'])
            ->orderBy('created_at', 'desc')
            ->where('acceptor', auth()->user()->id)
            ->get();

        $sendoffers = Offer::with(['user', 'product', 'acceptor', 'sendproduct'])
            ->orderBy('created_at', 'desc')
            ->where('user_id', auth()->user()->id)
            ->get();


        return view('offers.index', compact('offers', 'sendoffers', 'listproducts'));
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
        $offers->acceptorName = $request->input('acceptorName');
        $offers->acceptorNumber = $request->input('acceptorNumber');
        $offers->accepted = 0;
        // dd($offers);
        $offers->save();
        return back()->with('success', 'Vaš zahtev je uspešno poslat!');
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
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->save();

        return redirect('/offers')->with('success', 'Uspešno ste prihvatili zahtev. Kontaktirajte korisnika radi uspešne zamene. Srećno!');
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
