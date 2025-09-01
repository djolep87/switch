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
            })->where('products.status', 'active')->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
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
            $products = Product::where('products.status', 'active')->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
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
            $userId = Auth::id();
        
            // Prikaži sve proizvode korisnika koji NISU u finalized offerima (accepted = 1 ili 3)
            $listproducts = Product::where('user_id', $userId)
                ->whereNotIn('id', function ($query) {
                    $query->select('sendproduct_id')
                          ->from('offers')
                          ->whereIn('accepted', [1, 3]);
                })
                ->whereNotIn('id', function ($query) {
                    $query->select('product_id')
                          ->from('offers')
                          ->whereIn('accepted', [1, 3]);
                })
                ->get();
        
            // Disable ako je proizvod učesnik aktivne ponude (bilo kao sender ili receiver)
            foreach ($listproducts as $product) {
                $isInPendingOffer = DB::table('offers')
                    ->where(function ($query) use ($product) {
                        $query->where('sendproduct_id', $product->id)
                              ->orWhere('product_id', $product->id);
                    })
                    ->where('accepted', 0)
                    ->exists();
        
                $product->isDisabledForCurrentExchange = $isInPendingOffer;
            }
        } else {
            $listproducts = null;
        }

        // Add logic to check for existing offers between current user and product owners
        if (Auth::check()) {
            foreach ($products as $product) {
                // Check if there's an existing offer between these users involving this specific product
                $hasExistingOffer = DB::table('offers')
                    ->where(function ($query) use ($product, $userId) {
                        // Current user is sender, product owner is acceptor, and this product is involved
                        $query->where('user_id', $userId)
                              ->where('acceptor', $product->user_id)
                              ->where(function ($subQuery) use ($product) {
                                  $subQuery->where('product_id', $product->productid)
                                          ->orWhere('sendproduct_id', $product->productid);
                              });
                    })->orWhere(function ($query) use ($product, $userId) {
                        // Product owner is sender, current user is acceptor, and this product is involved
                        $query->where('user_id', $product->user_id)
                              ->where('acceptor', $userId)
                              ->where(function ($subQuery) use ($product) {
                                  $subQuery->where('product_id', $product->productid)
                                          ->orWhere('sendproduct_id', $product->productid);
                              });
                    })->where('accepted', 0)
                    ->exists();
                
                $product->hasExistingOfferWithUser = $hasExistingOffer;
            }
        }
        
        return view('/home', compact('products', 'categories', 'categoryName', 'listproducts', 'wishlists',));
    }

    public function search(Request $request, Product $product)
    {




        if (request()->category) {
            $search_text = $_GET['query'];
            $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->with('categories')->where('products.status', 'active')->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
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
            $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->with('categories')->where('products.status', 'active')->whereNotIn('products.id', function ($query) { // Specify 'products.id' instead of just 'id'
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
            $userId = Auth::id();
        
            // Prikaži sve proizvode korisnika koji NISU u finalized offerima (accepted = 1 ili 3)
            $listproducts = Product::where('user_id', $userId)
                ->whereNotIn('id', function ($query) {
                    $query->select('sendproduct_id')
                          ->from('offers')
                          ->whereIn('accepted', [1, 3]);
                })
                ->whereNotIn('id', function ($query) {
                    $query->select('product_id')
                          ->from('offers')
                          ->whereIn('accepted', [1, 3]);
                })
                ->get();
        
            // Disable ako je proizvod učesnik aktivne ponude (bilo kao sender ili receiver)
            foreach ($listproducts as $product) {
                $isInPendingOffer = DB::table('offers')
                    ->where(function ($query) use ($product) {
                        $query->where('sendproduct_id', $product->id)
                              ->orWhere('product_id', $product->id);
                    })
                    ->where('accepted', 0)
                    ->exists();
        
                $product->isDisabledForCurrentExchange = $isInPendingOffer;
            }
        } else {
            $listproducts = null;
        }

        // Add logic to check for existing offers between current user and product owners
        if (Auth::check()) {
            foreach ($products as $product) {
                // Check if there's an existing offer between these users involving this specific product
                $hasExistingOffer = DB::table('offers')
                    ->where(function ($query) use ($product, $userId) {
                        // Current user is sender, product owner is acceptor, and this product is involved
                        $query->where('user_id', $userId)
                              ->where('acceptor', $product->user_id)
                              ->where(function ($subQuery) use ($product) {
                                  $subQuery->where('product_id', $product->productid)
                                          ->orWhere('sendproduct_id', $product->productid);
                              });
                    })->orWhere(function ($query) use ($product, $userId) {
                        // Product owner is sender, current user is acceptor, and this product is involved
                        $query->where('user_id', $product->user_id)
                              ->where('acceptor', $userId)
                              ->where(function ($subQuery) use ($product) {
                                  $subQuery->where('product_id', $product->productid)
                                          ->orWhere('sendproduct_id', $product->productid);
                              });
                    })->where('accepted', 0)
                    ->exists();
                
                $product->hasExistingOfferWithUser = $hasExistingOffer;
            }
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
            $userId = Auth::id();
        
            // Prikaži sve proizvode korisnika koji NISU u finalized offerima (accepted = 1 ili 3)
            $listproducts = Product::where('user_id', $userId)
                ->whereNotIn('id', function ($query) {
                    $query->select('sendproduct_id')
                          ->from('offers')
                          ->whereIn('accepted', [1, 3]);
                })
                ->whereNotIn('id', function ($query) {
                    $query->select('product_id')
                          ->from('offers')
                          ->whereIn('accepted', [1, 3]);
                })
                ->get();
        
            // Disable ako je proizvod učesnik aktivne ponude (bilo kao sender ili receiver)
            foreach ($listproducts as $product) {
                $isInPendingOffer = DB::table('offers')
                    ->where(function ($query) use ($product) {
                        $query->where('sendproduct_id', $product->id)
                              ->orWhere('product_id', $product->id);
                    })
                    ->where('accepted', 0)
                    ->exists();
        
                $product->isDisabledForCurrentExchange = $isInPendingOffer;
            }
        } else {
            $listproducts = null;
        }

        $products = Product::find($id);

        Product::find($id)->increment('views');
        $product = Product::find($id);
        $images = $product->images;

        // Add logic to check for existing offers between current user and product owner
        if (Auth::check()) {
            $hasExistingOffer = DB::table('offers')
                ->where(function ($query) use ($product, $userId) {
                    // Current user is sender, product owner is acceptor, and this product is involved
                    $query->where('user_id', $userId)
                          ->where('acceptor', $product->user_id)
                          ->where(function ($subQuery) use ($product) {
                              $subQuery->where('product_id', $product->id)
                                      ->orWhere('sendproduct_id', $product->id);
                          });
                })->orWhere(function ($query) use ($product, $userId) {
                    // Product owner is sender, current user is acceptor, and this product is involved
                    $query->where('user_id', $product->user_id)
                          ->where('acceptor', $userId)
                          ->where(function ($subQuery) use ($product) {
                              $subQuery->where('product_id', $product->id)
                                      ->orWhere('sendproduct_id', $product->id);
                          });
                })->where('accepted', 0)
                ->exists();
            
            $product->hasExistingOfferWithUser = $hasExistingOffer;
        }

        return view('products.show', compact('product', 'products', 'images', 'listproducts', 'wishlists', 'user', 'comments'));
    }

    public function store(Request $request) {}
}
