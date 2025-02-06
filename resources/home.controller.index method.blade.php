public function index(Request $request, Product $product)
    {

        // $user = User::find(2);
        // User::find(2)->notify(new Notifications);

        // $products = Product::with('categories')->whereHas('categories', function ($query) {
        //     $query->where('name', request()->category);
        // })->whereDoesntHave('offers', function ($query) {
        //     $query->where('accepted', 1);
        // })->paginate(48);
        /*   $query = "SELECT * FROM products
            INNER JOIN offers ON  offers.product_id = products.id AND offers.sendproduct_id = products.id
            WHERE accepted = 1" ; */
        // $products =  DB::select(' SELECT * FROM products INNER JOIN offers ON  offers.product_id = products.id AND offers.sendproduct_id = products.id WHERE accepted = 1 ');
        // $products =  Product::with('categories')->whereHas('categories', function ($query) {
        // $query->where('name', request()->category); 
        // DB::select(' SELECT phone,  users.city as users_city, users.firstname AS users_firstname, users.id AS user_id, products.id AS productid, products.name, products.condition,  description, image, views, firstname AS firstName, lastname, city, address  
        //  FROM products 
        //  INNER JOIN users ON users.id = products.user_id
        //  WHERE
        // products.id NOT IN (
        // SELECT products.id
        // FROM products 
        // INNER JOIN users ON users.id = products.user_id
        // inner JOIN offers ON offers.product_id = products.id OR offers.sendproduct_id =  products.id 
        // WHERE  accepted = 1 ) ')}


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
            //         $products = Product::select('users.city as users_city', 'users.firstname AS users_firstname', 'users.id AS user_id', 'products.id AS productid', 'products.name', 'products.condition', 'products.description', 'products.image', 'products.views', 'users.firstname AS firstName', 'users.lastname', 'users.city', 'users.address')
            // ->join('users', 'users.id', '=', 'products.user_id')
            // ->whereNotIn('products.id', function ($query) {
            //     $query->select('products.id')
            //         ->from('products')
            //         ->join('users', 'users.id', '=', 'products.user_id')
            //         ->leftJoin('offers', function ($join) {
            //             $join->on('offers.product_id', '=', 'products.id')
            //                  ->orOn('offers.sendproduct_id', '=', 'products.id');
            //         })
            //         ->where('offers.accepted', 1);
            // })
            // ->get();
            // $products = Product::join('users', 'users.id', 'products.user_id')
            // ->select('users.id as user_name', 'products.*')
            // ->whereDoesntHave('offers', function ($query) {
            //     $query->where('accepted', 1);
            // })->orderBy('created_at', 'desc')->paginate(48);
            //  $products = DB::select(' SELECT * FROM products INNER JOIN offers ON  offers.product_id = products.id AND offers.sendproduct_id = products.id WHERE accepted = 1 ');
            // $products = DB::select(' SELECT phone,  users.city as users_city, users.firstname AS users_firstname, users.id AS user_id, products.id AS productid, products.name, products.condition,  description, image, views, firstname AS firstName, lastname, city, address  
            //  FROM products 
            //  INNER JOIN users ON users.id = products.user_id
            //  WHERE
            // products.id NOT IN (
            // SELECT products.id
            // FROM products 
            // INNER JOIN users ON users.id = products.user_id
            // inner JOIN offers ON offers.product_id = products.id OR offers.sendproduct_id =  products.id 
            // WHERE  accepted = 1 )  ');
            // $products = Product::select( 'users.city as users_city', 'users.firstname AS users_firstname', 'users.id AS user_id', 'products.id AS productid', 'products.name', 'products.condition', 'products.description', 'products.image', 'products.views', 'users.firstname AS firstName', 'users.lastname', 'users.city', 'users.address')
            // ->join('users', 'users.id', '=', 'products.user_id')
            // ->whereNotIn('products.id', function ($query) {
            //     $query->select('products.id')
            //         ->from('products')
            //         ->join('users', 'users.id', '=', 'products.user_id')
            //         ->leftJoin('offers', function ($join) {
            //             $join->on('offers.product_id', '=', 'products.id')
            //                  ->orOn('offers.sendproduct_id', '=', 'products.id');
            //         })
            //         ->where('offers.accepted', 1);
            // })
            // ->get();

            $categories = Category::withCount('products')->get();
            $categoryName = '';
        }
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();



        if (Auth::check()) {
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
        } else {
            $listproducts = null;
        }
        return view('/home', compact('products', 'categories', 'categoryName', 'listproducts', 'wishlists',));
    }