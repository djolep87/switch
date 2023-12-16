<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


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

        $wishlists = Wishlist::where('user_id', auth()->user()->id)->withCount('products')->get();

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


        return view('offers.index', compact('offers', 'sendoffers', 'listproducts', 'wishlists'));
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
    public function store(Request $request, Product $mojiproizvodi)
    {


        $offers = new Offer;
        $offers->user_id = Auth()->user()->id;
        $offers->sendproduct_id = $request->input('sendproduct_id');
        $offers->product_id = $request->input('product_id');
        $offers->acceptor = $request->input('acceptor');
        $offers->acceptorName = $request->input('acceptorName');
        $offers->acceptorNumber = $request->input('acceptorNumber');
        $offers->accepted = 0;

        $offers->save();
        toast('Vaš zahtev je uspešno poslat!', 'success');
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
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->save();
        toast('Uspešno ste prihvatili zahtev. Kontaktirajte korisnika radi uspešne zamene. Srećno!', 'success');
        return redirect('/offers');
    }

    public function rejected(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->save();
        toast('Zahtev je odbijen!', 'error');
        return redirect('/offers');
    }

    public function confirmation(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->save();
        toast('Čestitamo! Uspešna zamena! ', 'success');
        return redirect('/offers');
    }

    public function canceled(Request $request, $id)
    {
        $offers = Offer::find($id);
        $offers->accepted =  $request->input('accepted');
        $offers->save();
        toast('Zamena neuspešna!', 'error');
        return redirect('/offers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $offers = Offer::findOrFail($id);
        // $sendoffers = Offer::findOrFail($id);
        // if ($offers->product->images || !$offers->product->images) {
        //     $images = explode(",", $offers->product->images);
        //     foreach($images as $image){
        //         Storage::delete('public/Product_images'.'/'.$image);
        //     }
        // }
        //     if($sendoffers->sendproduct->images || !$sendoffers->sendproduct->images){
        //         $images = explode(",", $sendoffers->sendproduct->images);
        //         foreach($images as $image){
        //             Storage::delete('public/Product_images'.'/'.$image);
        //     }
        // }
        // if($offers->accepted == 1 || $offers->accepted == 3){
        //     $offers->product->delete();
        //     $offers->sendproduct->delete();
        // }
        
        // $offers->delete();
        // toast('Zahtev je obrisan!', 'warning');
        // return back();

        // $offer = Offer::findOrFail($id);
        // $product = $offer->product;
        // $sendProduct = $offer->sendproduct;

        // if ($product) {
        //     // Provjerite postoji li proizvod povezan s ponudom
        //     $productImages = $product->images;

        //     if ($productImages) {
        //         // Provjerite postoje li slike za proizvod
        //         $imagePaths = explode(",", $productImages);
        //         foreach ($imagePaths as $image) {
        //             Storage::delete('public/Product_images' . '/' . $image);
        //         }
        //     }
            
        //     if ($offer->accepted == 1 || $offer->accepted == 3) {
        //         $product->delete();
        //     }
        // }

        // if ($sendProduct) {
        //     // Slično kao za prvi proizvod
        //     $sendProductImages = $sendProduct->images;

        //     if ($sendProductImages) {
        //         $sendImagePaths = explode(",", $sendProductImages);
        //         foreach ($sendImagePaths as $image) {
        //             Storage::delete('public/Product_images' . '/' . $image);
        //         }
        //     }

        //     if ($offer->accepted == 1 || $offer->accepted == 3) {
        //         $sendProduct->delete();
        //     }
        // }

        // $offer->delete();
        // toast('Zahtev je obrisan!', 'warning');
        // return back();
        // 

        $offer = Offer::findOrFail($id);

        if ($offer->accepted == 1 || $offer->accepted == 3) {
            $product = $offer->product;
            $sendProduct = $offer->sendproduct;
    
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
    
            if ($sendProduct) {
                $sendProductImages = $sendProduct->images;
    
                if ($sendProductImages) {
                    $sendImagePaths = explode(",", $sendProductImages);
                    foreach ($sendImagePaths as $image) {
                        Storage::delete('public/Product_images' . '/' . $image);
                    }
                }
                
                $sendProduct->delete(); // Obrišite sendproduct
            }
        }
    
        $offer->delete();
        toast('Zahtev je obrisan!', 'warning');
        return back();
    }
}
