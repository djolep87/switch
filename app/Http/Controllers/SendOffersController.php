<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Notifications\AcceptNotifications;
use App\Notifications\Notifications;
use App\Notifications\RejectedNotifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SendOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $wishlists = auth()->check() 
        ? Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get()
        : collect();

        if (Auth::check()) {
            $listproducts = Product::where('user_id', auth()->user()->id)->where('status', 'active')->get();
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


        return view('sendOffers.index', compact('offers', 'sendoffers', 'listproducts', 'wishlists'));
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
        //
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
