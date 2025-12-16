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
        $posts= \App\Models\Post::all();
        $postsCount = \App\Models\Post::count();
        $products = \App\Models\Product::paginate(10);
        $users = \App\Models\User::paginate(10);
       return view('admin.dashboard', compact('users', 'products', 'offers', 'userCount', 'productCount', 'offerCount', 'postsCount', 'posts'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
         $query = \App\Models\User::query();

         // Search functionality
         if ($request->filled('search')) {
             $search = $request->search;
             $query->where(function($q) use ($search) {
                 $q->where('firstName', 'like', "%{$search}%")
                   ->orWhere('lastName', 'like', "%{$search}%")
                   ->orWhere('email', 'like', "%{$search}%")
                   ->orWhere('phone', 'like', "%{$search}%")
                   ->orWhere('city', 'like', "%{$search}%");
             });
         }

         // Filter by admin status
         if ($request->filled('role')) {
             if ($request->role == 'admin') {
                 $query->where('is_admin', true);
             } elseif ($request->role == 'user') {
                 $query->where('is_admin', false);
             }
         }

         // Filter by accepted status
         if ($request->filled('status')) {
             if ($request->status == 'accepted') {
                 $query->where('accepted', true);
             } elseif ($request->status == 'pending') {
                 $query->where('accepted', false);
             }
         }

         $userCount = \App\Models\User::count();
         $adminCount = \App\Models\User::where('is_admin', true)->count();
         $regularUserCount = \App\Models\User::where('is_admin', false)->count();
         $acceptedCount = \App\Models\User::where('accepted', true)->count();
         
         $users = $query->paginate(24)->withQueryString();
         
         return view('admin.users.index', compact('users', 'userCount', 'adminCount', 'regularUserCount', 'acceptedCount'));
    }


    public function products(Request $request)
    {
        $query = \App\Models\Product::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('condition', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $productCount = \App\Models\Product::count();
        $activeCount = \App\Models\Product::where('status', 'active')->count();
        $inactiveCount = \App\Models\Product::where('status', 'inactive')->count();
        $totalViews = \App\Models\Product::sum('views');
        
        $products = $query->paginate(24)->withQueryString();
        $categories = \App\Models\Category::all();
        
        return view('admin.products.index', compact('products', 'productCount', 'activeCount', 'inactiveCount', 'totalViews', 'categories'));
    }

    public function offers()
    {
        $totalOffers = \App\Models\Offer::count();
        $acceptedOffers = \App\Models\Offer::where('accepted', 1)->count();
        $rejectedOffers = \App\Models\Offer::where('accepted', 2)->count();
        $successfulOffers = \App\Models\Offer::where('accepted', 3)->count();
        $unsuccessfulOffers = \App\Models\Offer::where('accepted', 4)->count();
        $pendingOffers = \App\Models\Offer::where('accepted', 0)->count();
        
        return view('admin.offers.index', compact(
            'totalOffers',
            'acceptedOffers',
            'rejectedOffers',
            'successfulOffers',
            'unsuccessfulOffers',
            'pendingOffers'
        ));
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
