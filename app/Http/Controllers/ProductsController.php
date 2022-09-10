<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('/products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validated = $request->validate([
        //     'name' => 'required',
        //     // 'conditions' => 'required',
        //     'descriptions' => 'required',
        // ]);

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/Product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        if ($request->has('images')) {
            $imagesname = '';
            foreach ($request->images as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('public/Product_images', $imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            // $product->images = $imagesname;
        } else {
            $imagesname = 'noimage.jpg';
        }


        $product = new Product;
        $product->user_id = Auth()->user()->id;
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->condition = $request->input('condition');
        $product->description = $request->input('description');
        $product->image = $fileNameToStore;
        $product->images = $imagesname;
        $product->save();

        // $product->users()->attach($request->user_id);

        ProductUser::create([
            'product_id' => $product->id,
            'user_id' => Auth()->user()->id,
            'city' => Auth()->user()->city,
            'firstName' => Auth()->user()->firstName,
        ]);

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('Product_images', $name, 'public');

                Image::create([
                    'product_id' => $product->id,
                    'name' => $name,
                    'path' => '/storage/' . $path
                ]);
            }
        }
        // else {
        //     Image::create([
        //         'product_id' => $product->id,
        //         'name' => 'noimage.jpg',
        //     ]);
        // }

        // if ($request->hasfile('images')) {
        //     $images = $request->file('images');

        //     foreach ($images as $image) {
        //         $name = $image->getClientOriginalName();
        //         $path = $image->storeAs('Product_images', $name, 'public');

        //         Image::create([
        //             'product_id' => $product->id,
        //             'name' => $name,
        //             'path' => '/storage/' . $path
        //         ]);
        //     }
        // } else {
        //     Image::create([
        //         'product_id' => $product->id,
        //         'name' => 'noimage.jpg',
        //     ]);
        // }
        $product->categories()->attach(request('category_id'));

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
        $product = Product::find($id);
        return view('/home')->with('product', $product);
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
