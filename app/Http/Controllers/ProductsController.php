<?php

namespace App\Http\Controllers;

use App\Models\Category;
// use App\Models\Image;
use App\Models\Images;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
// use Image;
use Intervention\Image\ImageManagerStatic as Image;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();
        $categories = Category::all();
        return view('/products.create', compact('categories', 'wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validacija zahteva
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $imagesname = 'noimage.jpg';
        if ($request->has('images')) {
            $imagesname = [];
            foreach ($request->images as $key => $image) {
                $imgName = time() . $key . '.' . $image->extension();

                // Kreiranje instance slike
                $resizedImage = Image::make($image);

                // Resize slike uz zadržavanje proporcija
                $resizedImage->resize(400, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Dodavanje bele pozadine ako je potrebno
                $resizedImage->resizeCanvas(400, 300, 'center', false, 'ffffff');

                // Pretvaranje slike u stream sa zadatim kvalitetom (90)
                $resizedImage->stream(null, 100);

                // Čuvanje slike na disku
                Storage::disk('public')->put('Product_images/' . $imgName, $resizedImage->__toString());

                $imagesname[] = $imgName;
            }
            $imagesname = implode(',', $imagesname);
        }

        // Čuvanje podataka o proizvodu
        $product = new Product;
        $product->user_id = Auth()->user()->id;
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->condition = $request->input('condition');
        $product->description = $request->input('description');
        $product->images = $imagesname;
        $product->save();

        $product->categories()->attach($request->input('category_id'));
        toast('Uspešno ste postavili oglas!', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();
        $categories = Category::all();
        $product = Product::find($id);
        $images = Images::where('product_id', $id)->get();
        return view('/products.edit', compact('categories', 'product', 'images', 'wishlists'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {

    //       // Validate the incoming request data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',

    //     ]);


    //     $product = Product::findOrFail($id);

    //     if ($request->has('images')) {
    //         $imagesname = [];
    //         foreach ($request->images as $key => $image) {
    //             $imgName = time() . $key . '.' . $image->extension();

    //             // Resize and save image
    //             $resizedImage = Image::make($image)->resize(400, 300)->stream(); 
    //             Storage::disk('public')->put('Product_images/' . $imgName, $resizedImage);

    //             $imagesname[] = $imgName;
    //         }
    //         $imagesname = implode(',', $imagesname);
    //     } else {
    //         $imagesname = 'noimage.jpg';
    //     }

    //     $product->user_id = Auth()->user()->id;
    //     $product->category_id = $request->input('category_id');
    //     $product->name = $request->input('name');
    //     $product->condition = $request->input('condition');
    //     $product->description = $request->input('description');
    //     $product->images = $imagesname;
    //     $product->save();

    //     $product->categories()->sync($request->input('category_id'));

    //     toast('Uspešno izmenjen oglas!', 'success');
    //     return redirect('/dashboard');
    // }

    public function update(Request $request, $id)
    {
        // Validacija zahteva
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        // Rukovanje uploadom slika
        if ($request->has('images')) {
            $imagesname = [];

            // Brisanje starih slika osim 'noimage.jpg'
            $oldImages = explode(',', $product->images);
            foreach ($oldImages as $oldImage) {
                if ($oldImage !== 'noimage.jpg') {
                    Storage::disk('public')->delete('Product_images/' . $oldImage);
                }
            }

            // Čuvanje novih slika
            foreach ($request->images as $key => $image) {
                $imgName = time() . $key . '.' . $image->extension();

                // Resize i čuvanje slike
                $resizedImage = Image::make($image)
                    ->resize(400, 300, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->resizeCanvas(400, 300, 'center', false, 'ffffff')
                    ->stream(null, 100); // Postavljanje kvaliteta na 90

                Storage::disk('public')->put('Product_images/' . $imgName, $resizedImage->__toString());

                $imagesname[] = $imgName;
            }
            $imagesname = implode(',', $imagesname);
        } else {
            // Zadržavanje starih slika ako nove nisu uploadovane
            $imagesname = $product->images;
        }

        // Ažuriranje podataka o proizvodu
        $product->user_id = auth()->user()->id;
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->condition = $request->input('condition');
        $product->description = $request->input('description');
        $product->images = $imagesname;
        $product->save();

        $product->categories()->sync($request->input('category_id'));

        toast('Uspešno izmenjen oglas!', 'success');
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $product = Product::find($id);


        if ($product) {
            $productImages = $product->images;

            if ($productImages) {
                $imagePaths = explode(",", $productImages);
                foreach ($imagePaths as $image) {
                    Storage::delete('public/Product_images' . '/' . $image);
                }
            }

            $product->delete(); // Obrišite proizvod
        }





        toast('Oglas je obrisan!', 'warning');
        return back();
    }
}
