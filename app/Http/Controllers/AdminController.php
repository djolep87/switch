<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $userCount = \App\Models\User::count();
        $offerCount = \App\Models\Offer::count();
        $offers = \App\Models\Offer::all();
        $productCount = \App\Models\Product::count();
        $products = \App\Models\Product::paginate(10);
        $users = \App\Models\User::paginate(10);
       return view('admin.dashboard', compact('users', 'products', 'offers', 'userCount', 'productCount', 'offerCount'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
         $userCount = \App\Models\User::count();
         $users = \App\Models\User::paginate(24);
         return view('admin.users.index', compact('users', 'userCount'));
    }


    public function products()
    {
        $productCount = \App\Models\Product::count();
        $products = \App\Models\Product::paginate(24);
        return view('admin.products.index', compact('products', 'productCount'));
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
