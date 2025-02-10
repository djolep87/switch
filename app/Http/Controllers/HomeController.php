<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentUser;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\User;
use App\Models\Wishlist;
use App\Notifications\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function isInExchange()
    {
        return $this->offers()->whereIn('accepted', [1, 3])->exists();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Product $product)
    {
        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('name', request()->category);
            })->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
                $query->select('products.id')
                    ->from('products')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->join('offers', function ($join) {
                        $join->on('offers.product_id', '=', 'products.id')
                            ->orOn('offers.sendproduct_id', '=', 'products.id');
                    })
                    ->where('offers.accepted', '=', 1)
                    ->orWhere('offers.accepted', '=', 3);
            })->join('users', 'users.id', '=', 'products.user_id')
                ->orderBy('products.created_at', 'desc')
                ->select(
                    'phone',
                    'users.city as users_city',
                    'users.firstname AS users_firstname',
                    'users.id AS user_id',
                    'products.id AS productid',
                    'products.name',
                    'products.condition',
                    'description',
                    'products.images',
                    'views',
                    'firstname AS firstName',
                    'lastname',
                    'city',
                    'address'
                )
                ->paginate(48);

            $categories = Category::withCount('products')->get();
            $category = $categories->where('name', request()->category)->first();
            $categoryName = $category ? $category->name : '';
        } else {
            $products = Product::whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
                $query->select('products.id')
                    ->from('products')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->join('offers', function ($join) {
                        $join->on('offers.product_id', '=', 'products.id')
                            ->orOn('offers.sendproduct_id', '=', 'products.id');
                    })
                    ->where('offers.accepted', '=', 1)
                    ->orWhere('offers.accepted', '=', 3);
            })->join('users', 'users.id', '=', 'products.user_id')
                ->orderBy('products.created_at', 'desc')
                ->select(
                    'phone',
                    'users.city as users_city',
                    'users.firstname AS users_firstname',
                    'users.id AS user_id',
                    'products.id AS productid',
                    'products.name',
                    'products.condition',
                    'description',
                    'products.images',
                    'views',
                    'firstname AS firstName',
                    'lastname',
                    'city',
                    'address'
                )
                ->paginate(48);

            $categories = Category::withCount('products')->get();
            $categoryName = '';
        }
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();

        // if (Auth::check()) {
        //     $listproducts = Product::where('user_id', auth::user()->id)
        //     ->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
        //         $query->select('products.id')
        //             ->from('products')
        //             ->join('users', 'users.id', '=', 'products.user_id')
        //             ->join('offers', function ($join) {
        //                 $join->on('offers.product_id', '=', 'products.id')
        //                     ->orOn('offers.sendproduct_id', '=', 'products.id');
        //             })
        //             ->where('offers.accepted', '=', 1)
        //             ->orWhere('offers.accepted', '=', 3);
        //     })


        //     ->get();
        // } else {
        //     $listproducts = null;
        // }
        if (Auth::check()) {
            $listproducts = Product::where('user_id', auth::user()->id)
                ->whereNotIn('products.id', function ($query) {
                    $query->select('products.id')
                        ->from('products')
                        ->join('users', 'users.id', '=', 'products.user_id')
                        ->join('offers', function ($join) {
                            $join->on('offers.product_id', '=', 'products.id')
                                ->orOn('offers.sendproduct_id', '=', 'products.id');
                        })
                        ->where('offers.accepted', '=', 1)
                        ->orWhere('offers.accepted', '=', 3);
                })
                ->with(['offers' => function ($query) {
                    $query->where('accepted', 0);
                }])
                ->get()
                ->map(function ($product) {
                    // Proverite da li postoji offer sa accepted = 0 za ovaj proizvod
                    $hasPendingOffer = $product->offers->isNotEmpty();
                    
                    // Postavite isDisabledForCurrentExchange na true ako postoji pending offer
                    $product->isDisabledForCurrentExchange = $hasPendingOffer;
                    
                    // Omogućite sve ostale ponude
                    $product->isDisabledForOtherExchanges = false;
                    
                    return $product;
                });
        } else {
            $listproducts = null;
        }

        return view('/home', compact('products', 'categories', 'categoryName', 'listproducts', 'wishlists',));
    }

    public function search(Request $request, Product $product)
    {




        if (request()->category) {
            $search_text = $_GET['query'];
            $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->with('categories')->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
                $query->select('products.id')
                    ->from('products')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->join('offers', function ($join) {
                        $join->on('offers.product_id', '=', 'products.id')
                            ->orOn('offers.sendproduct_id', '=', 'products.id');
                    })
                    ->where('offers.accepted', '=', 1)
                    ->orWhere('offers.accepted', '=', 3);
            })->join('users', 'users.id', '=', 'products.user_id')
                ->orderBy('products.created_at', 'desc')
                ->select(
                    'phone',
                    'users.city as users_city',
                    'users.firstname AS users_firstname',
                    'users.id AS user_id',
                    'products.id AS productid',
                    'products.name',
                    'products.condition',
                    'description',
                    'products.images',
                    'views',
                    'firstname AS firstName',
                    'lastname',
                    'city',
                    'address'
                )
                ->paginate(48);

            $categories = Category::withCount('products')->get();
            $category = $categories->where('name', request()->category)->first();
            $categoryName = $category ? $category->name : '';
        } else {
            $search_text = $_GET['query'];
            $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->with('categories')->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
                $query->select('products.id')
                    ->from('products')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->join('offers', function ($join) {
                        $join->on('offers.product_id', '=', 'products.id')
                            ->orOn('offers.sendproduct_id', '=', 'products.id');
                    })
                    ->where('offers.accepted', '=', 1)
                    ->orWhere('offers.accepted', '=', 3);
            })->join('users', 'users.id', '=', 'products.user_id')
                ->orderBy('products.created_at', 'desc')
                ->select(
                    'phone',
                    'users.city as users_city',
                    'users.firstname AS users_firstname',
                    'users.id AS user_id',
                    'products.id AS productid',
                    'products.name',
                    'products.condition',
                    'description',
                    'products.images',
                    'views',
                    'firstname AS firstName',
                    'lastname',
                    'city',
                    'address'
                )
                ->paginate(48);
            // $products = Product::inRandomOrder()->take(16)->get();
            $categories = Category::withCount('products')->get();
            $categoryName = '';
        }
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();



        if (Auth::check()) {
            // Oglasi koje korisnik može da vidi i za koje može da pošalje ponudu
            $listproducts = Product::where('user_id', auth()->user()->id)
                // Filtriraj oglase za koje je već poslana ponuda (status 0, 1, 3)
                ->whereNotIn('products.id', function ($query) use ($product) {
                    $query->select('sendproduct_id')
                        ->from('offers')
                        ->where('product_id', $product->productid)
                        ->whereIn('accepted', [0, 1, 3]); // Ponude u toku ili prihvaćene
                })
                ->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
                    $query->select('products.id')
                        ->from('products')
                        ->join('users', 'users.id', '=', 'products.user_id')
                        ->join('offers', function ($join) {
                            $join->on('offers.product_id', '=', 'products.id')
                                ->orOn('offers.sendproduct_id', '=', 'products.id');
                        })
                        ->where('offers.accepted', '=', 1)
                        ->orWhere('offers.accepted', '=', 3);
                })
                // Proveri da li je trenutni korisnik poslao ponudu ili je primio ponudu
                ->get();
        } else {
            $listproducts = null;
        }
        return view('products.search', compact('products', 'categories', 'categoryName', 'listproducts', 'wishlists'));
    }


    public function show(Product $product, Comment $comment, $id, User $user)
    {

        $product = Product::find($id);
        $comments = Comment::where('product_user_id', $product->user_id)->orderBy('created_at', 'desc')->get();



        $user = Auth::user();
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        // if (Auth::check()) {
        //     $listproducts = Product::where('user_id', Auth::user()->id)
        //     ->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
        //         $query->select('products.id')
        //             ->from('products')
        //             ->join('users', 'users.id', '=', 'products.user_id')
        //             ->join('offers', function ($join) {
        //                 $join->on('offers.product_id', '=', 'products.id')
        //                     ->orOn('offers.sendproduct_id', '=', 'products.id');
        //             })
        //             ->where('offers.accepted', '=', 1)
        //             ->orWhere('offers.accepted', '=', 3);
        //     })


        //     ->get();
        // } else {
        //     $listproducts = null;
        // }

        if (Auth::check()) {
            // Dohvatanje svih proizvoda korisnika
            $listproducts = Product::where('user_id', auth::user()->id)
                ->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
                    $query->select('products.id')
                        ->from('products')
                        ->join('users', 'users.id', '=', 'products.user_id')
                        ->join('offers', function ($join) {
                            $join->on('offers.product_id', '=', 'products.id')
                                ->orOn('offers.sendproduct_id', '=', 'products.id');
                        })
                        ->where('offers.accepted', '=', 1)
                        ->orWhere('offers.accepted', '=', 3);
                })


                ->get();

            foreach ($listproducts as $product) {
                // Proveravamo da li postoji ponuda koja uključuje ovaj proizvod
                $isInExchange = \App\Models\Offer::where(function ($query) use ($product) {
                    $query->where('sendproduct_id', $product->id)
                        ->orWhere('product_id', $product->id);
                })
                    ->where(function ($query) {
                        $query->where('user_id', auth()->user()->id)
                            ->orWhere('acceptor', auth()->user()->id);
                    })
                    ->where('accepted', 0) // Ponude u toku
                    ->exists(); // Proveravamo da li postoji barem jedna takva ponuda

                // Ako je proizvod u razmeni, postavljamo da je onemogućen
                $product->isDisabledForCurrentExchange = $isInExchange;
                logger()->info("Proizvod ID: {$product->id}, IsInExchange: " . ($isInExchange ? 'Yes' : 'No'));
            }
        } else {
            $listproducts = null;
        }

        $products = Product::find($id);

        Product::find($id)->increment('views');
        $product = Product::find($id);
        $images = $product->images;
        return view('products.show', compact('product', 'products', 'images', 'listproducts', 'wishlists', 'user', 'comments'));
    }

    public function store(Request $request) {}
}
